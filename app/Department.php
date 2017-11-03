<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = ['name', 'office_phone', 'id'];
    
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
