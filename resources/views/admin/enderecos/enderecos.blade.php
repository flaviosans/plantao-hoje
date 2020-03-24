@extends('layouts.admin.app')

@section('content')
    @component('comp.box')
        @slot('cabecalho')
        <a class="btn btn-default" href="{{route('enderecos.create')}}">Novo</a>
        @endslot
        @slot('conteudo')
            @component('comp.tabela')
            @slot('cabecalho')
            <tr>
                <th>#</th>
                <th>Logradouro</th>
                <th>Ações</th>
            </tr>
            @endslot
            @slot('conteudo')
                @foreach($enderecos as $cada)
                <tr>
                    <td>{{$cada->id}}</td>
                    <td>{{$cada->logradouro}}</td>
                    <td><a href="{{route('enderecos.edit', $cada->id)}}">Editar </a></td>
                </tr>
                @endforeach
            @endslot
            @endcomponent
        @endslot
        @slot('rodape')
            hum
        @endslot
    @endcomponent
@endsection