<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanManualApprover extends Model
{
    use HasFactory;
    protected $fillable = [
        'added_by',
        'application_id',
        'user_id',
        'is_passed',
        'is_processing',
        'is_active',
        'priority',
        'status',
        'reason',
        'estimate'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function applications(){
        return $this->hasMany(Application::class, 'application_id');
    }

}
