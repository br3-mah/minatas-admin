<?php

namespace App\Traits;
use App\Models\UserFile;
trait FileTrait{

    public function uploadCommonFiles($request){
        if ($request->hasFile('preapproval')) {
            $preapproval = $request->file('preapproval')->store('preapproval', 'public');
            UserFile::updateOrCreate(
                ['name' => 'preapproval', 'user_id' => $request->input('borrower_id')],
                ['path' => $preapproval],
                ['source' => 'admin']
            );
        }
        if ($request->hasFile('passport')) {
            $passport = $request->file('passport')->store('passport', 'public');
            UserFile::updateOrCreate(
                ['name' => 'passport', 'user_id' => $request->input('borrower_id')],
                ['path' => $passport],
                ['source' => 'admin']
            );
        }
        if ($request->hasFile('bankstatement')) {
            $bankstatement = $request->file('bankstatement')->store('bankstatement', 'public');
            UserFile::updateOrCreate(
                ['name' => 'bankstatement', 'user_id' => $request->input('borrower_id')],
                ['path' => $bankstatement],
                ['source' => 'admin']
            );
        }
        if ($request->hasFile('payslip_file')) {
            $payslip_file = $request->file('payslip_file')->store('payslip_file', 'public');
            UserFile::updateOrCreate(
                ['name' => 'payslip_file', 'user_id' => $request->input('borrower_id')],
                ['path' => $payslip_file],
                ['source' => 'admin']
            );
        }
        if ($request->hasFile('nrc_file')) {
            $nrc_file = $request->file('nrc_file')->store('nrc_file', 'public');
            UserFile::updateOrCreate(
                ['name' => 'nrc_file', 'user_id' => $request->input('borrower_id')],
                ['path' => $nrc_file],
                ['source' => 'admin']
            );
        }
        if ($request->hasFile('tpin_file')) {
            $tpin_file = $request->file('tpin_file')->store('tpin_file', 'public');
            UserFile::updateOrCreate(
                ['name' => 'tpin_file', 'user_id' => $request->input('borrower_id')],
                ['path' => $tpin_file],
                ['source' => 'admin']
            );
        }
        if ($request->hasFile('letterofintro')) {
            $loi_file = $request->file('letterofintro')->store('letterofintro', 'public');
            UserFile::updateOrCreate(
                ['name' => 'letterofintro', 'user_id' => $request->input('borrower_id')],
                ['path' => $loi_file],
                ['source' => 'admin']
            );
        }
    }
}