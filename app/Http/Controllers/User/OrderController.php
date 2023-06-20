<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use Auth;

class OrderController extends Controller
{
    public function index()
    {
        //menampilkan semua data pesanan
        $user_id = Auth::user()->id;

        $order = DB::table('orders')
                    ->join('status_orders','status_orders.id','=','orders.status_order_id')
                    ->join('metode_pembayarans','metode_pembayarans.id','=','orders.metode_pembayaran_id')
                    ->select('orders.*', 'status_orders.name', 'metode_pembayarans.name as pembayaran')
                    ->orderBy('created_at', 'desc')
                    ->where('orders.keterangan',"Sedang Diproses")
                    ->where('orders.user_id',$user_id)->get();
        $data = array(
            'order' => $order,
        );

        return view('user.order', compact('order'));
    }

    public function detail($id)
    {
        //function menampilkan detail order
        $detail_order = DB::table('order_details')
        ->join('menus','menus.id','=','order_details.menu_id')
        ->join('orders','orders.id','=','order_details.order_id')
        ->select('menus.nama_menu','menus.foto_menu','order_details.*','menus.harga_menu','orders.*')
        ->where('order_details.order_id',$id)
        ->get();
        $order = DB::table('orders')
        ->join('users','users.id','=','orders.user_id')
        ->join('status_orders','status_orders.id','=','orders.status_order_id')
        ->join('metode_pembayarans','metode_pembayarans.id','=','orders.metode_pembayaran_id')
        ->select('orders.*', 'status_orders.name as status', 'metode_pembayarans.name as pembayaran')
        ->where('orders.id',$id)
        ->first();
        $data = array(
        'detail' => $detail_order,
        'order'  => $order
        );
        return view('user.detail_order', $data);
    }

    public function simpan(Request $request)
    {
        //untuk menyimpan pesanan ke table order
        $userid = Auth::user()->id;
        Order::create([
            'invoice' => $request->invoice,
            'user_id' => $userid,
            'subtotal'=> $request->subtotal,
            'status_order_id' => 2,
            'metode_pembayaran_id' => $request->metode_pembayaran_id,
            'keterangan' => 'Sedang Diproses',
        ]);

        $order = DB::table('orders')->where('invoice',$request->invoice)->first();

        $barang = DB::table('keranjangs')->where('user_id',$userid)->get();
        //lalu masukan barang2 yang dibeli ke table detail order
        foreach($barang as $brg){
            OrderDetail::create([
                'order_id' => $order->id,
                'menu_id' => $brg->menu_id,
                'qty' => $brg->qty,
            ]);
        }
        //lalu hapus data produk pada keranjang pembeli
        DB::table('keranjangs')->where('user_id',$userid)->delete();

        $kurangistok = DB::table('order_details')->where('order_id',$order->id)->get();
        foreach($kurangistok as $kurang){
            $ambilmenu = DB::table('menus')->where('id',$kurang->menu_id)->first();
            $ubahstok = $ambilmenu->stok_menu - $kurang->qty;

            $update = DB::table('menus')
                    ->where('id',$kurang->menu_id)
                    ->update([
                        'stok_menu' => $ubahstok
                    ]);
        }

        $kurangiSaldo = DB::table('orders')->where('id',$order->id)->get();
        foreach($kurangiSaldo as $kurangSaldo){
            $ambilSaldo = DB::table('saldos')->where('saldos.user_id',$kurangSaldo->user_id)->first();
            $ubahSaldo = $ambilSaldo->saldo - $kurangSaldo->subtotal;

            $update = DB::table('saldos')
                    ->where('saldos.user_id',$kurangSaldo->user_id)
                    ->update([
                        'saldo' => $ubahSaldo
                    ]);
        }

        return redirect()->route('user.dashboard');
    }
}
