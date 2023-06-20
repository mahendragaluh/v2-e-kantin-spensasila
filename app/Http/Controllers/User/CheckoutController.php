<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        //ambil session user id
        $id_user = Auth::user()->id;
        //ambil produk apa saja yang akan dibeli user dari table keranjang
        $keranjangs = DB::table('keranjangs')
                            ->join('users','users.id','=','keranjangs.user_id')
                            ->join('menus','menus.id','=','keranjangs.menu_id')
                            ->select('menus.nama_menu','menus.foto_menu','users.name','keranjangs.*','menus.harga_menu')
                            ->where('keranjangs.user_id','=',$id_user)
                            ->get();
        $saldos = DB::table('saldos')
                    ->select('saldos.*')
                    ->where('saldos.user_id', '=', $id_user)
                    ->first();

        //buat kode invoice sesua tanggalbulantahun dan jam
        $data = [
            'invoice' => 'INV'.Date('Ymdhi'),
            'keranjangs' => $keranjangs,
            'saldos' => $saldos,
        ];
        return view('user.checkout',$data);
    }
}
