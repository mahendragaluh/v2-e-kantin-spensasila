<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    use HasFactory;

    protected $table = 'keranjangs';
    protected $fillable = ['user_id','menu_id','qty'];

    // function untuk update qty, sama subtotal
    public function updatedetail($itemdetail, $qty,) {
        $this->attributes['qty'] = $itemdetail->qty + $qty;
        self::save();
    }
}
