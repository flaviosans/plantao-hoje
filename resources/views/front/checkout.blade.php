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
                <form class="row" id="checkout-form" action="{{asset('/checkout')}}" method="post">
                    <input type="hidden" name="user_id">
                    {{csrf_field()}}
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">ID</th>
                        <th scope="col">Produto</th>
                        <th scope="col">Preço</th>
                        <th scope="col">Quantidade</th>
                    </tr>
                    </thead>

                        <tbody id="cart-list"></tbody>

                </table>

                </form>
            </div>
            <div class="col-md-6">
                <form id="novo-endereco">
                    <h3>Endereço de entrega:</h3>
                    <br>
                    <div class="form-check">
                        @foreach(Auth::user()->endereco()->get() as $cada)
                            <input class="form-check-input"
                                   type="radio"
                                   name="endereco_id"
                                   id="endereco_id{{$cada->id}}"
                                   value="{{$cada->id}}">
                            <label class="form-check-label" for="endereco_id{{$cada->id}}">
                                {{$cada->descricao}}
                            </label>
                        @endforeach
                        <input class="form-check-input"
                               type="radio"
                               name="endereco_id"
                               id="radio-novo-endereco"

                               @if(Auth::user()->endereco()->count() == 0)
                                       checked
                               @endif
                               value="0">
                        <label class="form-check-label" for="radio-novo-endereco">
                            Inserir Novo endereço
                        </label>
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
