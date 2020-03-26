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
                            <div class="agile_top_brands_grids">
                                @foreach($ofertas as $oferta)
                                <div class="col-md-4 top_brand_left">
                                    <div class="hover14 column">
                                        <div class="agile_top_brand_left_grid">
                                            <div class="agile_top_brand_left_grid_pos">
                                                <img src="images/offer.png" alt=" " class="img-responsive" />
                                            </div>
                                            <div class="agile_top_brand_left_grid1">
                                                <figure>
                                                    <div class="snipcart-item block" >
                                                        <div class="snipcart-thumb">
                                                            <a href="products.html">
                                                                @if($oferta->produto->imagem()->first() != null)
                                                                    <img src="{{$oferta->produto->imagem()->first()->caminho}}" alt="" width="150" height="150">
                                                                @endif
                                                            </a>
                                                            <p>{{$oferta->produto->nome}}</p>
                                                            <div class="stars">
                                                                <i class="fa fa-star blue-star" aria-hidden="true"></i>
                                                                <i class="fa fa-star blue-star" aria-hidden="true"></i>
                                                                <i class="fa fa-star blue-star" aria-hidden="true"></i>
                                                                <i class="fa fa-star blue-star" aria-hidden="true"></i>
                                                                <i class="fa fa-star gray-star" aria-hidden="true"></i>
                                                            </div>
                                                            <h4>{{$oferta->preco_promocao}} <span>{{$oferta->preco_normal}}</span></h4>
                                                        </div>
                                                        <div class="snipcart-details top_brand_home_details">
                                                            <form action="#" method="post">
                                                                <fieldset>
                                                                    <input type="hidden" name="cmd" value="_cart" />
                                                                    <input type="hidden" name="add" value="1" />
                                                                    <input type="hidden" name="business" value=" " />
                                                                    <input type="hidden" name="item_name" value="{{$oferta->produto->nome}}" />
                                                                    <input type="hidden" name="amount" value="{{$oferta->preco_normal}}" />
                                                                    <input type="hidden" name="discount_amount" value="0.0" />
                                                                    <input type="hidden" name="currency_code" value="USD" />
                                                                    <input type="hidden" name="return" value=" " />
                                                                    <input type="hidden" name="cancel_return" value=" " />
                                                                    <input type="submit" name="submit" value="Add to cart" class="button" />
                                                                </fieldset>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </figure>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if($loop->iteration % 3 == 0)
                                        <div class="clearfix"> </div>
                                @endif
                                @endforeach
                            </div>

                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="tours" aria-labelledby="tours-tab">
                            <div class="agile-tp">
                                <h5>Últimas Ofertas</h5>
                                <p class="w3l-ad">Essas ofertas acabaram de chegar no nosso site! Legal, não?</p>
                            </div>
                            <div class="agile_top_brands_grids">
                                @foreach($ofertas as $oferta)
                                    <div class="col-md-4 top_brand_left">
                                        <div class="hover14 column">
                                            <div class="agile_top_brand_left_grid">
                                                <div class="agile_top_brand_left_grid_pos">
                                                    <img src="images/offer.png" alt=" " class="img-responsive" />
                                                </div>
                                                <div class="agile_top_brand_left_grid1">
                                                    <figure>
                                                        <div class="snipcart-item block" >
                                                            <div class="snipcart-thumb">
                                                                <a href="products.html">
                                                                    @if($oferta->produto->imagem()->first() != null)
                                                                        <img src="{{$oferta->produto->imagem()->first()->caminho}}" alt="" width="150" height="150">
                                                                    @endif
                                                                </a>
                                                                <p>{{$oferta->produto->nome}}</p>
                                                                <div class="stars">
                                                                    <i class="fa fa-star blue-star" aria-hidden="true"></i>
                                                                    <i class="fa fa-star blue-star" aria-hidden="true"></i>
                                                                    <i class="fa fa-star blue-star" aria-hidden="true"></i>
                                                                    <i class="fa fa-star blue-star" aria-hidden="true"></i>
                                                                    <i class="fa fa-star gray-star" aria-hidden="true"></i>
                                                                </div>
                                                                <h4>{{$oferta->preco_promocao}} <span>{{$oferta->preco_normal}}</span></h4>
                                                            </div>
                                                            <div class="snipcart-details top_brand_home_details">
                                                                <form action="#" method="post">
                                                                    <fieldset>
                                                                        <input type="hidden" name="cmd" value="_cart" />
                                                                        <input type="hidden" name="add" value="1" />
                                                                        <input type="hidden" name="business" value=" " />
                                                                        <input type="hidden" name="item_name" value="{{$oferta->produto->nome}}" />
                                                                        <input type="hidden" name="amount" value="{{$oferta->preco_normal}}" />
                                                                        <input type="hidden" name="discount_amount" value="0.0" />
                                                                        <input type="hidden" name="currency_code" value="USD" />
                                                                        <input type="hidden" name="return" value=" " />
                                                                        <input type="hidden" name="cancel_return" value=" " />
                                                                        <input type="submit" name="submit" value="Add to cart" class="button" />
                                                                    </fieldset>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </figure>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @if($loop->iteration % 3 == 0)
                                        <div class="clearfix"> </div>
                                    @endif
                                @endforeach
                            </div>
                            <div class="agile_top_brands_grids">
                                <div class="col-md-4 top_brand_left">
                                    <div class="hover14 column">
                                        <div class="agile_top_brand_left_grid">
                                            <div class="agile_top_brand_left_grid_pos">
                                                <!-- <img src="/images/offer.png" alt=" " class="img-responsive" /> -->
                                            </div>
                                            <div class="agile_top_brand_left_grid1">
                                                <figure>
                                                    <div class="snipcart-item block" >
                                                        <div class="snipcart-thumb">
                                                            <a href="products.html"><img title=" " alt=" " src="images/10.png" /></a>
                                                            <p>Fortune-sunflower</p>
                                                            <div class="stars">
                                                                <i class="fa fa-star blue-star" aria-hidden="true"></i>
                                                                <i class="fa fa-star blue-star" aria-hidden="true"></i>
                                                                <i class="fa fa-star blue-star" aria-hidden="true"></i>
                                                                <i class="fa fa-star blue-star" aria-hidden="true"></i>
                                                                <i class="fa fa-star gray-star" aria-hidden="true"></i>
                                                            </div>
                                                            <h4>$20.99 <span>$35.00</span></h4>
                                                        </div>
                                                        <div class="snipcart-details top_brand_home_details">
                                                            <form action="#" method="post">
                                                                <fieldset>
                                                                    <input type="hidden" name="cmd" value="_cart" />
                                                                    <input type="hidden" name="add" value="1" />
                                                                    <input type="hidden" name="business" value=" " />
                                                                    <input type="hidden" name="item_name" value="Fortune Sunflower Oil" />
                                                                    <input type="hidden" name="amount" value="20.99" />
                                                                    <input type="hidden" name="discount_amount" value="1.00" />
                                                                    <input type="hidden" name="currency_code" value="USD" />
                                                                    <input type="hidden" name="return" value=" " />
                                                                    <input type="hidden" name="cancel_return" value=" " />
                                                                    <input type="submit" name="submit" value="Add to cart" class="button" />
                                                                </fieldset>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </figure>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 top_brand_left">
                                    <div class="hover14 column">
                                        <div class="agile_top_brand_left_grid">
                                            <div class="agile_top_brand_left_grid_pos">
                                                <img src="images/offer.png" alt=" " class="img-responsive" />
                                            </div>
                                            <div class="agile_top_brand_left_grid1">
                                                <figure>
                                                    <div class="snipcart-item block" >
                                                        <div class="snipcart-thumb">
                                                            <a href="products.html"><img title=" " alt=" " src="images/12.png" /></a>
                                                            <p>Nestle-a-slim</p>
                                                            <div class="stars">
                                                                <i class="fa fa-star blue-star" aria-hidden="true"></i>
                                                                <i class="fa fa-star blue-star" aria-hidden="true"></i>
                                                                <i class="fa fa-star blue-star" aria-hidden="true"></i>
                                                                <i class="fa fa-star blue-star" aria-hidden="true"></i>
                                                                <i class="fa fa-star gray-star" aria-hidden="true"></i>
                                                            </div>
                                                            <h4>$20.99 <span>$35.00</span></h4>
                                                        </div>
                                                        <div class="snipcart-details top_brand_home_details">
                                                            <form action="#" method="post">
                                                                <fieldset>
                                                                    <input type="hidden" name="cmd" value="_cart" />
                                                                    <input type="hidden" name="add" value="1" />
                                                                    <input type="hidden" name="business" value=" " />
                                                                    <input type="hidden" name="item_name" value="basmati rise" />
                                                                    <input type="hidden" name="amount" value="20.99" />
                                                                    <input type="hidden" name="discount_amount" value="1.00" />
                                                                    <input type="hidden" name="currency_code" value="USD" />
                                                                    <input type="hidden" name="return" value=" " />
                                                                    <input type="hidden" name="cancel_return" value=" " />
                                                                    <input type="submit" name="submit" value="Add to cart" class="button" />
                                                                </fieldset>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </figure>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 top_brand_left">
                                    <div class="hover14 column">
                                        <div class="agile_top_brand_left_grid">
                                            <div class="agile_top_brand_left_grid_pos">
                                                <img src="images/offer.png" alt=" " class="img-responsive" />
                                            </div>
                                            <div class="agile_top_brand_left_grid1">
                                                <figure>
                                                    <div class="snipcart-item block">
                                                        <div class="snipcart-thumb">
                                                            <a href="products.html"><img src="images/13.png" alt=" " class="img-responsive" /></a>
                                                            <p>Bread-sandwich</p>
                                                            <div class="stars">
                                                                <i class="fa fa-star blue-star" aria-hidden="true"></i>
                                                                <i class="fa fa-star blue-star" aria-hidden="true"></i>
                                                                <i class="fa fa-star blue-star" aria-hidden="true"></i>
                                                                <i class="fa fa-star blue-star" aria-hidden="true"></i>
                                                                <i class="fa fa-star gray-star" aria-hidden="true"></i>
                                                            </div>
                                                            <h4>$40.99 <span>$65.00</span></h4>
                                                        </div>
                                                        <div class="snipcart-details top_brand_home_details">
                                                            <form action="#" method="post">
                                                                <fieldset>
                                                                    <input type="hidden" name="cmd" value="_cart" />
                                                                    <input type="hidden" name="add" value="1" />
                                                                    <input type="hidden" name="business" value=" " />
                                                                    <input type="hidden" name="item_name" value="Pepsi soft drink" />
                                                                    <input type="hidden" name="amount" value="40.00" />
                                                                    <input type="hidden" name="discount_amount" value="1.00" />
                                                                    <input type="hidden" name="currency_code" value="USD" />
                                                                    <input type="hidden" name="return" value=" " />
                                                                    <input type="hidden" name="cancel_return" value=" " />
                                                                    <input type="submit" name="submit" value="Add to cart" class="button" />
                                                                </fieldset>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </figure>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"> </div>
                            </div>
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
            <div class="agile_top_brands_grids">
                @foreach($ofertas as $oferta)
                    <div class="col-md-4 top_brand_left">
                        <div class="hover14 column">
                            <div class="agile_top_brand_left_grid">
                                <div class="agile_top_brand_left_grid_pos">
                                    <img src="images/offer.png" alt=" " class="img-responsive" />
                                </div>
                                <div class="agile_top_brand_left_grid1">
                                    <figure>
                                        <div class="snipcart-item block" >
                                            <div class="snipcart-thumb">
                                                <a href="products.html">
                                                    @if($oferta->produto->imagem()->first() != null)
                                                        <img src="{{$oferta->produto->imagem()->first()->caminho}}" alt="" width="150" height="150">
                                                    @endif
                                                </a>
                                                <p>{{$oferta->produto->nome}}</p>
                                                <div class="stars">
                                                    <i class="fa fa-star blue-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star blue-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star blue-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star blue-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star gray-star" aria-hidden="true"></i>
                                                </div>
                                                <h4>{{$oferta->preco_promocao}} <span>{{$oferta->preco_normal}}</span></h4>
                                            </div>
                                            <div class="snipcart-details top_brand_home_details">
                                                <form action="#" method="post">
                                                    <fieldset>
                                                        <input type="hidden" name="cmd" value="_cart" />
                                                        <input type="hidden" name="add" value="1" />
                                                        <input type="hidden" name="business" value=" " />
                                                        <input type="hidden" name="item_name" value="{{$oferta->produto->nome}}" />
                                                        <input type="hidden" name="amount" value="{{$oferta->preco_normal}}" />
                                                        <input type="hidden" name="discount_amount" value="0.0" />
                                                        <input type="hidden" name="currency_code" value="USD" />
                                                        <input type="hidden" name="return" value=" " />
                                                        <input type="hidden" name="cancel_return" value=" " />
                                                        <input type="submit" name="submit" value="Add to cart" class="button" />
                                                    </fieldset>
                                                </form>
                                            </div>
                                        </div>
                                    </figure>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if($loop->iteration % 3 == 0)
                        <div class="clearfix"> </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
    <!-- //new -->
@endsection