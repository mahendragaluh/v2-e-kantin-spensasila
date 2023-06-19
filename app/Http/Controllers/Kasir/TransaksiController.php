<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Order;

class TransaksiController extends Controller
{
    public function index()
    {
        $order = DB::table('orders')
                    ->join('status_orders','status_orders.id','=','orders.status_order_id')
                    ->join('users','users.id','=','orders.user_id')
                    ->join('metode_pembayarans','metode_pembayarans.id','=','orders.metode_pembayaran_id')
                    ->orderBy('id', 'desc')
                    ->select('orders.*', 'status_orders.name', 'users.name as nama_pemesan', 'metode_pembayarans.name as pembayaran')
                    ->where('orders.status_order_id',1)
                    ->get();
        $data = array(
            'orderbaru' => $order
        );

        return view('kasir.transaksi', $data);
    }

    public function detail($id)
    {
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
                    ->select('orders.*','users.name as nama_pelanggan','status_orders.name as status', 'metode_pembayarans.name as pembayaran')
                    ->where('orders.id',$id)
                    ->first();
        $data = array(
            'detail' => $detail_order,
            'order'  => $order
        );
        return view('kasir.detail_transaksi',$data);
    }

    public function konfirmasi($id)
    {
        //function ini untuk mengkonfirmasi bahwa pelanngan sudah melakukan pembayaran
        $order = Order::findOrFail($id);
        $order->status_order_id = 2;
        $order->save();

        $kurangistok = DB::table('Order_details')->where('order_id',$id)->get();
        foreach($kurangistok as $kurang){
            $ambilmenu = DB::table('menus')->where('id',$kurang->menu_id)->first();
            $ubahstok = $ambilmenu->stok_menu - $kurang->qty;

            $update = DB::table('menus')
                    ->where('id',$kurang->menu_id)
                    ->update([
                        'stok_menu' => $ubahstok
                    ]);
        }

        $kurangSaldo = DB::table('saldos')->where('order_id',$id)->get();
        foreach($kurangistok as $kurang){
            $ambilmenu = DB::table('menus')->where('id',$kurang->menu_id)->first();
            $ubahstok = $ambilmenu->stok_menu - $kurang->qty;

            $update = DB::table('menus')
                    ->where('id',$kurang->menu_id)
                    ->update([
                        'stok_menu' => $ubahstok
                    ]);
        }

        return redirect()->route('kasir.transaksi.selesai');
    }

    public function transaksi_selesai()
    {
        $order = DB::table('orders')
                    ->join('status_orders','status_orders.id','=','orders.status_order_id')
                    ->join('users','users.id','=','orders.user_id')
                    ->join('metode_pembayarans','metode_pembayarans.id','=','orders.metode_pembayaran_id')
                    ->orderBy('updated_at', 'desc')
                    ->select('orders.*', 'status_orders.name', 'users.name as nama_pemesan', 'metode_pembayarans.name as pembayaran')
                    ->where('orders.status_order_id',2)
                    ->get();
        $data = array(
            'orderbaru' => $order
        );

        return view('kasir.transaksi_selesai', $data);
    }
}
