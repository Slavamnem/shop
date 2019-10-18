<!doctype html>
<html lang="en" id="document">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('public/admin/assets/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link href="{{ asset('public/admin/assets/vendor/fonts/circular-std/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href=" {{ asset("public/admin/assets/libs/css/style.css") }} ">
    <link rel="stylesheet" href=" {{ asset("public/admin/assets/css/main.css") }} ">
    <link rel="stylesheet" href=" {{ asset("public/admin/assets/vendor/fonts/fontawesome/css/fontawesome-all.css") }}">
    <link rel="stylesheet" href=" {{ asset("public/admin/assets/vendor/charts/chartist-bundle/chartist.css") }}">
    <link rel="stylesheet" href=" {{ asset("public/admin/assets/vendor/charts/morris-bundle/morris.css") }}">
    <link rel="stylesheet" href=" {{ asset("public/admin/assets/vendor/fonts/material-design-iconic-font/css/materialdesignicons.min.css") }}">
    <link rel="stylesheet" href=" {{ asset("public/admin/assets/vendor/charts/c3charts/c3.css") }}">
    <link rel="stylesheet" href=" {{ asset("public/admin/assets/vendor/fonts/flag-icon-css/flag-icon.min.css") }}">
    <link rel="stylesheet" href=" {{ asset("public/admin/assets/vendor/multi-select/css/multi-select.css") }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datepicker/0.6.5/datepicker.min.css"/>
    <title>Concept - Bootstrap 4 Admin Dashboard Template</title>
</head>

<body>
    <!-- ============================================================== -->
    <!-- main wrapper -->
    <!-- ============================================================== -->
    <div class="dashboard-main-wrapper">
        <!-- ============================================================== -->
        <!-- navbar -->
        <!-- ============================================================== -->
        <div class="dashboard-header">
            <nav class="navbar navbar-expand-lg bg-white fixed-top">
                <a class="navbar-brand" href="/">Milan Shop</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse " id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto navbar-right-top">
                        <li class="nav-item">
                            <div id="custom-search" class="top-search-bar">
                                <p>
                                    <span>USD: {{ $usd_rate }}</span> <span>EUR: {{ $eur_rate }}</span>
                                    <audio src="http://www.last.fm/music/Disturbed/_/Believ"></audio>
                                </p>
                            </div>
                        </li>
                        <li class="nav-item">
                            <div id="custom-search" class="top-search-bar">
                                <h4 align="center" class="alert-success">Welcome, {{ Auth::user()->name }}({{ implode(", ", Auth::user()->roles->pluck("name")->toArray()) }})</h4>
                            </div>
                        </li>
                        <li class="nav-item">
                            <div id="custom-search" class="top-search-bar">
                                <input class="form-control" type="text" placeholder="Search..">
                            </div>
                        </li>
                        <li class="nav-item dropdown notification">
                            <a class="nav-link nav-icons" href="#" id="navbarDropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-fw fa-bell"></i>
                                @if(count($notifications))
                                    <span class="indicator"></span>
                                @endif
                            </a>
                            <ul class="dropdown-menu dropdown-menu-right notification-dropdown" id="notifications">
                                <li>
                                    <div class="notification-title" style="background-color: red"> Notification</div>
                                    <div class="notification-list">
                                        <div class="list-group">
                                            @foreach($notifications as $notification)
                                                <a href="{{route('admin-notifications-show', ['id' => $notification->id])}}" class="list-group-item list-group-item-action active" style="background-color: gold">
                                                    <div class="notification-info">
                                                        <div class="notification-list-user-img"><img src="assets/images/avatar-2.jpg" alt="" class="user-avatar-md rounded-circle"></div>
                                                        <div class="notification-list-user-block">
                                                            <span class="notification-list-user-name">{{$notification->preview}}</span>
                                                            <span style="color:{{$notification->priority->color}}; font-size:12px; font-family:Circular Std Medium">({{$notification->priority->name}})</span>
                                                            <div class="notification-date">{{$notification->created_at}}</div>
                                                        </div>
                                                    </div>
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="list-footer"> <a href="{{route('admin-notifications')}}">View all notifications</a></div>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown connection">
                            <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fas fa-fw fa-th"></i> </a>
                            <ul class="dropdown-menu dropdown-menu-right connection-dropdown">
                                <li class="connection-list">
                                    <div class="row">
                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 ">
                                            <a href="#" class="connection-item"><img src="assets/images/github.png" alt="" > <span>Github</span></a>
                                        </div>
                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 ">
                                            <a href="#" class="connection-item"><img src="assets/images/dribbble.png" alt="" > <span>Dribbble</span></a>
                                        </div>
                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 ">
                                            <a href="#" class="connection-item"><img src="assets/images/dropbox.png" alt="" > <span>Dropbox</span></a>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 ">
                                            <a href="#" class="connection-item"><img src="assets/images/bitbucket.png" alt=""> <span>Bitbucket</span></a>
                                        </div>
                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 ">
                                            <a href="#" class="connection-item"><img src="assets/images/mail_chimp.png" alt="" ><span>Mail chimp</span></a>
                                        </div>
                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 ">
                                            <a href="#" class="connection-item"><img src="assets/images/slack.png" alt="" > <span>Slack</span></a>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="conntection-footer"><a href="#">More</a></div>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown nav-user">
                            <a class="nav-link nav-user-img" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="assets/images/avatar-1.jpg" alt="" class="user-avatar-md rounded-circle"></a>
                            <div class="dropdown-menu dropdown-menu-right nav-user-dropdown" aria-labelledby="navbarDropdownMenuLink2">
                                <div class="nav-user-info">
                                    <h5 class="mb-0 text-white nav-user-name">John Abraham </h5>
                                    <span class="status"></span><span class="ml-2">Available</span>
                                </div>
                                <a class="dropdown-item" href="#"><i class="fas fa-user mr-2"></i>Account</a>
                                <a class="dropdown-item" href="#"><i class="fas fa-cog mr-2"></i>Setting</a>
                                <a class="dropdown-item" href="#"><i class="fas fa-power-off mr-2"></i>Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <!-- ============================================================== -->
        <!-- end navbar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- left sidebar -->
        <!-- ============================================================== -->
        <div class="nav-left-sidebar sidebar-dark">
            <div class="menu-list">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="d-xl-none d-lg-none" href="#">Статистика</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav flex-column">
                            <li class="nav-divider">
                                Меню
                            </li>

                            @if(Auth::user()->can('watchStat', \App\User::class))
                            <li class="nav-item ">
                                <a class="nav-link @if(@$activeMenuItem == "stat"){ {{ "active" }} } @endif" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-1" aria-controls="submenu-1"><i class="fa fa-fw fa-user-circle"></i>Статистика (old)<span class="badge badge-success">6</span></a>
                                <div id="submenu-1" class="collapse submenu" style="">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-1-2" aria-controls="submenu-1-2">E-Commerce</a>
                                            <div id="submenu-1-2" class="collapse submenu" style="">
                                                <ul class="nav flex-column">
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="index.html">E Commerce Dashboard</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="ecommerce-product.html">Product List</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="ecommerce-product-single.html">Product Single</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="ecommerce-product-checkout.html">Product Checkout</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="dashboard-finance.html">Finance</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="dashboard-sales.html">Sales</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-1-1" aria-controls="submenu-1-1">Infulencer</a>
                                            <div id="submenu-1-1" class="collapse submenu" style="">
                                                <ul class="nav flex-column">
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="dashboard-influencer.html">Influencer</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="influencer-finder.html">Influencer Finder</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="influencer-profile.html">Influencer Profile</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            @endif

                            @if(Auth::user()->can('watchSiteElements', \App\User::class))
                                <li class="nav-item ">
                                    <a class="nav-link @if(@$activeMenuItem == "site-elements"){ {{ "active" }} } @endif" href="{{ route("admin-site-elements") }}"><i class="fas fa-fw fa-table"></i>Управление сайтом</a>
                                </li>
                            @endif

                            @if(Auth::user()->can('watchCommands', \App\User::class))
                            <li class="nav-item ">
                                <a class="nav-link @if(@$activeMenuItem == "commands"){ {{ "active" }} } @endif" href="{{ route("admin-commands") }}"><i class="fas fa-fw fa-table"></i>Команды</a>
                            </li>
                            @endif

                            @if(Auth::user()->can('watchStat', \App\User::class))
                            <li class="nav-item ">
                                <a class="nav-link @if(@$activeMenuItem == "stats"){ {{ "active" }} } @endif" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-2" aria-controls="submenu-2">
                                    <i class="fa fa-fw fa-user-circle"></i>Статистика
                                    <span class="badge badge-success">6</span>
                                </a>
                                <div id="submenu-2" class="collapse submenu" style="">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route("admin-stats") }}">Статистика заказы</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route("admin-stats-top-products") }}">Топ товаров</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route("admin-stats-top-clients") }}">Топ клиентов</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            @endif

                            {{--<li class="nav-item ">--}}
                                {{--<a class="nav-link @if(@$activeMenuItem == "stats"){ {{ "active" }} } @endif" href="{{ route("admin-stats") }}"><i class="fas fa-fw fa-table"></i>Статистика</a>--}}
                            {{--</li>--}}

                            @if(Auth::user()->can('watchCategories', \App\User::class))
                            <li class="nav-item ">
                                <a class="nav-link @if(@$activeMenuItem == "categories"){ {{ "active" }} } @endif" href="{{ route("admin-categories") }}"><i class="fas fa-fw fa-table"></i>Категории</a>
                            </li>
                            @endif

                            @if(Auth::user()->can('watchProducts', \App\User::class))
                            <li class="nav-item ">
                                <a class="nav-link @if(@$activeMenuItem == "products"){ {{ "active" }} } @endif" href="{{ route("admin-products") }}"><i class="fas fa-fw fa-table"></i>Товары</a>
                            </li>
                            @endif

                            <li class="nav-item">
                                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-3" aria-controls="submenu-2">
                                    <i class="fa fa-fw fa-rocket"></i>Свойства товаров
                                </a>
                                <div id="submenu-3" class="collapse submenu" style="">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link @if(@$activeMenuItem == "product-statuses"){ {{ "active" }} } @endif" href="{{ route("admin-product-statuses") }}">Статусы</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link @if(@$activeMenuItem == "product-colors"){ {{ "active" }} } @endif" href="{{ route("admin-colors") }}">Цвета</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link @if(@$activeMenuItem == "product-sizes"){ {{ "active" }} } @endif" href="{{ route("admin-sizes") }}">Размеры</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            @if(Auth::user()->can('watchModels', \App\User::class))
                            <li class="nav-item ">
                                <a class="nav-link @if(@$activeMenuItem == "groups"){ {{ "active" }} } @endif" href="{{ route("admin-groups") }}"><i class="fas fa-fw fa-table"></i>Модели</a>
                            </li>
                            @endif

                            @if(Auth::user()->can('watchShares', \App\User::class))
                            <li class="nav-item ">
                                <a class="nav-link @if(@$activeMenuItem == "shares"){ {{ "active" }} } @endif" href="{{ route("admin-shares") }}"><i class="fas fa-fw fa-table"></i>Акции</a>
                            </li>
                            @endif

                            @if(Auth::user()->can('watchSeo', \App\User::class))
                            <li class="nav-item ">
                                <a class="nav-link @if(@$activeMenuItem == "ceo"){ {{ "active" }} } @endif" href="{{ route("admin-ceo") }}"><i class="fas fa-fw fa-table"></i>CEO</a>
                            </li>
                            @endif

                            @if(Auth::user()->can('watchNotifications', \App\User::class))
                            <li class="nav-item ">
                                <a class="nav-link @if(@$activeMenuItem == "notifications"){ {{ "active" }} } @endif" href="{{ route("admin-notifications") }}"><i class="fas fa-fw fa-table"></i>Уведомления</a>
                            </li>
                            @endif

                            <li class="nav-divider">
                                _________________________
                            </li>

                            @if(Auth::user()->can('watchOrders', \App\User::class))
                            <li class="nav-item ">
                                <a class="nav-link @if(@$activeMenuItem == "orders"){ {{ "active" }} } @endif" href="{{ route("admin-orders") }}"><i class="fas fa-fw fa-table"></i>Заказы</a>
                            </li>
                            @endif

                            @if(Auth::user()->can('watchClients', \App\User::class))
                            <li class="nav-item ">
                                <a class="nav-link @if(@$activeMenuItem == "clients"){ {{ "active" }} } @endif" href="{{ route("admin-clients") }}"><i class="fas fa-fw fa-table"></i>Клиенты</a>
                            </li>
                            @endif

                            @if(Auth::user()->can('watchStock', \App\User::class))
                            <li class="nav-item ">
                                <a class="nav-link @if(@$activeMenuItem == "stock"){ {{ "active" }} } @endif" href="{{ route("admin-stock") }}"><i class="fas fa-fw fa-table"></i>Склад</a>
                            </li>
                            @endif

                            <li class="nav-divider">
                                _________________________
                            </li>

                            @if(Auth::user()->can('watchAuth', \App\User::class))
                            <li class="nav-item ">
                                <a class="nav-link @if(@$activeMenuItem == "admin-auth"){ {{ "active" }} } @endif" href="{{ route("admin-auth") }}"><i class="fas fa-fw fa-table"></i>Входы в админ-панель</a>
                            </li>
                            @endif

                            @if(Auth::user()->can('watchDeliveryTypes', \App\User::class))
                            <li class="nav-item ">
                                <a class="nav-link @if(@$activeMenuItem == "delivery-type"){ {{ "active" }} } @endif" href="{{ route("admin-delivery-type") }}"><i class="fas fa-fw fa-table"></i>Типы доставки</a>
                            </li>
                            @endif

                            @if(Auth::user()->can('watchPaymentTypes', \App\User::class))
                            <li class="nav-item ">
                                <a class="nav-link @if(@$activeMenuItem == "payment-type"){ {{ "active" }} } @endif" href="{{ route("admin-payment-type") }}"><i class="fas fa-fw fa-table"></i>Типы оплаты</a>
                            </li>
                            @endif

                            @if(Auth::user()->can('watchUsers', \App\User::class))
                            <li class="nav-item ">
                                <a class="nav-link @if(@$activeMenuItem == "users"){ {{ "active" }} } @endif" href="{{ route("admin-users") }}"><i class="fas fa-fw fa-table"></i>Пользователи</a>
                            </li>
                            @endif

                            @if(Auth::user()->can('watchRoles', \App\User::class))
                            <li class="nav-item ">
                                <a class="nav-link @if(@$activeMenuItem == "roles"){ {{ "active" }} } @endif" href="{{ route("admin-roles") }}"><i class="fas fa-fw fa-table"></i>Роли</a>
                            </li>
                            @endif

                            <li class="nav-item ">
                                <a class="nav-link @if(@$activeMenuItem == "NewYorkTimes"){ {{ "active" }} } @endif" href="{{ route("admin-new-york-times") }}"><i class="fas fa-fw fa-table"></i>NewYorkTimes</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-2" aria-controls="submenu-2"><i class="fa fa-fw fa-rocket"></i>UI Elements</a>
                                <div id="submenu-2" class="collapse submenu" style="">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="pages/cards.html">Cards <span class="badge badge-secondary">New</span></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="pages/general.html">General</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="pages/carousel.html">Carousel</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="pages/listgroup.html">List Group</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="pages/typography.html">Typography</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="pages/accordions.html">Accordions</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="pages/tabs.html">Tabs</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-3" aria-controls="submenu-3"><i class="fas fa-fw fa-chart-pie"></i>Chart</a>
                                <div id="submenu-3" class="collapse submenu" style="">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="pages/chart-c3.html">C3 Charts</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="pages/chart-chartist.html">Chartist Charts</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="pages/chart-charts.html">Chart</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="pages/chart-morris.html">Morris</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="pages/chart-sparkline.html">Sparkline</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="pages/chart-gauge.html">Guage</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-4" aria-controls="submenu-4"><i class="fab fa-fw fa-wpforms"></i>Forms</a>
                                <div id="submenu-4" class="collapse submenu" style="">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="pages/form-elements.html">Form Elements</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="pages/form-validation.html">Parsely Validations</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="pages/multiselect.html">Multiselect</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="pages/datepicker.html">Date Picker</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="pages/bootstrap-select.html">Bootstrap Select</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-5" aria-controls="submenu-5"><i class="fas fa-fw fa-table"></i>Tables</a>
                                <div id="submenu-5" class="collapse submenu" style="">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="pages/general-table.html">General Tables</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="pages/data-tables.html">Data Tables</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-divider">
                                Features
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-6" aria-controls="submenu-6"><i class="fas fa-fw fa-file"></i> Pages </a>
                                <div id="submenu-6" class="collapse submenu" style="">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="pages/blank-page.html">Blank Page</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="pages/blank-page-header.html">Blank Page Header</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="pages/login.html">Login</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="pages/404-page.html">404 page</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="pages/sign-up.html">Sign up Page</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="pages/forgot-password.html">Forgot Password</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="pages/pricing.html">Pricing Tables</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="pages/timeline.html">Timeline</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="pages/calendar.html">Calendar</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="pages/sortable-nestable-lists.html">Sortable/Nestable List</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="pages/widgets.html">Widgets</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="pages/media-object.html">Media Objects</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="pages/cropper-image.html">Cropper</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="pages/color-picker.html">Color Picker</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-7" aria-controls="submenu-7"><i class="fas fa-fw fa-inbox"></i>Apps <span class="badge badge-secondary">New</span></a>
                                <div id="submenu-7" class="collapse submenu" style="">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="pages/inbox.html">Inbox</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="pages/email-details.html">Email Detail</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="pages/email-compose.html">Email Compose</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="pages/message-chat.html">Message Chat</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-8" aria-controls="submenu-8"><i class="fas fa-fw fa-columns"></i>Icons</a>
                                <div id="submenu-8" class="collapse submenu" style="">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="pages/icon-fontawesome.html">FontAwesome Icons</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="pages/icon-material.html">Material Icons</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="pages/icon-simple-lineicon.html">Simpleline Icon</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="pages/icon-themify.html">Themify Icon</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="pages/icon-flag.html">Flag Icons</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="pages/icon-weather.html">Weather Icon</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-9" aria-controls="submenu-9"><i class="fas fa-fw fa-map-marker-alt"></i>Maps</a>
                                <div id="submenu-9" class="collapse submenu" style="">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="pages/map-google.html">Google Maps</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="pages/map-vector.html">Vector Maps</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-10" aria-controls="submenu-10"><i class="fas fa-f fa-folder"></i>Menu Level</a>
                                <div id="submenu-10" class="collapse submenu" style="">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="#">Level 1</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-11" aria-controls="submenu-11">Level 2</a>
                                            <div id="submenu-11" class="collapse submenu" style="">
                                                <ul class="nav flex-column">
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="#">Level 1</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="#">Level 2</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#">Level 3</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- end left sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- wrapper  -->
        <!-- ============================================================== -->
        <div class="dashboard-wrapper">


            @yield('content')

            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <div class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            Copyright © 2018 Concept. All rights reserved. Dashboard by <a href="https://colorlib.com/wp/">Colorlib</a>.
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="text-md-right footer-links d-none d-sm-block">
                                <a href="javascript: void(0);">About</a>
                                <a href="javascript: void(0);">Support</a>
                                <a href="javascript: void(0);">Contact Us</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- end footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- end wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- end main wrapper  -->


    <div class="dropdown-menu dropdown-menu-right modal" id="new_notifications"></div>


    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
    <!-- jquery 3.3.1 -->
    <script src="{{ asset("public/admin/assets/vendor/jquery/jquery-3.3.1.min.js") }}"></script>
    <!-- bootstap bundle js -->
    <script src="{{ asset("public/admin/assets/vendor/bootstrap/js/bootstrap.bundle.js") }}"></script>
    <!-- slimscroll js -->
    <script src="{{ asset("public/admin/assets/vendor/slimscroll/jquery.slimscroll.js") }}"></script>
    <!-- main js -->
    <script src="{{ asset("public/admin/assets/libs/js/main-js.js") }}"></script>
    <!-- chart chartist js -->
    <script src="{{ asset("public/admin/assets/vendor/charts/chartist-bundle/chartist.min.js") }}"></script>
    <!-- sparkline js -->
    <script src="{{ asset("public/admin/assets/vendor/charts/sparkline/jquery.sparkline.js") }}"></script>
    <!-- morris js -->
    <script src="{{ asset("public/admin/assets/vendor/charts/morris-bundle/raphael.min.js") }}"></script>
    <script src="{{ asset("public/admin/assets/vendor/charts/morris-bundle/morris.js") }}"></script>
    <!-- chart c3 js -->
    <script src="{{ asset("public/admin/assets/vendor/charts/c3charts/c3.min.js") }}"></script>
    <script src="{{ asset("public/admin/assets/vendor/charts/c3charts/d3-5.4.0.min.js") }}"></script>
    <script src="{{ asset("public/admin/assets/vendor/charts/c3charts/C3chartjs.js") }}"></script>
    <script src="{{ asset("public/admin/assets/libs/js/dashboard-ecommerce.js") }}"></script>

    <script src="{{ asset("public/admin/assets/js/main/main.js") }}"></script>

    @yield("custom-js")
    @yield("custom-css")
</body>

</html>