<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Balance extends Model
{
    public $timestamps = false;

    public function deposit(float $value) : Array{

        DB::beginTransaction();

        $totalBefore = $this->amount ? $this->amount : 0;
        $this->amount += number_format($value, 2, '.', '');
        $deposit = $this->save();

        $historic = auth()->user()->historic()->create([
            'type'                  =>  'I', 
            'amount'                =>  $value, 
            'total_before'          =>  $totalBefore, 
            'total_after'           =>  $this->amount, 
            'date'                  =>  date('Ymd'),
        ]);

        if($deposit && $historic){
            
            DB::commit();
            return [
                'success'   =>  true, 
                'message'   =>  'Depósito realizado com sucesso!'
            ];
        }else{
            DB::rollback();
            return [
                'success'   =>  'false',
                'massage'   =>  'Falha ao realizar depósito!'
            ];
        } 
    }

    public function withdraw(float $value) : Array{

        if($this->amount < $value){
            return [
                'success'   =>  false, 
                'message'   =>  'Saldo insuficiente!'
            ];
        }
        
        DB::beginTransaction();

        $totalBefore = $this->amount ? $this->amount : 0;
        $this->amount -= number_format($value, 2, '.', '');
        $withdraw = $this->save();

        $historic = auth()->user()->historic()->create([
            'type'                  =>  'O', 
            'amount'                =>  $value, 
            'total_before'          =>  $totalBefore, 
            'total_after'           =>  $this->amount, 
            'date'                  =>  date('Ymd'),
        ]);

        if($withdraw && $historic){
            DB::commit();
            return [
                'success'   =>  true, 
                'message'   =>  'Saque realizado com sucesso!'
            ];

        }else{
            
            DB::rollback();
            return [
                'success'   =>  'false',    
                'massage'   =>  'Falha ao realizar Saque!'
            ];
        } 
    }
}
