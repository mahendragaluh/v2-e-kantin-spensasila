<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Menu;

class HomeUserController extends Controller
{
    public function index()
    {
        $kat = DB::table('jenis_menus')
                ->join('menus','menus.jenis_menu_id','=','jenis_menus.id')
                ->select(DB::raw('count(menus.jenis_menu_id) as jumlah, jenis_menus.*'))
                ->groupBy('jenis_menus.id')
                ->get();
        $mns = DB::table('menus')
                ->join('jenis_menus', 'jenis_menus.id', '=', 'menus.jenis_menu_id')
                ->select('menus.*', 'jenis_menus.name as kategori')
                ->paginate(6);
        $qty = DB::table('keranjangs')
                ->join('menus', 'menus.id', '=', 'keranjangs.menu_id')
                ->select('keranjangs.*', 'keranjangs.qty as stock')
                ->get();

        $data = array(
            // 'menus' => Menu::paginate(6),
            'menus' => $mns,
            'jenis_menus' => $kat,
            'keranjangs' => $qty
        );
        return view('user.home', $data);
    }
}
