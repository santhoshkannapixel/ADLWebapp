<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubTests extends Model
{
    use HasFactory;
    protected $fillable = [
        "SubTestId",
        "SubTestDOSCode",
        "SubTestName",
    ];
}
