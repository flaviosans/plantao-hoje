@extends('layouts.admin.app')
@section('content')
@component('comp.box')
    @slot('cabecalho')
    @endslot
    @slot('conteudo')
        @if(isset($campanha))
            <form action="{{route('campanhas.update',  $campanha->id)}}" method="POST" enctype="multipart/form-data">
                {{ method_field('PUT') }}
        @else
            <form action="{{route('campanhas.store')}}" method="post" enctype="multipart/form-data">
        @endif
                {{csrf_field()}}
                <div class="form-group">
                    <label for="titulo">Título</label>
                    <input class="form-control" type="text" name="titulo" value="{{$campanha->titulo or old('titulo')}}">
                </div>
                <div class="form-group">
                    <label for="descricao">Descrição</label>
                    <input class="form-control" type="text" name="descricao" value="{{$campanha->descricao or old('descricao')}}">
                </div>
                <div class="form-group">
                    <label for="validade">Validade:</label>
                    <input class="datepicker" class="form-control data" type="text" name="validade"  value="{{$campanha->validade or old('validade')}}">
                </div>
                <div class="form-group">
                    <label for="imagem">Imagem:</label>
                    <input class="form-control" type="file" name="imagem" value="{{old('imagem') or ''}}">
                </div>
                <div class="form-group">
                    <input class="form-control" type="submit" value="Salvar!">
                </div>
            </form>
    @endslot
    @slot('rodape')
    @endslot
@endcomponent
@endsection