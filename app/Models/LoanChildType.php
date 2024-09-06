<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanChildType extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'type_name',
        'decription',
        'loan_type_id',
    ];

    public function loan_type(){
        return $this->belongsTo(LoanType::class, 'loan_type_id');
    }

    public function loan_products(){
        return $this->hasMany(LoanProduct::class);
    }
}
