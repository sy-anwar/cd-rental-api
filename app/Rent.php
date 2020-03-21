<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rent extends Model 
{
    /**
     * 
     */
    protected $fillable = [
        'customer', 'id_cd', 'price'
    ];

    protected $attributes = [
        'price' => 0,
     ];
 
}
