@foreach($ofertas as $oferta)
    @if($loop->index % 3 == 0)
        <div class="agile_top_brands_grids">
            @endif
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
                                        <h4>
                                            {{$oferta->preco_promocao}}
                                            @if($oferta->preco_normal != $oferta->preco_promocao)
                                            <span>{{$oferta->preco_normal}}</span>
                                            @endif

                                        </h4>
                                    </div>
                                    <div class="snipcart-details top_brand_home_details">
                                        <form action="#" method="post">
                                            <fieldset>
                                                <input type="hidden" name="nome" value="{{$oferta->produto->nome}}" />
                                                <input type="hidden" name="preco_normal" value="{{$oferta->preco_normal}}" />
                                                <input type="hidden" name="preco_promocao" value="{{$oferta->preco_promocao}}" />
                                                <input type="hidden" name="quantidade" value="USD" />
                                                <input type="submit" name="submit" value="Comprar" class="button" />
                                            </fieldset>
                                        </form>
                                    </div>
                                </div>
                            </figure>
                        </div>
                    </div>
                </div>
            </div>
            @if($loop->index % 3 == 2 || $loop->last)
                <div class="clearfix"> </div>
        </div>
    @endif

@endforeach