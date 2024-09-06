<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guarantor extends Model
{
    use HasFactory;
    protected $fillable = [
        'email',
        'fname',
        'lname',
        'phone',
        'address',
        'occupation',
        'nrc_no',
        'gender',
        'relation',
        'user_id'
    ];
    protected $appends = [
        'customer'
    ];


    public function getCustomerAttribute()
    {
        $customer = User::where('id', $this->user_id)->first();
        return $customer->fname.' '.$customer->lname;
    }
    
    public function user(){
        $this->belongsTo(User::class, 'user_id');
    }
}
