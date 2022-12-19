<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsEvent extends Model
{
    use HasFactory;
    protected $fillable =[
        'title',
        'slug',
        'description',
        'posted_by',
    ];
    public function getCreatedAtAttribute($value) {
        return Carbon::parse($value)->format(config('app.date_format'));
    }
}
