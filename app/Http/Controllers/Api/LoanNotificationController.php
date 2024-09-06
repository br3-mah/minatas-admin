<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\LoanNotification;
use App\Models\Application;
use App\Models\User;
use App\Traits\SMSTrait;
use Illuminate\Http\Request;

class LoanNotificationController extends Controller
{
    use SMSTrait;public function plpNotification(Request $request) {
        try {
            $applicationId = $request->input('application_id');
            $userId = $request->input('user_id');

            // Create Loan Notification
            LoanNotification::create([
                'application_id' => $applicationId,
                'user_id' => $userId,
                'notification_type' => 'PMC',
                'message' => 'Your requested loan amount exceeds the Monthly Installment limits. Please consider increasing the loan duration or reducing the loan amount.',
                'is_accepted' => 0,
                'status' => 1 // Sent
            ]);

            // Update application status
            Application::where('id', $applicationId)->update([
                'plp_sent' => 1
            ]);

            // Send SMS
            $userPhone = User::find($userId)?->phone;
            if (!$userPhone) {
                return response()->json(['resp' => false, 'message' => 'User phone number not found.']);
            }

            $smsMessage = "Your loan request exceeds your pre-approved limit. Please consider extending the loan term or reducing the principal amount. Log into your dashboard to adjust your loan terms.";
            $this->send_sms(['phone' => '26'.$userPhone, 'message' => $smsMessage]);

            return response()->json(['resp' => true]);
        } catch (\Throwable $th) {
            dd($th); // Ensure the exception is logged
            return response()->json(['resp' => false, 'message' => 'An error occurred while processing your request.']);
        }
    }

}
