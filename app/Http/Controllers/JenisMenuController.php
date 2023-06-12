<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\JenisMenu;

class JenisMenuController extends Controller
{
    public function menuByJenisMenu($id)
    {
       //menampilkan data sesua kategori yang diminta user
       $kat = DB::table('jenis_menus')
                ->join('menus','menus.jenis_menu_id','=','jenis_menus.id')
                ->select(DB::raw('count(menus.jenis_menu_id) as jumlah, jenis_menus.*'))
                ->groupBy('jenis_menus.id')
                ->get();
        $data = array(
            'menus' => Menu::where('jenis_menu_id',$id)
                            ->join('jenis_menus', 'jenis_menus.id', '=', 'menus.jenis_menu_id')
                            ->select('menus.*', 'jenis_menus.name as kategori')
                            ->paginate(6),
            'jenis_menus' => JenisMenu::findOrFail($id),
            'kategori_menu' => $kat
        );
        return view('user.jenis_menu', $data);
    }
}
