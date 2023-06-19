<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Saldo;

class SaldoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = DB::table('users')
                ->join('levels','levels.id','=','users.level_id')
                ->select('users.*', 'levels.name_level as level')
                ->orderBy('id', 'ASC')
                ->where('users.level_id',4)
                ->get();
        // $users = User::orderBy('id', 'ASC')->get();
        return view('kasir.top_up', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function add_topUp(string $id)
    {
        $data = array(
            'users' => User::findOrFail($id),
        );
        return view('kasir.add_top_up',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $users = User::findOrFail($id);
        $saldos = Saldo::all()->first();

        if ($saldos->saldo->isEmpty($saldos->saldo)) {
            Saldo::create([
                'user_id' => $id,
                'saldo' => $request->saldo,
            ]);
        } else {
            $tambahSaldo = DB::table('saldos')->where('user_id',$id)->get();
            foreach($tambahSaldo as $tambah){
            $addSaldo = $tambah->saldo + $request->saldo;

            $update = DB::table('saldos')
                    ->where('user_id',$id)
                    ->update([
                        'saldo' => $addSaldo
                    ]);
            }
        }

        if ($users) {
            return redirect()
            ->route('top_up.kasir');
        } else {
            return redirect()
                ->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
