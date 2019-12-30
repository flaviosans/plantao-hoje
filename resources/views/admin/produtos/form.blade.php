@extends('layouts.admin.app')
@section('content')
@component('comp.box')
    @slot('cabecalho')
    @endslot
    @slot('conteudo')
        @if(isset($produto))
            <form action="{{route('produtos.update',  $produto->id)}}" method="POST" enctype="multipart/form-data">
                {{ method_field('PUT') }}
        @else
            <form action="{{route('produtos.store')}}" method="post" enctype="multipart/form-data">
        @endif
            {{csrf_field()}}
            <div class="form-group">
                <label for="nome">Nome</label>
                <input class="form-control" type="text" name="nome" value="{{$produto->nome or old('nome')}}">
            </div>
            <div class="form-group">
                <label for="codigo_barras">Código de Barras</label>
                <input class="form-control" type="text" name="codigo_barras" value="{{$produto->codigo_barras or old('codigo_barras')}}">
            </div>
            <div class="form-group">
                <label for="nome"></label>
                <input type="checkbox" name="proprio" value="proprio" {{isset($produto) && $produto->loja != null ? 'checked' : ''}}>Marque aqui se esse produto é exclusivo/Fabricação própria dessa loja
            </div>
            <div class="form-group">
                <label for="categorias">Marca</label>
                <select class="form-control" name="marca_id">
                    @foreach ($marcas as $marca)
                        @if(
                            (isset($produto) && isset($produto->marca)&& $produto->marca->id == $marca->id) || ($marca->id == old('marca_id') ))
                            <option selected value="{{$marca->id}}">{{$marca->nome}}</option>
                        @else
                            <option value="{{$marca->id}}">{{$marca->nome}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="tags">Tags</label>
                <input class="form-control" type="text" name="tags" value="{{$produto->tags or old('tags')}}">
            </div>
            <div class="form-group">
                <label for="categorias">Categoria</label>
                <select multiple class="form-control" name="categorias[]" >
                    @foreach ($categorias as $categoria)
                        @if(isset($produto) && $produto->possui($categoria) || ( !is_null(old('categorias')) &&  in_array($categoria->id, old('categorias')  ) ) )))
                            <option selected value="{{$categoria->id}}">{{$categoria->nome}}</option>
                        @else
                            <option value="{{$categoria->id}}">{{$categoria->nome}}</option>
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