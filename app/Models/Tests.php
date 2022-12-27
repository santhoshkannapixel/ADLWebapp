<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mockery\Matcher\Subset;

class Tests extends Model
{
    use HasFactory;

    protected $fillable = [
        "TestId",
        "DosCode",
        "TestName",
        "AliasName1",
        "AliasName2",
        "ApplicableGender",
        "IsPackage",
        "Createdon",
        "Modifiedon",
        "Classifications",
        "TransportCriteria",
        "SpecialInstructionsForPatient",
        "SpecialInstructionsForCorporates",
        "SpecialInstructionsForDoctors",
        "BasicInstruction",
        "DriveThrough",
        "HomeCollection",
        "OrganName",
        "HealthCondition",
        "CteateDate",
        "ModifiedDate",
        "TestSchedule",
        "TestPrice",
    ];

    public function TestPrice()
    {
       return $this->hasMany(TestPrice::class, 'TestId', 'id');
    }
}
