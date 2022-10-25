<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function manufacturer(){
        return $this->belongsTo(Manufacturer::class);
    }

    
    public function Unit(){
        return $this->belongsTo(Unit::class);
    }
}