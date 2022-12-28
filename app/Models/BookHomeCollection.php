<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookHomeCollection extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        "name",
        "mobile",
        "location",
        "file",
        "test_name",
        "comments",
    ];
}
