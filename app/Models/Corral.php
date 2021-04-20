<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Corral extends Model
{

        public function sheep()
    {
        return $this->hasMany('App\Models\Sheep');
    }


    
}
