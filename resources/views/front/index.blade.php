@extends('layouts.app')
@section('content')

    <!-- main-slider -->
    <ul id="demo1">
        @foreach($bannerTopo as $banner)
            <li>
            <img src="{{$banner->imagem()->first()->caminho or ''}}" alt=""/>
            <!--Slider Description example-->
            <div class="slide-desc">
                <h3>{{$banner->texto}}</h3>
            </div>
        </li>
        @endforeach
    </ul>
    <!-- //main-slider -->
    <!-- //top-header and slider -->
    <!-- top-brands -->
    <div class="top-brands">
        <div class="container">
            <h2>As melhores ofertas aqui!</h2>
            <div class="grid_3 grid_5">
                <div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="myTab" class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#expeditions" id="expeditions-tab" role="tab" data-toggle="tab" aria-controls="expeditions" aria-expanded="true">Ofertas em Destaque</a></li>
                        <li role="presentation"><a href="#tours" role="tab" id="tours-tab" data-toggle="tab" aria-controls="tours">Últimas Ofertas:</a></li>
                    </ul>
                    <div id="myTabContent" class="tab-content">
                        <div role="tabpanel" class="tab-pane fade in active" id="expeditions" aria-labelledby="expeditions-tab">
                            <div class="agile-tp">
                                <h5>Em destaque:</h5>
                                <p class="w3l-ad">Produtos que foram destaque essa semana, colocamos aqui! Pesquise, compare e boas compras!!</p>
                            </div>
                            @component('front.comp.lista-ofertas', ['ofertas' => $ofertas])
                            @endcomponent

                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="tours" aria-labelledby="tours-tab">
                            <div class="agile-tp">
                                <h5>Nossas ofertas pra você</h5>
                                <p class="w3l-ad">Essas ofertas acabaram de chegar no nosso site! Legal, não?</p>
                            </div>
                            @component('front.comp.lista-ofertas', ['ofertas' => $ofertas])
                            @endcomponent
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- //top-brands -->
    <!-- Carousel
       ================================================== -->
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            @foreach($bannerMeio as $b)
            <li data-target="#myCarousel" data-slide-to="{{$loop->index}}" {{$loop->first ? 'class=\"active\"' : ''}}></li>
            @endforeach
        </ol>
        <div class="carousel-inner" role="listbox">
            @foreach($bannerMeio as $b)
            <div class="item {{$loop->first ? 'active' : ''}}">
                <a href="{{$b->link}}"> <img  src="{{$b->imagem()->first()->caminho}}" alt="First slide"></a>
            </div>
            @endforeach
        </div>

    </div><!-- /.carousel -->
    <!--banner-bottom-->

    <!--banner-bottom-->
    <!--brands-->
    <div class="brands">
        <div class="container">
            <h3>Navegue por marcas</h3>
            <div class="brands-agile">

                @foreach($marcas as $marca)
                    <div class="col-sm-2 col-md-2 w3layouts-brand">
                        <div class="brands-w3l">
                            <p><a href="#">{{$marca->nome}}</a></p>
                        </div>
                    </div>
                @endforeach

                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <!--//brands-->
    <!-- new -->
    <div class="newproducts-w3agile">
        <div class="container">
            <h3>Últimas Ofertas Cadastradas:</h3>
            @component('front.comp.lista-ofertas', ['ofertas' => $ofertas])
            @endcomponent
        </div>
    </div>
    <!-- //new -->
@endsection