<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    public function sells()
    {
        return $this->hasMany(Sell::class);
    }
}
