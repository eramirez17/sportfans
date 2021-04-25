<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sport extends Model
{
    use HasFactory;
    public function competitions(){
    	return $this->hasMany(Competition::class);
    }
    public function teams(){
    	return $this->hasMany(Team::class);
    }
    protected $fillable = [
        'caption',
        'picture',
        'slug',
    ];
     //query scopes
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
}
