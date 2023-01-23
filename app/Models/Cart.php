<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'test_id',
        'test_type',
    ];

    public function Tests()
    {
        return $this->hasOne(Tests::class,'id','test_id');
    }
    public function Packages()
    {
        return $this->hasOne(Packages::class,'id','test_id');
    }
}
