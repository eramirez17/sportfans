<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stadium extends Model
{
    use HasFactory;
    protected $table = 'stadiums';
    public function teams(){
    	return $this->hasMany(Team::class);
    }
    protected $fillable = [
        'caption',
        'capacity',
        'abstract',
        'picture',
        'slug',
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
    public function scopeCapacity($query,$value){
        if ($value) {
            return $query->where('capacity','>=',$value);
        }
    }
}
