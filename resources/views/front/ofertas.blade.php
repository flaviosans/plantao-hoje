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
                <div>
                @component('front.comp.lista-ofertas', ['ofertas' => $ofertas])
                @endcomponent
                </div>
                <div class="container">
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
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
    <!--- products --->
    <!-- //footer -->
@endsection