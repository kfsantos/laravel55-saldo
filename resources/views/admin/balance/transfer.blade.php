@extends('adminlte::page')

@section('title', 'Nova Transferência...')

@section('content_header')
    <h1>Fazer Transferência</h1>
    <ol class="breadcrumb">
        <li><a href="">Dashboard</a></li>
        <li><a href="">Saldo</a></li>
        <li><a href="">Transferir</a></li>
    </ol>
@stop

@section('content')
    <div class="box">
        <div class="box-header">
            <h3>Transferência de Saldo (informe o Recebedor)</h3>
        </div>
        <div class="box-body">
           @include('admin.includes.alerts')
            <form action="{{ route('confirm.transfer') }}" method="post">
                {!! csrf_field()!!}
                <div class="form-group">
                    <input class="form-control" type="text" placeholder="Informação de quem vai receber o saque" name="sender">
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-success">Próxima Etapa </button>
                </div>
             </form>
        </div>
    </div>
@stop