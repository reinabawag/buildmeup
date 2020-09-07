<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }

    public function hasAnyRoles($roles)
    {
        return null !== $this->roles()->whereIn('type', $roles)->first();
    }

    public function hasAnyRole($role)
    {
        return null !== $this->roles()->where('type', $role)->first();
    }

    public function status()
    {
        return $this->status;
    }

    public function department()
    {
        return $this->belongsTo('App\Department');
    }

    public function check_if_department($department)
    {
        if ($this->department()->whereIn('name', $department)->first()) {
            return true;
        }

        return false;
    }

    public function items()
    {
        return $this->hasMany('App\Item');
    }

    public function vendors()
    {
        return $this->hasMany('App\Vendor');
    }
}
