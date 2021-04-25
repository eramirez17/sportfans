<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;
    protected $fillable = [
        'caption',
    ];
    public function users(){
        return $this->belongsToMany(User::class)->withPivot('list', 'check','create', 'edit','delete');
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
}
