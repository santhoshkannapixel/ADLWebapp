<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tests extends Model
{
    use HasFactory;

    protected $fillable = [
        "image",
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
    ];

    public function getImageAttribute($value)
    {
        return asset_url($value);
    }

    public function TestPrice()
    {
       return $this->hasMany(TestPrice::class, 'TestId', 'id');
    }

    public function SubTests()
    {
       return $this->hasMany(SubTests::class, 'TestID', 'id');
    }
}
