<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'total',
        'payer_name',
        'receiver_name',
        'due_date',
        'payer',
        'receiver',
        'pay'
    ];
}
