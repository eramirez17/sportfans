<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;
    public function competitions(){
    	return $this->belongsToMany(Competition::class);
    }

    public function region(){
    	return $this->belongsTo(Region::class);
    }
    public function sport(){
    	return $this->belongsTo(Sport::class);
    }
    public function stadium(){
    	return $this->belongsTo(Stadium::class);
    }


    protected $fillable = [
        'caption',
        'stadium_id',
        'sport_id',
        'region_id',
        'logo',
        'slug',
        'type',
    ];

    public function scopeId($query,$value){
        if ($value) {
            return $query->where('id','=',$value);
        }
    }
    public function scopeInId($query,$value){
        if ($value) {
            return $query->whereIn('id',[$value]);
        }
    }
    public function scopeCaption($query,$value){
        if ($value) {
        return $query->where('caption','like',"%$value%") ;
        }
    }
    public function scopeStadium_id($query,$value){
        if ($value) {
            return $query->where('stadium_id','like',"%$value%");
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
    public function scopeInRegion_id($query,$value){
        if ($value) {
            $value = explode(',',$value);
            return $query->whereIn('region_id',$value);
        }
    }
    public function scopeType($query,$value){
        if ($value) {
            return $query->where('type','like',"%$value%");
        }
    }
}
