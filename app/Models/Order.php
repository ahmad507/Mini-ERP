<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['item_code', 'qty', 'machine_bld', 'oprt','kanban_id','flag','note','created_at'];
    protected $dates = ['empty','created_at'];
    public $timestamps = false;

    public function kanban()
    {
        return $this->belongsTo(Kanban::class, 'id')->select('id', 'status');
    }
    
}
