<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'module_id',
        'list',
		'check',
		'create',
		'edit',
		'delete',

    ];
    public function scopeModule_id($query,$value){
        if ($value) {
            return $query->where('module_id','=',$value);
        }
    }
    public function scopeUser_id($query,$value){
        if ($value) {
            return $query->where('user_id','=',$value);
        }
    }
}
