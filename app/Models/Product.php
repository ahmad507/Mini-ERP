<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['`item_code`, `barcode`, `qty`, `storage_id`, `operator`'];
    public $timestamps = false;

    public function storage()
    {
        return $this->belongsTo(Storage::class, 'storage_id')->select('id', 'barcode');
    }
    
}