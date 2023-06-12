<?php

namespace App\Http\Controllers\Pengelola;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;

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
        $menus = Menu::all();
        return view('pengelola.menu', compact('menus'));
    }

    public function store_menu(Request $request)
    {
        $this->validate($request, [
            'nama_menu' => 'required',
            'jenis_menu_id' => 'required',
            'harga_menu' => 'required',
            'foto_menu' => 'required',
            'stok_menu' => 'required',
        ]);

        $fotoMenu = $request->foto_menu;
        $extension = $fotoMenu->getClientOriginalExtension();
        $namaFoto = 'FotoMenu_' . date('YmdHis') . '.' . $extension;

        $menus = new Menu;
        $menus->nama_menu = $request->nama_menu;
        $menus->jenis_menu_id = $request->jenis_menu_id;
        $menus->harga_menu = $request->harga_menu;
        $menus->foto_menu = $namaFoto;
        $menus->stok_menu = $request->stok_menu;

        $fotoMenu->move(public_path().'/assets/img/menu', $namaFoto);
        $menus->save();

        if ($menus) {
            return redirect()
                ->back();
        } else {
            return redirect()
                ->back();
        }
    }
    public function update_menu(Request $request, $id)
    {
        $this->validate($request, [
            'nama_menu' => 'required',
            'jenis_menu_id' => 'required',
            'harga_menu' => 'required',
            'stok_menu' => 'required',
        ]);

        $menus = Menu::findOrFail($id);
        $awal = $menus->foto_menu;

        if ($request->foto_menu) {
            $request->foto_menu->move(public_path().'/assets/img/menu', $awal);
        }

        $dataUpdate = [
            'nama_menu' => $request['nama_menu'],
            'jenis_menu_id' => $request['jenis_menu_id'],
            'harga_menu' => $request['harga_menu'],
            'foto_menu' => $awal,
            'stok_menu' => $request['stok_menu'],
        ];

        $menus->update($dataUpdate);

        if ($menus) {
            return redirect()
                ->back();
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
