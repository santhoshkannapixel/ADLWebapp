<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'payment_id',
        'razorpay_order_id',
        'user_id',
        'appoinment',
        'datetime',
        'payment_status',
        'order_status',
        'order_response',
        'order_amount',
        'cancel_order_reason'
    ];

    public function Tests()
    {
       return $this->hasMany(OrderedTests::class, 'order_id', 'id');
    }

    public function User()
    {
       return $this->hasOne(User::class, 'id', 'user_id');
    }
}
