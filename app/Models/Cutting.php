<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cutting extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'cutting_id','capacity','position'];
    public $timestamps = false;

    public function schedules()
    {
        return $this->hasMany(Schedule::class)->orderBy('id', 'asc');
    }
    

    
}


