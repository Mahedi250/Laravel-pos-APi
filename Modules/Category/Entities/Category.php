<?php

namespace Modules\Category\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug'];

    protected static function newFactory()
    {
        return \Modules\Category\Database\factories\CategoryFactory::new();
    }



    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function child()
    {

        return $this->hasMany(self::class, 'parent_id', 'id');
    }
}
