@extends('layouts.admin.app')
@section('content')
    @component('comp.box')
        @slot('cabecalho')
        @endslot
        @slot('conteudo')
            @if(isset($loja))
                <form action="{{route('lojas.update',  $loja->id)}}" method="POST" enctype="multipart/form-data">
                    {{ method_field('PUT') }}
                    @else
                        <form action="{{route('lojas.store')}}" method="post" enctype="multipart/form-data">
                            @endif
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="nome">Nome</label>
                                <input class="form-control" type="text" name="nome" value="{{$loja->nome or old('nome')}}">
                            </div>

                            <div class="form-group">
                                <label for="cep">Tags</label>
                                <input class="form-control" type="text" name="cep" value="">
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