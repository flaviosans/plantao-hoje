@extends('layouts.admin.app')
@section('content')
@component('comp.box')
    @slot('cabecalho')
    @endslot
    @slot('conteudo')
        @if(isset($banner))
            <form action="{{route('banners.update',  $banner->id)}}" method="POST" enctype="multipart/form-data">
                {{ method_field('PUT') }}
        @else
            <form action="{{route('banners.store')}}" method="post" enctype="multipart/form-data">
        @endif
            {{csrf_field()}}
            <div class="form-group">
                <label for="nome">Nome</label>
                <input class="form-control" type="text" name="nome" value="{{$banner->nome or old('nome')}}">
            </div>
            <div class="form-group">
                <label for="nome">Tipo</label>
                <input class="form-control" type="text" name="tipo" value="{{$banner->tipo or old('tipo')}}">
            </div>

            <div class="form-group">
                <label for="nome">Texto</label>
                <input class="form-control" type="text" name="texto" value="{{$banner->texto or old('texto')}}">
            </div>

            <div class="form-group">
                <label for="tags">Link</label>
                <input class="form-control" type="text" name="link" value="{{$banner->link or old('link')}}">
            </div>

            <div class="form-group">
                <label for="imagem">Imagem:</label>
                <input class="form-control" type="file" name="imagem">
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