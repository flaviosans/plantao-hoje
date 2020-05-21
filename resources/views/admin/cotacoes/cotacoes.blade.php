@extends('layouts.admin.app')
@section('content')

@component('comp.box')
    @slot('cabecalho')
        <a class="btn btn-default" href="{{route('cotacoes.create')}}">Novo</a>
    @endslot
    @slot('botoes')
        <a class="btn btn-default btn-sm" href="{{route('cotacoes.create')}}"><i class="fa fa-plus"></i></a>
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
                @foreach($cotacoes as $cada)
                    <tr>
                        <td>{{$cada->id}}</td>
                        <td>{{$cada->titulo}}</td>
                        <td>{{$cada->descricao}}</td>
                        <td>
                            {{$cada->status}}
                        </td>
                        <td>{{$cada->validade}}</td>
                        <td>
                            <a href="{{route('cotacoes.show', $cada->id)}}">Ver cotação</a> |
{{--                            <a href="#" onclick="event.preventDefault(); document.getElementById('delete-{{$cada->id}}').submit();">Apagar</a> |--}}
{{--                            <a href="{{route('cotacoes.edit', $cada->id)}}">Editar</a> |--}}
                            <a href="{{route('cotacoes.responder', $cada->id)}}"> Responder Campanha</a> |
                            <a href="{{route('cotacoes.respostas', $cada->id)}}"> Ver respostas</a> |
                            <a href="#" onclick="event.preventDefault(); document.getElementById('publicar-{{$cada->id}}').submit();"> Publicar</a> |

                            <form id="publicar-{{$cada->id}}" action="{{route('cotacoes.publicar', $cada->id)}}" method="POST">
                                {{csrf_field()}}
                            </form>
                            <form id="delete-{{$cada->id}}" action="{{route('cotacoes.destroy', $cada->id)}}" method="POST">
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
    {{$cotacoes->links()}}
    @endslot
@endcomponent
@endsection
