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
        "Classifications",
        "TransportCriteria",
        "SpecialInstructionsForPatient",
        "SpecialInstructionsForCorporates",
        "SpecialInstructionsForDoctors",
        "BasicInstruction",
        "DriveThrough",
        "HomeCollection",
        "CteateDate",
        "ModifiedDate",
        "TestSchedule",
        "TestPrice",
        "TestImages"
    ];

    public function SubTestList()
    {
       return $this->hasMany(SubTests::class, 'TestId', 'id');
    }
}