<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CNStatus extends Model
{
    use HasFactory;
    protected $table = 'esp32_table_dht11_leds_update';
    protected $guarded = [''];
}
