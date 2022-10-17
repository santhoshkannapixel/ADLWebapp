<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClinicalLabManagement extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        "doctors_name",
        "specialization",
        "associated_hospitals_Clinics",
        "mobile",
        "email",
        "message",
    ];
}
