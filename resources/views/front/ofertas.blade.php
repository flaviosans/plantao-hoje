@extends('layouts.app')
@section('content')
    <!-- //breadcrumbs -->
    <!--- products --->
    <div class="products">
        <div class="container">
            <div class="col-md-4 products-left">
                <div class="categories">
                    <h2>Categorias</h2>
                    <ul class="cate">
                        @foreach(\App\Categoria::where('pai', '0')->get() as $pai)
                        <li><a href="products.html"><i class="fa fa-arrow-right" aria-hidden="true"></i>{{$pai->nome}}</a></li>
                            <ul>
                            @foreach(\App\Categoria::where('pai', $pai->id)->get() as $filho)
                                <li><a href="products.html"><i class="fa fa-arrow-right" aria-hidden="true"></i>{{$filho->nome}}</a></li>
                            @endforeach
                            </ul>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-md-8 products-right">
                <div class="products-right-grid">
                    <div class="products-right-grids">
                        <div class="sorting">
                            <select id="country" onchange="change_country(this.value)" class="frm-field required sect">
                                <option value="null"><i class="fa fa-arrow-right" aria-hidden="true"></i>Default sorting</option>
                                <option value="null"><i class="fa fa-arrow-right" aria-hidden="true"></i>Sort by popularity</option>
                                <option value="null"><i class="fa fa-arrow-right" aria-hidden="true"></i>Sort by average rating</option>
                                <option value="null"><i class="fa fa-arrow-right" aria-hidden="true"></i>Sort by price</option>
                            </select>
                        </div>
                        <div class="sorting-left">
                            <select id="country1" onchange="change_country(this.value)" class="frm-field required sect">
                                <option value="null"><i class="fa fa-arrow-right" aria-hidden="true"></i>Item on page 9</option>
                                <option value="null"><i class="fa fa-arrow-right" aria-hidden="true"></i>Item on page 18</option>
                                <option value="null"><i class="fa fa-arrow-right" aria-hidden="true"></i>Item on page 32</option>
                                <option value="null"><i class="fa fa-arrow-right" aria-hidden="true"></i>All</option>
                            </select>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                </div>
                <div class="agile_top_brands_grids">
                @foreach($ofertas as $oferta)
                    <div class="col-md-4 top_brand_left">
                        <div class="hover14 column">
                            <div class="agile_top_brand_left_grid">
                                <div class="agile_top_brand_left_grid_pos">
                                    <img src="images/offer.png" alt=" " class="img-responsive">
                                </div>
                                <div class="agile_top_brand_left_grid1">
                                    <figure>
                                        <div class="snipcart-item block">
                                            <div class="snipcart-thumb">
                                                <a href="single.html">
                                                    @if($oferta->produto->imagem()->first() != null)
                                                        <img class="img-responsive" src="{{$oferta->produto->imagem()->first()->caminho or ''}}" alt="" width="150" height="150">
                                                    @endif
                                                </a>
                                                <p>{{$oferta->produto->nome}}</p>
                                                <h4>R$ {{$oferta->preco_promocao}} <span>R$ {{$oferta->preco_normal}}</span></h4>
                                            </div>
                                            <div class="snipcart-details top_brand_home_details">
                                                <form action="#" method="post">
                                                    <fieldset>
                                                        <input type="hidden" name="cmd" value="_cart">
                                                        <input type="hidden" name="add" value="1">
                                                        <input type="hidden" name="business" value=" ">
                                                        <input type="hidden" name="item_name" value="{{$oferta->produto->nome}}">
                                                        <input type="hidden" name="amount" value="{{$oferta->preco_promocao_raw}}">
                                                        <input type="hidden" name="discount_amount" value="0">
                                                        <input type="hidden" name="currency_code" value="USD">
                                                        <input type="hidden" name="return" value=" ">
                                                        <input type="hidden" name="cancel_return" value=" ">
                                                        <input type="submit" name="submit" value="Add to cart" class="button">
                                                    </fieldset>
                                                </form>
                                            </div>
                                        </div>
                                    </figure>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if($loop->iteration % 3  == 0 || $loop->last)
                        <div class="clearfix"> </div>
                        </div>
                        <div class="agile_top_brands_grids">
                    @endif
                @endforeach
                <nav class="numbering">
                    <ul class="pagination paging">
                        <li>
                            <a href="#" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <li class="active"><a href="#">1<span class="sr-only">(current)</span></a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">5</a></li>
                        <li>
                            <a href="#" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
    <!--- products --->
    <!-- //footer -->
@endsection