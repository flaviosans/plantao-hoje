@extends('layouts.admin.app')
@section('content')

@component('comp.box')
    @slot('cabecalho')
        <a class="btn btn-default" href="{{route('pedidos.create')}}">Novo</a>
    @endslot
    @slot('botoes')
        <a class="btn btn-default btn-sm" href="{{route('pedidos.create')}}"><i class="fa fa-plus"></i></a>
{{--        <button type="button" class="btn btn-default btn-sm"><i class="fa fa-reply"></i></button>--}}
{{--        <button type="button" class="btn btn-default btn-sm"><i class="fa fa-share"></i></button>--}}
    @endslot
    @slot('conteudo')
        @component('comp.tabela')
            @slot('cabecalho')
                <th>#</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Status</th>
                <th>Validade</th>
                <th>Ações</th>
            @endslot
            @slot('conteudo')
                @foreach($pedidos as $cada)
                    <tr>
                        <td>{{$cada->id}}</td>
                        <td>{{$cada->titulo}}</td>
                        <td>{{$cada->descricao}}</td>
                        <td>
                            {{$cada->status}}
                        </td>
                        <td>{{$cada->validade}}</td>
                        <td>
                            <a class="mb-2 mr-2 btn btn-primary" href="{{route('pedidos.show', $cada->id)}}">Ver pedido</a> |
                            <a class="mb-2 mr-2 btn btn-primary" href="{{route('pedidos.print', $cada->id)}}">Imprimir pedido</a> |
                            <a href="#" onclick="event.preventDefault(); document.getElementById('delete-{{$cada->id}}').submit();">Apagar</a> |
                            <a href="{{route('pedidos.edit', $cada->id)}}">Editar</a> |
                            <a href="#" onclick="event.preventDefault(); document.getElementById('publicar-{{$cada->id}}').submit();"> Publicar</a> |
                        </td>
                    </tr>
                @endforeach
            @endslot
        @endcomponent
    @endslot
    @slot('rodape')
    {{$pedidos->links()}}
    @endslot
@endcomponent
@endsection
