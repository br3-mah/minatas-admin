<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\ApplicationStage;
use App\Models\User;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Carbon\Carbon;

class ImportController extends Controller
{
    public function import_loans(Request $request){
        if ($request->isMethod('post')) {
            $file = $request->file('file');

            if ($file->isValid() && $file->getClientOriginalExtension() == 'xlsx') {
                $uploadedFilePath = 'uploads/' . $file->getClientOriginalName();

                if ($file->move('uploads', $uploadedFilePath)) {
                    try {
                        $spreadsheet = IOFactory::load($uploadedFilePath);
                        $worksheet = $spreadsheet->getActiveSheet();

                        $data = $worksheet->toArray(null, true, true, true);

                        // Remove the header row
                        array_shift($data);

                        try {
                            foreach ($data as $row) {
                                if ($row['A'] !== null || $row['E'] !== null || $row['J'] !== null) {
                                    $a = Application::create([
                                        'lname' => $row['A'],
                                        'fname' => $row['B'],
                                        'email' => $row['C'],
                                        'phone' =>  '0'.$row['D'],
                                        'gender' => $row['E'],
                                        'repayment_plan' => $row['F'],
                                        'amount' => $row['G'],
                                        'status' =>  $row['H'],
                                        'user_id' => $row['I'],
                                        'complete' =>  $row['J'],
                                        'nationality' => $row['K'],
                                        'continue' => $row['L'],
                                        'is_assigned' => $row['M'],
                                        'loan_product_id' => $row['N'],
                                        'created_at' => Carbon::parse($row['O']),
                                        'updated_at' => Carbon::parse($row['O']),
                                        'mou_loan' => $row['P'],
                                        'related_party' => $row['Q'],
                                        'date_paid' => $row['R'],
                                        'due_date' => $row['S'],
                                        'days_late' => $row['T'],
                                        'desc' => $row['U'],
                                        'note' => $row['V'],
                                    ]);

                                    ApplicationStage::create([
                                        'application_id' => $a->id,
                                        'loan_status_id' => 1,
                                        'state' => 'current',
                                        'status' => 'verification',
                                        'stage' => 'processing',
                                        'prev_status' => 'current',
                                        'curr_status' => '',
                                        'position'=>1
                                    ]);
                                }
                            }
                        } catch (\Throwable $th) {
                            dd($th);
                        }

                        // Add a success flash message
                        return redirect()->back()->with('success', 'Upload successful!');
                    } catch (\Exception $e) {
                        // Add an error flash message
                        return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
                    }
                } else {
                    // Add an error flash message
                    return redirect()->back()->with('error', 'Failed to move uploaded file.');
                }
            } else {
                // Add an error flash message
                return redirect()->back()->with('error', 'Invalid file or file format. Please upload an Excel file (xlsx).');
            }
        }
    }



    public function import_users(Request $request){
        if ($request->isMethod('post')) {
            $file = $request->file('file');

            if ($file->isValid() && $file->getClientOriginalExtension() == 'xlsx') {
                $uploadedFilePath = 'uploads/' . $file->getClientOriginalName();

                if ($file->move('uploads', $uploadedFilePath)) {
                    try {
                        $spreadsheet = IOFactory::load($uploadedFilePath);
                        $worksheet = $spreadsheet->getActiveSheet();

                        $data = $worksheet->toArray(null, true, true, true);

                        // Remove the header row
                        array_shift($data);

                        try {
                            foreach ($data as $row) {
                                if ($row['A'] !== null || $row['E'] !== null || $row['J'] !== null) {
                                    User::create([
                                        'lname' => $row['A'],
                                        'fname' => $row['B'],
                                        'email' => $row['C'],
                                        'phone' =>  '26'.$row['D'],
                                        'dob' => $row['E'],
                                        'id_type' => $row['F'],
                                        'nrc_no' => $row['G'],
                                        'nrc' => $row['G'],
                                        'jobTitle' =>  $row['H'],
                                        'address' => $row['I'],
                                        'gender' =>  $row['J'],
                                        'employeeNo' => $row['K'],
                                        'password' => 'capex+2024'
                                    ]);
                                }
                            }
                        } catch (\Throwable $th) {
                            dd($th);
                        }

                        // Add a success flash message
                        return redirect()->back()->with('success', 'Upload successful!');
                    } catch (\Exception $e) {
                        // Add an error flash message
                        return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
                    }
                } else {
                    // Add an error flash message
                    return redirect()->back()->with('error', 'Failed to move uploaded file.');
                }
            } else {
                // Add an error flash message
                return redirect()->back()->with('error', 'Invalid file or file format. Please upload an Excel file (xlsx).');
            }
        }
    }
}
