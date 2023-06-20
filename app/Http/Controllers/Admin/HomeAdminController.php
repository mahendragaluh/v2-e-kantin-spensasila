<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Exports\UsersExport;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Level;
use App\Models\Menu;
use App\Models\User;

class HomeAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $menus = Menu::all();
        return view('admin.home', compact('menus'));
    }

    public function users(Request $request)
    {
        $users = DB::table('users')
                ->join('levels','levels.id','=','users.level_id')
                ->select('users.*', 'levels.name_level as level')
                ->orderBy('id', 'ASC')
                ->get();
        // $users = User::orderBy('id', 'ASC')->get();
        return view('admin.pengguna.users', compact('users'));
    }

    public function export()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }

    public function import()
    {
        Excel::import(new UsersImport,request()->file('file'));

        return back();
    }

    public function create_users(Request $request)
    {
        $addUsers = new User;
        $addUsers->level_id = $request->level_id;
        $addUsers->id_siswa = $request->id_siswa;
        $addUsers->username_nisn = $request->username_nisn;
        $addUsers->name = $request->name;
        $addUsers->kelas = $request->kelas;
        $addUsers->no_hp = $request->no_hp;
        $addUsers->password = Hash::make($request->password);
        $addUsers->save();

        if ($addUsers) {
            return redirect()
                ->back();
        } else {
            return redirect()
                ->back();
        }
    }

    public function destroy_users($id)
    {
        $users = User::findOrFail($id);
        $users->delete();

        if ($users) {
            return redirect()
                ->back();
        } else {
            return redirect()
                ->back();
        }
    }

    public function level()
    {
        $levels = Level::orderBy('id', 'ASC')->get();
        return view('admin.pengguna.level', compact('levels'));
    }

    public function store_level(Request $request)
    {
        $this->validate($request, [
            'name_level' => 'required',
        ]);

        $levels = new Level;
        $levels->name_level = $request->name_level;
        $levels->save();

        if ($levels) {
            return redirect()
                ->back();
        } else {
            return redirect()
                ->back();
        }
    }

    public function update_level(Request $request, $id)
    {
        $this->validate($request, [
            'name_level' => 'required',
        ]);

        $levels = Level::findOrFail($id);

        $levels->update([
            'name_level' => $request->name_level,
        ]);

        if ($levels) {
            return redirect()
                ->back();
        } else {
            return redirect()
                ->back();
        }
    }

    public function menu()
    {
        $menus = DB::table('menus')
                ->join('jenis_menus','jenis_menus.id','=','menus.jenis_menu_id')
                ->select('menus.*','jenis_menus.name as nama_jm')
                ->get();
        $data = array(
            'menus' => $menus
        );
        return view('admin.menu', $data);
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

    public function edit_menu($id)
    {
        $data = array(
            'menus' => Menu::findOrFail($id),
            'jenis_menus' => JenisMenu::all(),
        );
        return view('admin.editMenu',$data);
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

    public function order()
    {
        $menus = Menu::all();
        return view('admin.order', compact('menus'));
    }

    public function transaksi()
    {
        return view('admin.transaksi');
    }

    public function pemesanan()
    {
        return view('admin.pemesanan');
    }
}
