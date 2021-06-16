<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Storage extends Model
{
    protected $fillable = ['id', 'location_id'];
    public $timestamps = false;

    public function products()
    {
        return $this->hasMany(Product::class)->orderBy('id', 'asc');
    }
    
}
