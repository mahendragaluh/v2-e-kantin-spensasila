<?php

namespace App\Http\Controllers\Pengelola;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Menu;
use App\Models\JenisMenu;

class HomePengelolaController extends Controller
{
    public function index()
    {
        return view('pengelola.home');
    }

    public function pemesanan()
    {
        return view('waiter.pemesanan');
    }

    public function menu()
    {
        $menus = DB::table('menus')
                ->join('jenis_menus', 'jenis_menus.id', '=', 'menus.jenis_menu_id')
                ->select('menus.*', 'jenis_menus.name as kategori')
                ->get();

        return view('pengelola.menu', compact('menus'));
    }

    public function store_menu(Request $request)
    {
        if($request->file('foto_menu')){
            $file = $request->file('foto_menu')->store('menu','public');

            Menu::create([
                'nama_menu' => $request->nama_menu,
                'jenis_menu_id' => $request->jenis_menu_id,
                'harga_menu' => $request->harga_menu,
                'foto_menu' => $file,
                'stok_menu' => $request->stok_menu,
            ]);

        return redirect()->back();
        }
    }

    public function edit_menu($id)
    {
        $data = array(
            'menus' => Menu::findOrFail($id),
            'jenis_menus' => JenisMenu::all(),
        );
        return view('pengelola.editMenu',$data);
    }

    public function update_menu(Request $request, $id)
    {
        $menus = Menu::findOrFail($id);

        if( $request->file('foto_menu')){
            Storage::delete('public/'.$menus->foto_menu);
            $file = $request->file('foto_menu')->store('menu','public');
            $menus->foto_menu = $file;
        }

        $tambahStok = DB::table('menus')->where('id',$id)->get();
            foreach($tambahStok as $tambah){
            $addStok = $tambah->stok_menu + $request->stok_menu;

            $update = DB::table('menus')
                    ->where('id',$id)
                    ->update([
                        'stok_menu' => $addStok
                    ]);
            }

        $menus->nama_menu = $request->nama_menu;
        $menus->jenis_menu_id = $request->jenis_menu_id;
        $menus->harga_menu = $request->harga_menu;
        $menus->save();

        if ($menus) {
            return redirect()
                ->route('pengelola.menu');
        } else {
            return redirect()
                ->back();
        }
    }

    public function destroy_menu($id)
    {
        $menus = Menu::findOrFail($id);

        if ($menus) {

            if(File::exists(public_path('assets/img/menu/'.$menus->foto_menu))) {
                File::delete(public_path('assets/img/menu/'.$menus->foto_menu));
            }

            $menus->delete();

            return redirect()
                ->back();
        } else {
            return redirect()
                ->back();
        }
    }
}
