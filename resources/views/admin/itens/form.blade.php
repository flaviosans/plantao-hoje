@extends('layouts.admin.app')
@section('content')
    @component('comp.box')
        @slot('cabecalho')
        @endslot
        @slot('conteudo')
            @if(isset($item))
                <form action="{{route('cotacoes.itens.update', [$item->cotacao->id, $item->id] )}}" method="POST">
                    {{ method_field('PUT') }}
            @else
                <form action="{{route('cotacoes.itens.store', $cotacao->id)}}" method="post">
            @endif

                {{csrf_field()}}
                <div class="form-group">
                    <label for="produto_id">Produto:</label>
                    @if(isset($item))
                    <input class="form-control" type="text" name="produto_id" value="{{$item->produto->nome}}" disabled>
                    @else
                    <input class="form-control" type="text" name="produto_id" value="">
                    @endif
                </div>

                <div class="form-group">
                    <label for="preco">Preço:</label>
                    <input class="form-control" type="text" name="preco" value="{{$item->preco or old('preco')}}">
                </div>
                <div class="form-group">
                    <label for="preco_promocao">Quantidade</label>
                    <input class="form-control" type="text" name="quantidade" value="{{$item->quantidade or old('quantidade')}}" {{$item->cotacao->cotacao_id ? 'disabled' : ''}}>
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