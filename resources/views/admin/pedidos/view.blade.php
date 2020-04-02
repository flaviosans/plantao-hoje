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
                <div class="col-sm-12">
                    {{$endereco->descricao or 'Sem endereco'}}
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                @component('comp.tabela')
                    @slot('cabecalho')
                        <th>#</th>
                        <th>Produto</th>
                        <th>Preço</th>
                        <th>Quantidade</th>
                        <th>Total</th>
                    @endslot
                    @slot('conteudo')
                        @foreach($pedido->item as $cada)
                        <tr>
                            <td>{{$cada->id}}</td>
                            <td>{{$cada->produto->nome}}</td>
                            <td>{{$cada->preco_promocao}}</td>
                            <td>{{$cada->quantidade}}</td>
                            <td>{{$cada->quantidade * $cada->preco_promocao}}</td>
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