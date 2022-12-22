<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderedTests extends Model
{
    use HasFactory;

    protected $fillable = [
        "order_id",
        "TestId",
        "DosCode",
        "TestName",
        "AliasName1",
        "AliasName2",
        "ApplicableGender",
        "IsPackage",
        "Classifications",
        "TransportCriteria",
        "SpecialInstructionsForPatient",
        "SpecialInstructionsForCorporates",
        "SpecialInstructionsForDoctors",
        "BasicInstruction",
        "DriveThrough",
        "HomeCollection",
        "TestSchedule",
        "TestPrice",
        "TestImages"
    ];
}
