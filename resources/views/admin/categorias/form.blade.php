@extends('layouts.admin.app')
@section('content')
    @component('comp.box')
        @slot('cabecalho')
        @endslot
        @slot('conteudo')
            @if(isset($categoria))
                <form action="{{route('categorias.update', $categoria->id )}}" method="POST" enctype="multipart/form-data">
                    {{ method_field('PUT') }}
            @else
                <form action="{{route('categorias.store')}}" method="post" enctype="multipart/form-data">
            @endif
                {{csrf_field()}}
                <div class="form-group">
                    <label for="nome">Nome:</label>
                    <input class="form-control" type="text" name="nome" value="{{$categoria->nome or old('nome')}}">
                </div>
                <div class="form-group">
                    <label for="pai">Pai:</label>
                    <select name="pai" class="form-control">
                        <option value="0">(Nenhum)</option>
                    @foreach($categorias as $cada)
                        @if((isset($categoria) && $categoria->pai == $cada->id) || (!is_null(old('pai')) && $cada->id == old('pai') ))
                            <option selected value="{{$cada->id}}">{{$cada->nome}}</option>
                        @else
                            <option value="{{$cada->id}}">{{$cada->nome}}</option>
                        @endif
                    @endforeach
                    </select>
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