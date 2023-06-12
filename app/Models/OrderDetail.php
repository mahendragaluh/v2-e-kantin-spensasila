<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $table = 'order_details';
    protected $fillable = ['order_id','menu_id','qty'];

    public function menu() {
        return $this->hasMany(Menu::class);
    }
}
