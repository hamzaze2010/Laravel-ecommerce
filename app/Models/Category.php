<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Category extends Model implements Authenticatable
{
    use \Illuminate\Auth\Authenticatable;
    protected $table = 'category';
    protected $guarded = [];

    public function getImageUrlAttribute()
    {
        return asset('storage/' . $this->image_path);
    }
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
