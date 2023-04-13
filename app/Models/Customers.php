<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    use HasFactory;
    protected $table = 'customer';

    protected $fillable = [
        'customer_name',
    ];

    public function address()
    {
        return $this->hasOne('App\Models\Address','customer_id','id')->select('address','customer_id');
    }
}
