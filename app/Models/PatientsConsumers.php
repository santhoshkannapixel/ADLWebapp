<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PatientsConsumers extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        "name",
        "email",
        "mobile",
        "date",
        "gender",
        "test_for_home_collection",
        "upload_prescription",
        "preferred_date_1",
        "preferred_date_2",
        "preferred_time",
        "address",
        "pincode",
    ];
}
