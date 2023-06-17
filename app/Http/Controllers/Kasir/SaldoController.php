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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'user_id' => 'required',
            'saldo' => 'required',
        ]);

        // $users = User::findOrFail($id)
        $saldos = DB::table('users')
        ->join('saldos', 'saldos.user_id', '=', $id)
        ->select('users.*')
        ->get();
        // $saldos = new Saldo;

        $saldos->user_id = $id;
        $saldos->saldo = $request->saldo;
        // $dataUpdate = [
        //     'user_id' => $request[$cekId],
        //     'saldo' => $request['saldo'],
        // ];

        $saldos->save();
        // $saldos->save($dataUpdate);
        // Saldo::create([
        // 'user_id' => $id,
        // 'saldo' => $request->saldo,
        // ]);

        if ($saldos) {
            return redirect()
                ->back();
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
