<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Career extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'job_id',
        'name',
        'email',
        'mobile',
        'file',
        'message',
        'status'
    ];
    public function job()
    {
        return $this->hasOne(JobPost::class,'id','job_id')->select('title','code','id');
    }
}
