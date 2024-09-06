<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanNotification extends Model
{
    use HasFactory;
    protected $fillable = [
        'application_id',
        'user_id', //Borrower
        'notification_type',
        'message',
        'is_accepted',
        'status'
    ];

    public function application(){
        return $this->belongsTo(Application::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
