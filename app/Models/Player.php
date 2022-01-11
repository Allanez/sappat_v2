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
        'barangay_id',
        'data_source',
    ];

    public function products(){
        return $this->hasMany(Product::class);
    }

    public function barangay(){
        return $this->belongsTo(Barangay::class);
    }

    public function address(){
        if($this->barangay){
            return $this->barangay->name.", ".$this->barangay->municipality->name.", ".$this->barangay->municipality->province->name;
        }
    }
}
