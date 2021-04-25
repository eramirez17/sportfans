<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
    use HasFactory;
    public function seasons(){
    	return $this->HasMany(Season::class);
    }

    public function region(){
    	return $this->belongsTo(Region::class);
    }

    public function sport(){
    	return $this->belongsTo(Sport::class);
    }
    protected $fillable = [
        'caption',
        'abstract',
        'logo',
        'slug',
        'sport_id',
        'region_id',
        'type',
    ];
    public function scopeId($query,$value){
        if ($value) {
            return $query->where('id','=',$value);
        }
    }
    public function scopeCaption($query,$value){
        if ($value) {
        return $query->where('caption','like',"%$value%") ;
        }
    }
    public function scopeSport_id($query,$value){
        if ($value) {
            return $query->where('sport_id','=',$value);
        }
    }
    public function scopeRegion_id($query,$value){
        if ($value) {
            return $query->where('region_id','=',$value);
        }
    }
}
