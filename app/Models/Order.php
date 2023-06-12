<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $fillable = ['invoice','user_id','status_order_id','metode_pembayaran_id','subtotal'];

    public function status_order() {
        return $this->belongsTo(StatusOrder::class);
    }

    public function detail() {
        return $this->hasMany(OrderDetail::class, 'order_id', 'menu_id', 'qty');
    }
}
