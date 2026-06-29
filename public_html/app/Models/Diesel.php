<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diesel extends Model
{
    use HasFactory;
    protected $guarded = [''];
    public function aset()
    {
        return $this->hasOne('App\Models\Assets', 'id', 'source');
    }

}
