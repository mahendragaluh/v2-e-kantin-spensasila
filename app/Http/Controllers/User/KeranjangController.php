<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Keranjang;
use App\Models\Menu;
use Auth;
class KeranjangController extends Controller
{
    public function index()
    {

        $id_user = Auth::user()->id;
        $keranjangs = DB::table('keranjangs')
                            ->join('users','users.id','=','keranjangs.user_id')
                            ->join('menus','menus.id','=','keranjangs.menu_id')
                            ->select('keranjangs.id as id_keranjang','menus.nama_menu','menus.foto_menu','users.name','keranjangs.*','menus.harga_menu', 'menus.stok_menu as stock')
                            ->where('keranjangs.user_id','=',$id_user)
                            ->get();

        return view('user.keranjang', compact('keranjangs'));
    }

    public function simpan(Request $request, $id)
    {
        // Keranjang::create([
        //     'user_id' => $request->user_id,
        //     'menu_id' => $request->menu_id,
        //     'qty' => $request->qty
        // ]);

        $menus = Menu::findOrFail($id);
        $keranjang = Keranjang::where('menu_id', $id)->first();

        if (!empty($keranjang)) {
            $tambahKeranjang = DB::table('keranjangs')->where('menu_id', $id)->get();
            foreach($tambahKeranjang as $tamKer){
            $addKeranjang = $tamKer->qty + 1;

            $update = DB::table('keranjangs')
                    ->where('menu_id', $id)
                    ->update([
                        'qty' => $addKeranjang
                    ]);
            }
        } else {
            Keranjang::create([
                'user_id' => $request->user_id,
                'menu_id' => $request->menu_id,
                'qty' => $request->qty
            ]);
        }

        return redirect()->back();
    }

    public function update(Request $request, $id_keranjang)
    {
        $itemdetail = Keranjang::findOrFail($id_keranjang);
        $param = $request->param;

        if ($param == 'tambah') {
            // update detail cart
            $qty = 1;
            $itemdetail->updatedetail($itemdetail, $qty);
            return back();
        }
        if ($param == 'kurang') {
            // update detail cart
            $qty = 1;
            if ($itemdetail->qty <= 1) {
                Keranjang::destroy($id_keranjang);
            } else {
                $itemdetail->updatedetail($itemdetail, '-'.$qty);
            }
            return back();
        }
    }
}
