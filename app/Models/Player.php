<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'address',
        'description',
        'vc_segment',
    ];

    public function products(){
        return $this->hasMany(Product::class);
    }
}
