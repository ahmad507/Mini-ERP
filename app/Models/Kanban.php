<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kanban extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'status'];
    protected $table = 'cards';
    public $timestamps = false;

    public function orders()
    {
        return $this->hasMany(Order::class)->orderBy('id', 'asc');
    }
}
