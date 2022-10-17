<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AnandFranchise extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        "name",
        "address",
        "pincode",
        "state",
        "city",
        "ownership",
        "profession",
        "association_with_LPL",
        "mobile",
        "email",
    ];
}
