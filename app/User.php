<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password', 'avatar', 'role_id', 'username', 'department_id', 'type', 'status', 'created_at'];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $have_role;

    public function department() {
        return $this->belongsTo(Department::class);
    }

    public function documents() {
        return $this->hasMany(Document::class);
    }

    public function role() {
        return $this->hasOne('App\Role', 'id', 'role_id');
    }

    public function hasRole($roles) {
        $this->have_role = $this->getUserRole();
        
        if (is_array($roles)) {
            foreach ($roles as $need_role) {
                if ($this->checkIfUserHasRole($need_role)) {
                    return true;
                }
            }
        } else {
            return $this->checkIfUserHasRole($roles);
        }

        return false;
    }

    public function setRoleId($role_id) {
        $this->role_id = $role_id;
        $this->save();
    }

    public function getUserRole() {
        return $this->role()->first();
    }
    
    private function checkIfUserHasRole($need_role) {
        return (strtolower($need_role) == strtolower($this->have_role->name)) ? true : false;
    }

}
