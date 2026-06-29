<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProtienFarm extends Model
{
    use HasFactory;
    protected $guarded = [''];
    public function tender()
    {
        return $this->hasOne('App\Models\FarmSession', 'id', 'active_session');
    }

}
