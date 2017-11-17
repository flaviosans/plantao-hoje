@extends('layouts.admin.app')
@section('content')

@component('comp.box')
    @slot('cabecalho')
        <a class="btn btn-default" href="{{route('campanhas.create')}}">Novo</a>
    @endslot
    @slot('conteudo')
        @component('comp.tabela')
            @slot('cabecalho')
                <th>#</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Ofertas</th>
                <th>Imagem</th>
                <th>Validade</th>
                <th>Ações</th>
            @endslot
            @slot('conteudo')
                @foreach($campanhas as $cada)
                    <tr>
                        <td>{{$cada->id}}</td>
                        <td>{{$cada->titulo}}</td>
                        <td>{{$cada->descricao}}</td>
                        <td>{{$cada->quantasOfertas}} - <a href="{{route('campanhas.ofertas.index', $cada->id)}}">Ver Ofertas</a></td>
                        <td>
                            @foreach($cada->imagem as $imagem)
                                <img src="{{$imagem->caminho}}" alt="{{$imagem->legenda}}" width="50" height="50">
                            @endforeach</td>
                        <td>{{$cada->validade}}</td>
                        <td>
                            <a href="/admin/campanhas/{{$cada->id}}/ofertas">Ofertas</a> |
                            <a href="#" onclick="event.preventDefault(); document.getElementById('delete-{{$cada->id}}').submit();">Apagar</a> |
                            <a href="{{route('campanhas.edit', $cada->id)}}">Editar</a>
                            <form id="delete-{{$cada->id}}" action="{{route('campanhas.destroy', $cada->id)}}" method="POST">
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
    {{$campanhas->links()}}
    @endslot
@endcomponent
@endsection
