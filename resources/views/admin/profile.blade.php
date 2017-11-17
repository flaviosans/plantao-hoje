@extends('layouts.admin.app')
@section('content')
    <div class="col-md-12">
@component('comp.box')
    @slot('cabecalho')
        Dados do Usuário
    @endslot
    @slot('conteudo')
        <form>
            <div class="col-sm-12">
                <div type="form-group">
                    <label text="">Nome</label>
                    <input type="text" class="form-control" value="{{$user->name}}" placeholder="col-sm-2">
                </div>
            </div>
            <div class="col-sm-12">
                <div type="form-group">
                    <label text="">Imagem:</label>
                    <input type="file" class="form-control" placeholder="col-sm-2">
                </div>
            </div>
        </form>
    @endslot
    @slot('rodape')
    @endslot
@endcomponent
    </div>

    @foreach($user->loja as $cada)
    <div class="col-md-6">
    @component('comp.box')
        @slot('cabecalho')
            @endslot
        @slot('conteudo')
            <form>
                <div class="col-sm-3">
                    <div type="form-group">
                        <label text="">Loja</label>
                        <input type="text" class="form-control" value="{{$cada->nome}}" placeholder="col-sm-2">
                    </div>
                </div>
                @foreach($cada->endereco as $endereco)
                    <div class="col-sm-{{9/ (count($cada->endereco)+ count($cada->telefone))}}">
                        <div type="form-group">
                            <label text="">Endereço</label>
                            <input type="text" class="form-control" value="{{$endereco->rua}}" placeholder="col-sm-2">
                        </div>
                    </div>
                @endforeach
                @foreach($cada->telefone as $telefone)
                    <div class="col-sm-{{9 / (count($cada->endereco)+ count($cada->telefone))}}">
                        <div type="form-group">
                            <label text="">{{$telefone->descricao}}</label>
                            <input type="text" class="form-control" value="{{$telefone->numero}}" placeholder="col-sm-2">
                        </div>
                    </div>
                @endforeach
        </form>
        @endslot
        @slot('rodape')
        @endslot
    @endcomponent
            </div>
@ENDFOREACH
@endsection








