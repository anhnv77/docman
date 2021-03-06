<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeDocument extends Model
{
//    protected $fillable = ['name'];
    
    public function documents() {
        return $this->hasMany(Document::class);
    }

    public function getChildren($id){
        $children = $this->where('parent',$id)->get();
        return $children;
    }

    public function getParents()
    {
        $parent = $this->whereNull('parent')->get();
        return $parent;
    }

    public function getParent($id){
        $children = $this->where('id',$id)->get()->first();
        $parent = $this->where('id', $children->parent)->first();
        return $parent;
    }
}
