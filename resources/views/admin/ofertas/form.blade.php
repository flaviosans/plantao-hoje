@extends('layouts.admin.app')
@section('content')
    @component('comp.box')
        @slot('cabecalho')
        @endslot
        @slot('conteudo')
            @if(isset($oferta))
                <form action="{{route('campanhas.ofertas.update', [$oferta->campanha->id, $oferta->id] )}}" method="POST">
                    {{ method_field('PUT') }}
            @else
                <form action="{{route('campanhas.ofertas.store', $campanha->id)}}" method="post">
            @endif

                {{csrf_field()}}
                <div class="form-group">
                    <label for="produto_id">Produto:</label>
                    @if(isset($oferta))
                    <input class="form-control" type="text" name="produto_id" value="{{$oferta->produto->id}}" disabled>
                    @else
                    <input class="form-control" type="text" name="produto_id" value="">
                    @endif
                </div>

                <div class="form-group">
                    <label for="preco_normal">Preço normal:</label>
                    <input class="form-control" type="text" name="preco_normal" value="{{$oferta->preco_normal or old('preco_normal')}}">
                </div>
                <div class="form-group">
                    <label for="preco_promocao">Preço promocional:</label>
                    <input class="form-control" type="text" name="preco_promocao" value="{{$oferta->preco_promocao or old('preco_promocao')}}">
                </div>
                <div class="form-group">
                    <label for="preco_promocao">Quantidade</label>
                    <input class="form-control" type="text" name="quantidade" value="{{$oferta->quantidade or old('quantidade')}}">
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