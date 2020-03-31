
@extends('layouts.admin.app')

@section('content')
    @component('comp.box')
        @slot('cabecalho')
            Dados do cliente
        @endslot
        @slot('conteudo')
            <p>{{$cotacao->user->name}}</p>
            <p>{{$cotacao->user->endereco()->first()->logradouro or ''}}</p>
            <p>{{$cotacao->user->endereco()->first()->cep or ''}}</p>
        @endslot
        @slot('rodape')
        @endslot

    @endcomponent
    @component('comp.box')
        @slot('cabecalho')
            <script>
                    $("input, button").keydown(function(e) {
                        if(e.keyCode == 13) {
                            var elem = $(this).next();
                            if(elem.is("button")) {
                                elem.focus();
                            }
                            $(this).next("input").focus();
                        }
                    });
            </script>
            @if(isset($cotacao))
            <a class="btn btn-default" href="{{route('cotacoes.itens.create', $cotacao->id)}}">Novo</a>
            @endif

        @endslot
        @slot('conteudo')
            @component('comp.tabela')
            @slot('cabecalho')
                <tr>
                    <th>#</th>
                    <th>Produto</th>
                    @if($cotacao->tipo == 'fornecedor')
                    <th>Preço</th>
                    @endif
                    <th>Quantidade</th>
                    <th>Obs.</th>
                    @if($cotacao->tipo == 'fornecedor')
                    <th>Total</th>
                    @endif
                    <th>Ações</th>
                </tr>
                @if($cotacao->tipo == 'cliente')
                <form id="itemeproduto" action="{{route('cotacoes.itens.store', $cotacao->id)}}" method="POST">
                    {{csrf_field()}}
                    <tr>
                        <td>0</td>
                        <td>
                            <select class="buscar-produto" name="produto_id">
                                    <option value=""> </option>
                            @foreach(\App\Produto::all() as $produto)}}
                                    <option value="{{$produto->id}}">{{$produto->nome}}</option>
                            @endforeach}}
                            </select>
                        </td>
                        @if($cotacao->tipo == 'fornecedor')
                        <td><input type="text" name="preco" value="{{old('preco')}}"></td>
                        @endif
                        <td>
                            <input type="text" name="quantidade" value="{{old('quantidade')}}">
                        </td>
                        <td>
                            <input type="text" name="observacao" value="{{old('observacao')}}">
                        </td>
                        <td>
                            <a href="#" onclick="event.preventDefault(); document.getElementById('itemeproduto').submit();">Salvar</a>
                        </td>
                    </tr>
                </form>
                @endif
            @endslot
            @slot('conteudo')
                @foreach($itens as $cada)
                    <tr>
                        <td>{{$cada->id}}</td>
                        <td>{{$cada->produto->nome}}</td>
                        @if($cotacao->tipo == 'fornecedor')
                        <td>{{$cada->preco}}</td>
                        @endif
                            <td>{{$cada->quantidade}}</td>
{{--                        <td>{{$cada->quantidade != null  && $cada->quantidade > 0 ? $cada->quantidade . ' ' . $cada->produto->medida->abreviacao : ''}}</td>--}}
                        <td>{{$cada->observacao}}</td>
                        @if($cotacao->tipo == 'fornecedor')
                        <td>{{$cada->quantidade * $cada->preco}}</td>
                        @endif
                        <td>
                            <a href="#" onclick="event.preventDefault(); document.getElementById('delete-{{$cada->id}}').submit();">Apagar</a> |
                            <a href="{{route('cotacoes.itens.edit', [$cada->petivel->id, $cada->id])}}">Editar</a>
                            <form id="delete-{{$cada->id}}" action="{{route('cotacoes.itens.destroy', [$cada->petivel->id, $cada->id])}}" method="POST">
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
            {{$itens->links()}}
        @endslot
    @endcomponent
@endsection
