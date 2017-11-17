
@extends('layouts.admin.app')

@section('content')
    @component('comp.box')
        @slot('cabecalho')
            <script>
                    $("input, button").keydown(function(e) {
                        if(e.keyCode == 13) {
                            var elem = $(this).next();
                            if(elem.is("button")) {
                                elem.focus();
                            }
                            $(this).next("input").focus();
                        }
                    });
            </script>
            @if(isset($campanha))
            <a class="btn btn-default" href="{{route('campanhas.ofertas.create', $campanha->id)}}">Novo</a>
            @endif

        @endslot
        @slot('conteudo')
            @component('comp.tabela')
            @slot('cabecalho')
                <tr>
                    <th>#</th>
                    <th>Código de Barras</th>
                    <th>Produto</th>
                    @if(!isset($campanha))
                        <th>Campanha</th>
                    @endif
                    <th>Preço Normal</th>
                    <th>Preço Promoção</th>
                    <th>Quantidade</th>
                    <th>Ações</th>
                </tr>
                <form id="ofertaeproduto" action="{{route('campanhas.ofertas.store', $campanha->id)}}" method="POST">
                    {{csrf_field()}}
                    <tr>
                        <td>0</td>
                        <td><input type="text" name="codigo_barras"></td>
                        <td>
                            <select class="buscar-produto" name="produto_id">
                                    <option value=""> </option>
                            @foreach(\App\Produto::all() as $produto)}}
                                    <option value="{{$produto->id}}">{{$produto->nome}}</option>
                            @endforeach}}
                            </select>
                        </td>
                        <td><input type="text" name="preco_normal" value="{{old('preco_normal')}}"></td>
                        <td>
                            <input type="text" name="preco_promocao" value="{{old('preco_promocao')}}">
                        </td>
                        <td>
                            <input type="text" name="quantidade" value="{{old('quantidade')}}">
                        </td>

                        <td>
                            <a href="#" onclick="event.preventDefault(); document.getElementById('ofertaeproduto').submit();">Salvar</a>
                        </td>
                    </tr>
                </form>
            @endslot
            @slot('conteudo')
                @foreach($ofertas as $cada)
                    <tr>
                        <td>{{$cada->id}}</td>
                        <td>{{$cada->produto->codigo_barras}}</td>
                        <td>{{$cada->produto->nome}}</td>
                        @if(!isset($campanha))
                        <td><a href="{{route('campanhas.ofertas.index', $cada->campanha->id)}}">{{$cada->campanha->titulo}}</a></td>
                        @endif
                        <td>{{$cada->preco_normal}}</td>
                        <td>{{$cada->preco_promocao}} {{$cada->quantidade != null  && $cada->quantidade > 0 ? ' - ' .  $cada->quantidade . ' unidades' : ''}}</td>
                        <td></td>
                        <td>
                            <a href="#" onclick="event.preventDefault(); document.getElementById('delete-{{$cada->id}}').submit();">Apagar</a> |
                            <a href="{{route('campanhas.ofertas.edit', [$cada->campanha->id, $cada->id])}}">Editar</a>
                            <form id="delete-{{$cada->id}}" action="{{route('campanhas.ofertas.destroy', [$cada->campanha->id, $cada->id])}}" method="POST">
                                {{method_field('DELETE')}}
                                {{csrf_field()}}
                            </form>
                        </td>
                    </tr>
                @endforeach

                    <!--form id="oferta" action="{{route('campanhas.ofertas.store', $campanha->id)}}" method="POST">
                        {{csrf_field()}}
                        <tr>
                            <td>0</td>
                            <td><input type="text" name="produto_id" value="{{old('produto_id')}}"></td>
                            <td><input type="text" name="preco_normal" value="{{old('preco_normal')}}"></td>
                            <td>
                                <input type="text" name="preco_promocao" value="{{old('preco_promocao')}}">

                            </td>
                            <td><input type="number" name="quantidade"></td>

                            <td>
                                <a href="#" onclick="event.preventDefault(); document.getElementById('oferta').submit();">Salvar</a>
                            </td>
                        </tr>
                    </form-->

            @endslot
            @endcomponent
        @endslot
        @slot('rodape')
            {{$ofertas->links()}}
        @endslot
    @endcomponent
@endsection
