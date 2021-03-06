<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\CanResetPassword;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function profile(){
        return $this->belongsTo(Profile::class);
    }
    public function modules(){
        return $this->belongsToMany(Module::class)->withPivot('list', 'check','create', 'edit','delete');
    }

    public function scopeId($query,$value){
        if ($value) {
            return $query->where('id','=',$value);
        }
    }
    public function scopeName($query,$value){
        if ($value) {
        return $query->where('name','like',"%$value%") ;
        }
    }
    public function scopeEmail($query,$value){
        if ($value) {
            return $query->where('email','like',"%$value%");
        }
    }
    public function scopeProfile_id($query,$value){
        if ($value) {
            return $query->where('profile_id','=',$value);
        }
    }
}
