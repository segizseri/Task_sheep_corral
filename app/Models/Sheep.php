<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Corral;

class Sheep extends Model
{

    	
    public static function isCorralEmpty()
	{
		$sheep = Sheep::latest()->first();

		return empty($sheep->id);
	}

    public function corral()
    {
        return $this->belongsTo('App\Models\Corral');
    }

    public static function lastSheepId()
    {
        $alllist = Sheep::orderby('id', 'desc')->first();
        return $alllist->id;
    }

    public static function countSheep()
    {
        $count = Sheep::get()->count();

        return $count; 
    }

}

