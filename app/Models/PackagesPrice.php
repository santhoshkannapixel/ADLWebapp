<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackagesPrice extends Model
{
    use HasFactory;

    protected $fillable = [
        'TestId',
        'TestPrice',
        'TestLocation'
    ];
}
