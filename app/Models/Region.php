<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;
    public function parent(){
    	return $this->belongsTo(Region::class);
    	/*e.g.
    	region = europe
    	parent = world
    	*/
    }
    public function children(){
    	return $this->hasMany(Region::class);
    	/*e.g.
    	region = europe
    	children = spain, england, italy, france
    	*/
    }

    public function competitions(){
    	return $this->hasMany(Competition::class);
    }
    public function teams(){
    	return $this->hasMany(Team::class);
    }

    protected $fillable = [
        'caption',
        'abstract',
        'link',
        'picture',
        'parent_id',
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
    public function scopeParent_id($query,$value){
        if ($value) {
            return $query->where('parent_id','=',$value);
        }
    }
}
