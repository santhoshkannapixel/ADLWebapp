<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobPost extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'id',
        'title',
        'code',
        'location',
        'department_id',
        'experience',
        'responsibilities',
        'qualification',
        'no_of_requirement',
        'status',
    ];
    public function department()
    {
       return $this->hasOne(Department::class,'id','department_id')->select('name','id');
    }
}
