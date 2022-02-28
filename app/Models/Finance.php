<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Finance extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected  $fillable  = [
        'customer_id',
        'date',
        'country',
        'account_type',
        'amount',
        'current_amount',
        'gained_interest',
        'withdrawal',
        'comments'

    ];
}
