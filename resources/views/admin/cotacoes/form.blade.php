@extends('layouts.admin.app')
@section('content')
@component('comp.box')
    @slot('cabecalho')
    @endslot
    @slot('botoes')
        k
    @endslot
    @slot('conteudo')
        @if(isset($cotacao))
            <form id="cotacao-form" action="{{route('cotacoes.update',  $cotacao->id)}}" method="POST" enctype="multipart/form-data">
                {{ method_field('PUT') }}
        @else
            <form id="cotacao-form" action="{{route('cotacoes.store')}}" method="post" enctype="multipart/form-data">
        @endif
                {{csrf_field()}}
                <div class="form-group">
                    <label for="titulo">Título</label>
                    <input class="form-control" type="text" name="titulo" value="{{$cotacao->titulo or old('titulo')}}">
                </div>
                <div class="form-group">
                    <label for="descricao">Descrição</label>
                    <input class="form-control" type="text" name="descricao" value="{{$cotacao->descricao or old('descricao')}}">
                </div>
                <div class="form-group">
                    <label for="validade">Validade:</label>
                    <input class="datepicker" class="form-control data" type="text" name="validade"  value="{{$cotacao->validade or old('validade')}}">
                </div>
                <div class="form-group">
                    <label for="imagem">Imagem:</label>
                    <input class="form-control" type="file" name="imagem" value="{{old('imagem') or ''}}">
                </div>
                @if(isset($parent))
                <input type="hidden" name="tipo" value="fornecedor"/>
                <input type="hidden" name="cotacao_id" value="{{$parent}}"/>
                @else
                <input type="hidden" name="tipo" value="cliente"/>
                <input type="hidden" name="cotacao_id" value="0"/>
                @endif

                <div class="form-group">
                    <input class="form-control" type="submit" value="Salvar!">
                </div>
            </form>
    @endslot
    @slot('rodape')
    @endslot
@endcomponent
@endsection