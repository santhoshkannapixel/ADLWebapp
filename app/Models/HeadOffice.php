<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HeadOffice extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        "name",
        "mobile",
        "email",
        "company_name",
        "designation",
        "message",
        "remark"
    ];
}
