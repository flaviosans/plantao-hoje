@extends('layouts.admin.app')
@section('content')
    @component('comp.box')
        @slot('cabecalho')
        @endslot
        @slot('conteudo')
            @if(isset($endereco))
                <form action="{{route('enderecos.update',  $endereco->id)}}" method="POST" enctype="multipart/form-data">
                    {{ method_field('PUT') }}
                    @else
                        <form action="{{route('enderecos.store')}}" method="post" enctype="multipart/form-data">
                            @endif
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="nome">Descrição</label>
                                <input class="form-control" type="text" name="descricao" value="{{$endereco->descricao or old('descricao')}}">
                            </div>

                            <div class="form-group">
                                <label for="nome">Logradouro</label>
                                <input class="form-control" type="text" name="logradouro" value="{{$endereco->logradouro or old('logradouro')}}">
                            </div>

                            <div class="form-group">
                                <label for="nome">Bairro</label>
                                <input class="form-control" type="text" name="bairro" value="{{$endereco->bairro or old('bairro')}}">
                            </div>

                            <div class="form-group">
                                <label for="cep_id">CEP</label>
                                <input class="form-control" type="text" name="cep_id" value="">
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