<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;
    
    protected $fillable = ['`code`, `cutting_id`, `treatment`, `sudut`, `class`, `stock`, `empty`, `sch`, `act`, `position`'];
    public $timestamps = false;

    public function cutting()
    {
        return $this->belongsTo(Cutting::class, 'cutting_id')->select('id', 'mesin');
    }

    
}

