<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [ 'full_name', 'age', 'email', 'phone'  ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'customer_id', 'id');
    }

}