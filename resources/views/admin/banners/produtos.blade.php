@extends('layouts.admin.app')
@section('content')
    @component('comp.box')
        @slot('cabecalho')
            <a class="btn btn-default" href="{{route('banners.create')}}">Novo</a>
            <form action="{{route('banners.store')}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <input class="form-group" type="text" name="nome">
                <input type="submit" value="Registro Rápido">
            </form>
        @endslot
        @slot('conteudo')
            @component('comp.tabela')
                @slot('cabecalho')
                    <tr>
                        <th>#</th>
                        <th>Nome</th>
                        <th>Marca</th>
                        <th>Imagem</th>
                        <th>Ações</th>
                    </tr>
                @endslot
                @slot('conteudo')
                    @foreach($banners as $cada)
                        <tr>
                            <td>{{$cada->id}}</td>
                            <td>{{$cada->nome}}</td>
                            <td>{{ $cada->marca != null ? $cada->marca->nome : 'Sem Marca'}}</td>
                            <td>
                            @foreach($cada->imagem as $imagem)
                                <img src="{{$imagem->caminho}}" alt="{{$imagem->legenda}}" width="50" height="50">
                            @endforeach
                            </td>
                            <td>
                                <a href="#" onclick="event.preventDefault(); document.getElementById('delete-{{$cada->id}}').submit();">Apagar</a> |
                                <a href="{{route('banners.edit', $cada->id)}}">Editar</a>
                                <form id="delete-{{$cada->id}}" action="{{route('banners.destroy', $cada->id)}}" method="POST">
                                    {{method_field('DELETE')}}
                                    {{csrf_field()}}
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @endslot
            @endcomponent
        @endslot
        @slot('rodape')
            {{$banners->links()}}
        @endslot
    @endcomponent
@endsection