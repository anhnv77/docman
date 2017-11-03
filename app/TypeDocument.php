<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeDocument extends Model
{
    protected $fillable = ['name'];
    
    public function documents() {
        return $this->hasMany(Document::class);
    }
}