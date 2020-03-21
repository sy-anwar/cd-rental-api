<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CdCollection extends Model 
{
    /**
     * 
     */
    protected $fillable = [
        'title', 'rate', 'category', 'quantity'
    ];

}
