<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $table = 'transaksi';

    protected $fillable = [
        'payment_id',
        'payment_name',
        'total_payment'
    ];

    public function cart()
    {
        return $this->hasMany('App\Models\Cart','transaksi_id','id');
    }
}
