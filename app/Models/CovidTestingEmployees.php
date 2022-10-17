<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CovidTestingEmployees extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        "customer_name",
        "mobile",
        "email",
        "company_name",
        "state",
        "city",
        "pincode",
        "number_of_employees",
        "how_can_we_help_you",
        "comments",
    ];
}
