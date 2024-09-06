<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NRCPhoto extends Model
{
    use HasFactory;

    protected $fillable = [
        'scanned_photo',
        'front_photo',
        'back_photo',
        'selfie_photo',
        'user_id'
    ];

    public function user(){
        $this->belongsTo(User::class);
    }
}
