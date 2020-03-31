@extends('layouts.app')
@section('content')
    <script>
        window.addEventListener("load", function(){
            cart.load();
            cart.list();
        });
    </script>
    <div class="container" style="margin-top: 25px">
        <div class="row">
            <div class="col-md-6">
                <div id="items"></div>
                <div class="cart-wrap">
                    <div id="cart-products"></div>
                    <div id="cart-list"></div>
                </div>

            </div>
            <div class="col-md-6">
                <form id="customer-data">
                    <div>
                        <h2>Cliente cadastrado: {{Auth::user()->name}}<br></h2>
                    </p>
                    <div class="form-check">
                    @if(Auth::user()->endereco()->count() > 0)
                        @foreach(Auth::user()->endereco()->get() as $cada)
                            <input class="form-check-input"
                                   type="radio"
                                   name="
"
                                   id="exampleRadios1"
                                   value="option1" checked>
                            <label class="form-check-label" for="exampleRadios1">
                                {{$cada->descricao}}
                            </label>
                        @endforeach
                    @else
                        <p>Sem endereços aqui</p>
                    @endif
                    </div>

                        <div class="form-group">
                            <label for="nome">Descrição do endereço:</label>
                            <input type="text" class="form-control" id="descricao" name="descricao" value="{{old('descricao') or ''}}">
                            <small id="nomeHelp" class="form-text text-muted">Ex.: "Casa da Maria, Trabalho"</small>
                        </div>
                        <div class="form-group">
                            <label for="logradouro">Rua/Av:</label>
                            <input type="text" class="form-control" id="logradouro" name="logradouro" value="{{old('logradouro') or ''}}">
                            <small id="enderecoHelp" class="form-text text-muted">Rua, av... Etc</small>
                        </div>
                        <div class="form-group">
                            <label for="nome">Bairro:</label>
                            <input type="text" class="form-control" id="bairro" name="bairro" value="{{old('bairro') or ''}}">
                        </div>
                        <div class="form-group">
                            <label for="nome">CEP:</label>
                            <input type="text" class="form-control" id="cep" name="cep" aria-describedby="bairroHelp" value="{{old('cep') or ''}}">
                        </div>
                        <button type="submit" class="btn btn-primary">Gravar Endereço</button>

                </form>
            </div>
        </div>
    </div>
@endsection
