<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicineInventory extends Model
{
    use HasFactory;
    protected $guarded = [''];
    public function medicine()
    {
        return $this->hasOne('App\Models\Medicine', 'id', 'item_id');
    }
}
