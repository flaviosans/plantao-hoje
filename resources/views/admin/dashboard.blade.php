@extends('layouts.admin.app')
@section('content')
    @component('comp.mini-box')
        @slot('box1_titulo')
            {{\App\Produto::all()->count()}}
        @endslot
        @slot('box1_descricao')
            Produtos Cadastrados
        @endslot
        @slot('box1_link')
            {{route('produtos.index')}}
        @endslot
        @slot('box1_texto')
            Ver Produtos
        @endslot
        @slot('box2_titulo')
            {{\App\Oferta::all()->count()}}
        @endslot
        @slot('box2_descricao')
            Ofertas Cadastradas
        @endslot
        @slot('box2_link')
            {{route('ofertas.index')}}
        @endslot
        @slot('box2_texto')
            Pesquisa Google
        @endslot
        @slot('box3_titulo')
            {{$numLojas = Auth::user()->loja()->count()}}
        @endslot
        @slot('box3_descricao')
            {{ $numLojas > 1 ? 'Lojas' : 'Loja' }}
        @endslot
        @slot('box3_link')
            {{route('lojas.index')}}
        @endslot
        @slot('box3_texto')
            Gerenciar Lojas
        @endslot
        @slot('box4_titulo')
            40
        @endslot
        @slot('box4_descricao')
            olar
        @endslot
        @slot('box4_link')
            www.google.com
        @endslot
        @slot('box4_texto')
            Pesquisa Google
        @endslot

    @endcomponent
    @component('comp.box')
        @slot('cabecalho')
            Correto
        @endslot
        @slot('conteudo')
            Esse Box deu certo!
        @endslot
        @slot('rodape')
            Rodape
        @endslot
    @endcomponent
    @component('comp.box')
        @slot('cabecalho')
            Correto
        @endslot
        @slot('conteudo')
            Esse Box deu certo!
        @endslot
        @slot('rodape')
            Rodape
        @endslot
    @endcomponent
    @component('comp.box')
        @slot('cabecalho')
            Correto
        @endslot
        @slot('conteudo')
            Esse Box deu certo!
        @endslot
        @slot('rodape')
            Rodape
        @endslot
    @endcomponent
    @component('comp.box')
        @slot('cabecalho')
            Correto
        @endslot
        @slot('conteudo')
            Esse Box deu certo!
        @endslot
        @slot('rodape')
            Rodape
        @endslot
    @endcomponent
    @component('comp.box')
        @slot('cabecalho')
            Correto
        @endslot
        @slot('conteudo')
            Esse Box deu certo!
        @endslot
        @slot('rodape')
            Rodape
        @endslot
    @endcomponent
    @component('comp.box')
        @slot('cabecalho')
            Correto
        @endslot
        @slot('conteudo')
            Esse Box deu certo!
        @endslot
        @slot('rodape')
            Rodape
        @endslot
    @endcomponent
    @component('comp.box')
        @slot('cabecalho')
            Correto
        @endslot
        @slot('conteudo')
            Esse Box deu certo!
        @endslot
        @slot('rodape')
            Rodape
        @endslot
    @endcomponent
    @component('comp.box')
        @slot('cabecalho')
            Correto
        @endslot
        @slot('conteudo')
            Esse Box deu certo!
        @endslot
        @slot('rodape')
            Rodape
        @endslot
    @endcomponent
    @component('comp.box')
        @slot('cabecalho')
            Correto
        @endslot
        @slot('conteudo')
            Esse Box deu certo!
        @endslot
        @slot('rodape')
            Rodape
        @endslot
    @endcomponent

@endsection