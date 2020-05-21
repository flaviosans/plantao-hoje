@extends('layouts.admin.app')
@section('content')
@component('comp.box')
    @slot('cabecalho')
        @endslot
    @slot('botoes')
        @endslot
    @slot('conteudo')
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
{{--                    {{$endereco->descricao or 'Sem endereco'}}, {{$endereco->bairro}} - {{$endereco->cep}}--}}
                </div>
                <div class="col-sm-4">
                    {{$cotacao->user->name}} - {{$cotacao->user->telefone()->first()->numero}}
                </div>
                <div>
                    {{$cotacao->telefone()->first()->numero or 'Sem telefone na cotação'}}
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                @component('comp.tabela')
                    @slot('cabecalho')
                        <th>#</th>
                        <th>Produto</th>
                        <th>Quantidade</th>
                    @endslot
                    @slot('conteudo')
                        @foreach($cotacao->item as $cada)
                        <tr>
                            <td>{{$cada->id}}</td>
                            <td>{{$cada->produto->nome}}</td>
                            <td>{{$cada->quantidade}}</td>
                        </tr>
                        @endforeach
                    @endslot
                    @slot('rodape')
                    @endslot
                @endcomponent
            </div>
            <div class="row">

            </div>
        </div>
        @endslot
    @slot('rodape')
        @endslot
    @endcomponent
@endsection