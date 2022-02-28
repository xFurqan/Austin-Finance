<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = [
        'account_number',
        'account_title',
        'interest_rate',
        'name',
        'surname',
        'password',
        'login',
        'email',
        'status',
    ];
    public function Finance()
    {
        return $this->hasMany('App\Models\Finance' , 'customer_id');
    }
}
