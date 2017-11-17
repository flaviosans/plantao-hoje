@extends('layouts.admin.app')
@section('content')
    @component('comp.box')
        @slot('cabecalho')
            <a class="btn btn-default" href="{{route('lojas.create')}}">Novo</a>
        @endslot
        @slot('conteudo')
            @component('comp.tabela')
                @slot('cabecalho')
                    <tr>
                        <th>#</th>
                        <th>Nome</th>
                        <th>Campanhas</th>
                        <th>Imagem</th>
                        <th>Ações</th>
                    </tr>
                @endslot
                @slot('conteudo')
                    @foreach($lojas as $cada)
                        <tr>
                            <td>{{$cada->id}}</td>
                            <td>{{$cada->nome}}</td>
                            @if($cada->campanha != null)
                            <td>{{$cada->campanha()->count()}} <a href="{{route('campanhas.index')}}">Ver Campanhas</a> </td>
                            @else
                            <td>Sem Campanhas. <a href="{{route('campanhas.create')}}">Criar nova campanha</a> </td>
                            @endif
                            <td>
                            @foreach($cada->imagem as $imagem)
                                <img src="{{$imagem->caminho}}" alt="{{$imagem->legenda}}" width="50" height="50">
                            @endforeach
                            </td>
                            <td>
                                <a href="#" onclick="event.preventDefault(); document.getElementById('delete-{{$cada->id}}').submit();">Apagar</a> |
                                <a href="{{route('lojas.edit', $cada->id)}}">Editar</a>
                                <form id="delete-{{$cada->id}}" action="{{route('lojas.destroy', $cada->id)}}" method="POST">
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
            {{$lojas->links()}}
        @endslot
    @endcomponent
@endsection