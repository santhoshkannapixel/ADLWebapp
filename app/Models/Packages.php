<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Packages extends Model
{
    use HasFactory;
    protected $fillable = [
        "TestId",
        "TestSlug",
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

    public function SubTestList()
    {
       return $this->hasMany(SubTests::class, 'TestID', 'id');
    }

    public function PackagesPrice()
    {
       return $this->hasMany(PackagesPrice::class, 'TestId', 'id');
    }
}
