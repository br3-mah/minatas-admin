<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanExpense extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'amount',
        'date',
        'type',
        'status',
        'application_id'
    ];

    public function loan(){
        return $this->belongsTo(Application::class);
    }

}
