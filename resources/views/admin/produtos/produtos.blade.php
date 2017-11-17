@extends('layouts.admin.app')
@section('content')
    @component('comp.box')
        @slot('cabecalho')
            <a class="btn btn-default" href="{{route('produtos.create')}}">Novo</a>
            <form action="{{route('produtos.store')}}" method="post" enctype="multipart/form-data">
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
                        <th>Código Barras</th>
                        <th>Marca</th>
                        <th>Ofertas</th>
                        <th>Categoria</th>
                        <th>Tags</th>
                        <th>Foto</th>
                        <th>Ações</th>
                    </tr>
                @endslot
                @slot('conteudo')
                    @foreach($produtos as $cada)
                        <tr>
                            <td>{{$cada->id}}</td>

                            <td>{{$cada->nome}} {{$cada->loja != null ? '(Exclusivo)': ''}}</td>
                            <td>{{$cada->codigo_barras }}</td>
                            <td>{{ $cada->marca != null ? $cada->marca->nome : 'Sem Marca'}}</td>
                            <td>{{$cada->quantasOfertas}}</td>
                            <td>
                                @if(isset($cada->categoria))
                                @foreach($cada->categoria as $categoria)
                                    {{$loop->last ? $categoria->nome : $categoria->nome . ','}}
                                @endforeach
                                @else
                                Sem Categoria
                                @endif
                            </td>
                            <td>{{$cada->tags}}</td>
                            <td>
                            @foreach($cada->imagem as $imagem)
                                <img src="{{$imagem->caminho}}" alt="{{$imagem->legenda}}" width="50" height="50">
                            @endforeach
                            </td>
                            <td>
                                <a href="#" onclick="event.preventDefault(); document.getElementById('delete-{{$cada->id}}').submit();">Apagar</a> |
                                <a href="{{route('produtos.edit', $cada->id)}}">Editar</a>
                                <form id="delete-{{$cada->id}}" action="{{route('produtos.destroy', $cada->id)}}" method="POST">
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
            {{$produtos->links()}}
        @endslot
    @endcomponent
@endsection