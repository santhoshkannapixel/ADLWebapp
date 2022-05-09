<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    protected $fillable = [
        "BranchId",
        "BranchCode",
        "BranchName",
        "BranchCityId",
        "BranchCity",
        "BranchAddress",
        "BrachContact",
        "BranchEmail",
        "IsProcessingLocation",
        "BranchTimings",
        "State",
        "Pincode",
        "Country"
    ];
}
