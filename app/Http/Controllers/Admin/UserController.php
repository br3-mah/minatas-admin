<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Traits\EmailTrait;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Traits\UserTrait;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
class UserController extends Controller
{
    use EmailTrait, UserTrait;
    // public function __construct()
    // {
    //     $this->middleware('can:admin.users.index')->only('index');
    //     $this->middleware('can:admin.users.edit')->only('edit', 'update');
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.users.index');
    }

    public function checkPhone(Request $request)
    {
        $phone = $request->input('phone');
        $exists = User::where('phone', $phone)->exists();

        return response()->json(['exists' => $exists]);
    }

    public function checkIdNumber(Request $request)
    {
        $nrc_no = $request->input('nrc_no');
        $exists = User::where('nrc_no', $nrc_no)->exists();

        return response()->json(['exists' => $exists]);
    }

    public function store(User $user, Request $request)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'phone' => 'required|unique:users,phone',
                'email' => 'required|unique:users,email',
                'nrc_no' => 'required|unique:users,nrc_no',
            ]);
            $u = $user->create(array_merge($request->all(), [
                'password' => bcrypt('@capex+2024'),
                'active' => 1
            ]));
            $u->syncRoles($request->assigned_role);
            $this->uploadUserPhotos($request, $u);
            DB::commit();
            Session::flash('success', 'User created successfully');
            return redirect()->back();

        } catch (\Throwable $th) {
            DB::rollback();
            if($request->assigned_role == 'user'){
                Session::flash('error', 'Oops.. There is a borrower account already using this email.');
            }elseif($request->assigned_role == 'employee'){
                Session::flash('error', 'Oops. There is an employee account already with this email.');
            }else{
                Session::flash('error', 'Oops.. An with this email already exists. please try again.');
            }
            return redirect()->back();
        }

    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        return view ('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(User $user, Request $request)
    {
        DB::beginTransaction();
        try {
            $user = User::find($request->user_edit_id);
            $data = array_merge($user->toArray(), $request->all(),[
                'profile_photo_path' => $url ?? ''
            ]);
            $user->fill($data);
            $user->save();
            $user->syncRoles($request->assigned_role);
            $this->uploadUserPhotos($request, $user);
            Session::flash('attention', "User Updated successfully.");
            DB::commit();
            return back();
        } catch (\Throwable $th) {
            // dd($th);
            DB::rollback();

            if($request->assigned_role == 'user'){
                Session::flash('error_msg', 'Oops.. There is a borrower account already using this email.');
            }elseif($request->assigned_role == 'employee'){
                Session::flash('error_msg', 'Oops. There is an employee account already with this email.');
            }else{
                Session::flash('error_msg', 'Oops.. An with this email already exists. please try again.');
            }
            return back();
        }

    }


    public function share_doc(Request $request){
        $email = $request->toArray()['email'];
        $res = $this->send_pre_approval_forms($email);
        if($res){
            return response()->json(['msg' => 'success']);
        }else{
            return response()->json(['msg' => 'error']);
        }
    }

    public function updatePic(Request $request)
    {

        try {
            $request->validate([
                'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            if ($request->hasFile('photo')) {
                // Process and save the file
                $url = Storage::put('public/users', $request->file('photo'));

                // Update user's profile_photo_path
                auth()->user()->update([
                    'profile_photo_path' => $url,
                ]);

                return redirect()->back()->with('success', 'Profile photo updated successfully.');
            } else {
                return redirect()->back()->with('error', 'No photo uploaded.');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'An error occurred while updating the profile photo.');
        }
    }
    public function updateProfile(Request $request)
    {
        try {
            $input = $request->toArray();
            Validator::make($input, [
                'fname' => ['required', 'string', 'max:255'],
                'lname' => ['required', 'string', 'max:255'],
                // 'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore(auth()->user()->email)],
                'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
                'phone' => ['required'],
                'address' => ['required'],
            ])->validateWithBag('updateProfileInformation');

            $user = auth()->user();
            $user->fname = $input['fname'];
            $user->lname = $input['lname'];
            $user->phone = $input['phone'];
            $user->address = $input['address'];
            $user->save();
            return redirect()->back()->with('success', 'Profile photo updated successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'An error occurred while updating the profile photo. '.$th->getMessage());
        }
    }
}
