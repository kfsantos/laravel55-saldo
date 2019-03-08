<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Balance;
use App\Http\Requests\MoneyValidaionFormRequest;

class BalanceController extends Controller
{
    public function index(){

        $balance = auth()->user()->balance;
        $amount = $balance ? $balance->amount : 0;
        return view('admin.balance.index', compact('amount'));
    }

    public function deposit(){
        // dd(auth()->user()->name);
        return view('admin.balance.deposit');
    }

    //Criado MoneyValidaionFormRequest para fazer as validações no formulário
    public function depositStore(MoneyValidaionFormRequest $request){
        // dd();
        $balance = auth()->user()->balance()->firstOrCreate([]);
        $response = $balance->deposit($request->value);

        if($response['success'])
            return redirect()
                            ->route('admin.balance')
                            ->with('success', $response['message']);


        return redirect()
                        ->back()
                        ->with('error', $response['message']);
    }

    public function withdraw(){
        return view('admin.balance.withdraw');
    }

    public function withdrawStore(MoneyValidaionFormRequest $request){

        // dd($request->all());
        $balance = auth()->user()->balance()->firstOrCreate([]);
        $response = $balance->withdraw($request->value);

        if($response['success'])
            return redirect()
                            ->route('admin.balance')
                            ->with('success', $response['message']);


        return redirect()
                        ->back()
                        ->with('error', $response['message']);
    }
}