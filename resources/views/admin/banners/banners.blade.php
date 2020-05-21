@extends('layouts.admin.app')
@section('content')
    @component('comp.box')
        @slot('cabecalho')
            <a class="btn btn-default" href="{{route('banners.create')}}">Novo</a>

        @endslot
        @slot('conteudo')
            @component('comp.tabela')
                @slot('cabecalho')
                    <tr>
                        <th>#</th>
                        <th>Nome</th>
                        <th>Imagem</th>
                        <th>Ações</th>
                    </tr>
                @endslot
                @slot('conteudo')
                    @foreach($banners as $cada)
                        <tr>
                            <td>{{$cada->id}}</td>
                            <td>{{$cada->nome}}</td>
                            <td>
                            @foreach($cada->imagem as $imagem)
                                <img src="{{$imagem->caminho}}" alt="{{$imagem->legenda}}" width="100" height="39">
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