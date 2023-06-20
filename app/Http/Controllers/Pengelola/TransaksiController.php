<?php

namespace App\Http\Controllers\Pengelola;

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
                    ->where('orders.keterangan', "Sedang Diproses")
                    ->get();
        $data = array(
            'orderbaru' => $order
        );

        return view('pengelola.transaksi', $data);
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
        return view('pengelola.detail_transaksi',$data);
    }

    public function konfirmasi_pesananSiap($id)
    {
        //function ini untuk mengkonfirmasi bahwa pelanngan sudah melakukan pembayaran
        $order = Order::findOrFail($id);
        $order->keterangan = 'Selesai';
        $order->save();

        return redirect()->back();
    }

    public function transaksi_pesananSiap()
    {
        $order = DB::table('orders')
                    ->join('status_orders','status_orders.id','=','orders.status_order_id')
                    ->join('users','users.id','=','orders.user_id')
                    ->join('metode_pembayarans','metode_pembayarans.id','=','orders.metode_pembayaran_id')
                    ->orderBy('updated_at', 'desc')
                    ->select('orders.*', 'status_orders.name', 'users.name as nama_pemesan', 'metode_pembayarans.name as pembayaran')
                    ->where('orders.keterangan',"Pesanan Siap")
                    ->get();
        $data = array(
            'orderbaru' => $order
        );

        return view('pengelola.transaksi_pesananSiap', $data);
    }

    public function konfirmasi($id)
    {
        //function ini untuk mengkonfirmasi bahwa pelanngan sudah melakukan pembayaran
        $order = Order::findOrFail($id);
        $order->keterangan = 'Pesanan Siap';
        $order->save();

        return redirect()->route('pengelola.transaksi');
    }

    public function transaksi_selesai()
    {
        $order = DB::table('orders')
                    ->join('status_orders','status_orders.id','=','orders.status_order_id')
                    ->join('users','users.id','=','orders.user_id')
                    ->join('metode_pembayarans','metode_pembayarans.id','=','orders.metode_pembayaran_id')
                    ->orderBy('updated_at', 'desc')
                    ->select('orders.*', 'status_orders.name', 'users.name as nama_pemesan', 'metode_pembayarans.name as pembayaran')
                    ->where('orders.keterangan',"Selesai")
                    ->get();
        $data = array(
            'orderbaru' => $order
        );

        return view('pengelola.transaksi_selesai', $data);
    }
}
