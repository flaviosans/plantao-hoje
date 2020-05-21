<div class="app-sidebar sidebar-shadow">
    <div class="app-header__logo">
        <div class="logo-src"></div>
        <div class="header__pane ml-auto">
            <div>
                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic"
                        data-class="closed-sidebar">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
    </div>
    <div class="app-header__mobile-menu">
        <div>
            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </button>
        </div>
    </div>
    <div class="app-header__menu">
        <span>
            <button type="button"
                    class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                <span class="btn-icon-wrapper">
                    <i class="fa fa-ellipsis-v fa-w-6"></i>
                </span>
            </button>
        </span>
    </div>
    <div class="scrollbar-sidebar">
        <div class="app-sidebar__inner">
            <ul class="vertical-nav-menu">
                <li class="app-sidebar__heading"><a href="{{asset('/')}}">Vistar o site</a></li>
                <li class="app-sidebar__heading">Analisar</li>
                <li>
                    <a href="{{route('home.dashboard')}}">
                        <i class="metismenu-icon pe-7s-diamond"></i>
                        Dashboard
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul>
                        <li>
                            <a href="{{route('home.dashboard')}}">
                                <i class="metismenu-icon"></i>
                                Início
                            </a>
                        </li>
                        <li>
                            <a href="elements-buttons-standard.html">
                                <i class="metismenu-icon"></i>
                                Pedidos em andamento
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="metismenu-icon"></i>
                                sd
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#">
                        <i class="metismenu-icon pe-7s-diamond"></i>
                        Dashboard
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul>
                        <li>
                            <a href="#">
                                <i class="metismenu-icon"></i>
                                qqqq
                            </a>
                        </li>

                    </ul>
                </li>
                <li class="app-sidebar__heading">Vender</li>
                <li>
                    <a href="#">
                        <i class="metismenu-icon pe-7s-diamond"></i>
                        Pedidos
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul>
                        <li>
                            <a href="{{route('pedidos.index')}}">
                                <i class="metismenu-icon"></i>
                                Pedidos recebidos
                            </a>
                        </li>
                        {{--<li>
                            <a href="elements-buttons-standard.html">
                                <i class="metismenu-icon"></i>
                                Pedidos em andamento
                            </a>
                        </li>
                        <li>
                            <a href="elements-buttons-standard.html">
                                <i class="metismenu-icon"></i>
                                Pedidos concluídos
                            </a>
                        </li>--}}
                    </ul>
                </li>
                <li>
                    <a href="#">
                        <i class="metismenu-icon pe-7s-diamond"></i>
                        Cotações
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul>
                        <li>
                            <a href="{{route('cotacoes.publicadas')}}">
                                <i class="metismenu-icon"></i>
                                Cotações publicadas
                            </a>
                        </li>
                        <li>
                            <a href="elements-buttons-standard.html">
                                <i class="metismenu-icon"></i>
                                Pedidos em andamento
                            </a>
                        </li>
                        <li>
                            <a href="elements-buttons-standard.html">
                                <i class="metismenu-icon"></i>
                                Pedidos concluídos
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="app-sidebar__heading">Publicar</li>
                <li>
                    <a href="#">
                        <i class="metismenu-icon pe-7s-diamond"></i>
                        Campanhas & Ofertas
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul>
                        <li>
                            <a href="{{route('campanhas.index')}}">
                                <i class="metismenu-icon"></i>
                                Todas as campanhas
                            </a>
                        </li>
                        <li>
                            <a href="{{route('campanhas.create')}}">
                                <i class="metismenu-icon"></i>
                                Nova campanha
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#">
                        <i class="metismenu-icon pe-7s-diamond"></i>
                        Banners
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul>
                        <li>
                            <a href="{{route('banners.index')}}">
                                <i class="metismenu-icon"></i>
                                Todos os banners
                            </a>
                        </li>
                        <li>
                            <a href="{{route('banners.create')}}">
                                <i class="metismenu-icon"></i>
                                Novo banner
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="app-sidebar__heading">Cadastrar</li>
                <li>
                    <a href="#">
                        <i class="metismenu-icon pe-7s-diamond"></i>
                        Marcas
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul>
                        <li>
                            <a href="{{route('marcas.index')}}">
                                <i class="metismenu-icon"></i>
                                Todas as marcas
                            </a>
                        </li>
                        <li>
                            <a href="{{route('marcas.create')}}">
                                <i class="metismenu-icon"></i>
                                Nova marca
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#">
                        <i class="metismenu-icon pe-7s-diamond"></i>
                        Categorias
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul>
                        <li>
                            <a href="{{route('categorias.index')}}">
                                <i class="metismenu-icon"></i>
                                Todas as categorias
                            </a>
                        </li>
                        <li>
                            <a href="{{route('categorias.create')}}">
                                <i class="metismenu-icon"></i>
                                Nova categoria
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#">
                        <i class="metismenu-icon pe-7s-diamond"></i>
                        Produtos
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul>
                        <li>
                            <a href="{{route('produtos.index')}}">
                                <i class="metismenu-icon"></i>
                                Todos os produtos
                            </a>
                        </li>
                        <li>
                            <a href="{{route('produtos.create')}}">
                                <i class="metismenu-icon"></i>
                                Novo produto
                            </a>
                        </li>
                        <li>
                            <a href="{{route('produtos.importar')}}">
                                <i class="metismenu-icon"></i>
                                Importar produtos
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>