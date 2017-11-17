@extends('layouts.admin.app')
@section('content')
    @component('comp.box')
        @slot('cabecalho')
            <a class="btn btn-default" href="{{route('tokens.create')}}">Novo</a>
        @endslot
        @slot('conteudo')
            @component('comp.tabela')
                @slot('cabecalho')
                    <tr>
                        <th>#</th>
                        <th>Nome</th>
                        <th>Produtos</th>
                        <th>Ações</th>
                    </tr>
                @endslot
                @slot('conteudo')
                    @foreach($tokens as $cada)
                        <tr>
                            <td>{{$cada->id}}</td>
                            <td>{{$cada->token}}</td>
                            <td>{{$cada->produto()->count()}}</td>
                            <td>
                                <a href="#" onclick="event.preventDefault(); document.getElementById('delete-{{$cada->id}}').submit();">Apagar</a> |
                                <a href="{{route('tokens.edit', $cada->id)}}">Editar</a>
                                <form id="delete-{{$cada->id}}" action="{{route('tokens.destroy', $cada->id)}}" method="POST">
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
            {{$tokens->links()}}
        @endslot
    @endcomponent
@endsection