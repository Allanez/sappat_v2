<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Municipality extends Model
{
    use HasFactory;

    public function province(){
        return $this->belongsTo(Province::class);
    }

    public function barangays(){
        return $this->hasMany(Barangay::class);
    }

    public function players(){
        return $this->hasMany(Player::class);
    }
    public function organizations(){
        return $this->morphMany('App\Models\Organization', 'geographic');
    }

    public static function with_players(){
        return DB::table('players')
            ->leftJoin('municipalities', 'players.municipality_id','=', 'municipalities.id')
            ->leftJoin('provinces', 'provinces.id','=','municipalities.province_id')
            ->select(DB::raw("concat(municipalities.name,', ',provinces.name) as location, count(*) as hits"))
            ->groupByRaw('municipalities.name, provinces.name')
            ->limit(10)
            ->get();
    }
}
