<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    use HasFactory;
    protected $fillable = [
        'caption',
        'slug',
        'competition_id',
        'start_date',
        'end_date',
        'quota',
        'status',
    ];

    public function competition(){
    	return $this->belongsTo(Competition::class);
    }

    public function teams(){
    	return $this->belongsToMany(Team::class);
    }
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
    public function scopeCompetition_id($query,$value){
        if ($value) {
            return $query->where('competition_id','=',$value);
        }
    }
    public function scopeStart_date($query,$value){
        if ($value) {
        return $query->where('start_date','>=',"$value") ;
        }
    }
    public function scopeEnd_date($query,$value){
        if ($value) {
            return $query->where('end_date','<=',"$value");
        }
    }
}
