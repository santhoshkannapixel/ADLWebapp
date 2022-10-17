<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HospitalLabManagement extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        "hospital_name",
        "hospital_address",
        "name",
        "designation",
        "mobile",
        "email",
        "message",
    ];
}
