<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApiConfig extends Model
{
    use HasFactory;

    protected $fillable =   [
        'apiUrl',
        'corporateID',
        'passCode',
        'apiType',
        'created_by'
    ];
}
