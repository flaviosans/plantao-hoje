@extends('layouts.app')
@section('content')
    <script>
        window.addEventListener("load", function(){
            cart.load();
            cart.list();
        });
    </script>
    <div class="container">
        <div class="row">
            <div class="col">
                <div id="items"></div>
                <div class="cart-wrap">
                    <div id="cart-products"></div>
                    <div id="cart-list"></div>
                </div>
            </div>
            <div class="col">

            </div>
        </div>
    </div>
    <form id="customer-data">
        <div class="form-group">
            <label for="nome">Nome:</label>
            <input type="text" class="form-control" id="nome" name="nome" aria-describedby="nomeHelp" placeholder="Enter email">
            <small id="nomeHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
            <label for="nome">Endereço:</label>
            <input type="text" class="form-control" id="endereco" name="endereco" aria-describedby="enderecoHelp" placeholder="Enter email">
            <small id="enderecoHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
            <label for="telefone">Password</label>
            <input type="text" class="form-control" id="telefone" name="telefone" placeholder="Password">
        </div>
        <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Check me out</label>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
