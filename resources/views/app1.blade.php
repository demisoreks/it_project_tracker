<?php
use GuzzleHttp\Client;
?>
<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ $page_title }} | {{ config('app.name') }}</title>
        
        {!! Html::style('css/app.css') !!}
        {!! Html::style('css/mdb.min.css') !!}
        {!! Html::style('css/datatables.min.css') !!}
        {!! Html::style('fontawesome/css/all.css') !!}
        
        {!! Html::script('js/jquery-3.3.1.min.js') !!}
        {!! Html::script('js/popper.min.js') !!}
        {!! Html::script('js/app.js') !!}
        {!! Html::script('js/mdb.min.js') !!}
        {!! Html::script('js/datatables.min.js') !!}
        
        <script type="text/javascript">
            $(document).ready(function () {
                $('#myTable1').DataTable({
                    fixedHeader: true
                });
                $('#myTable2').DataTable({
                    fixedHeader: true
                });
                $('#myTable3').DataTable({
                    fixedHeader: true,
                    "order": [[ 0, "desc" ]]
                });
            });
            
            function confirmDisable() {
                if (confirm("Are you sure you want to disable this item?")) {
                    return true;
                } else {
                    return false;
                }
            }
            
            function confirmDelete() {
                if (confirm("Are you sure you want to completely delete this item?")) {
                    return true;
                } else {
                    return false;
                }
            }
        </script>

        <!-- Styles -->
        
    </head>
    <?php
    $more = "";
    if (isset($nest)) {
        for ($i=0; $i<$nest; $i++) {
            $more .= "../";
        }
    }
    
    if (!isset($_SESSION)) session_start();
    $halo_user = $_SESSION['halo_user'];
    
    $client = new Client();
    $res = $client->request('GET', DB::table('acc_config')->whereId(1)->first()->master_url.'/api/getRoles', [
        'query' => [
            'username' => $halo_user->username,
            'link_id' => 2
        ]
    ]);
    $permissions = json_decode($res->getBody());
    ?>
    <body style="background-color: white;">
        <div class="container-fluid">
            <div class="row bg-primary">
                <div class="col-6">{{ Html::image('images/logo-new-small.jpg', 'Halogen Logo', ['height' => '70px']) }}</div>
                <div class="col-6">
                    <div class="float-right text-white" style="display: flex; align-items: center; justify-content: center; height: 100%;">
                        {{ $halo_user->username }}
                    </div>
                </div>
            </div>
            <div class="row bg-secondary text-primary" style="padding: 5px 0;">
                <div class="col-12"><strong>{{ config('app.name') }}</strong></div>
            </div>
            <div class="row bg-secondary" style="margin-bottom: 20px;">
                <div class="col-12 no-gutters">
                    <nav class="navbar navbar-expand-lg navbar-light bg-light">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNavDropdown">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('welcome') }}">Home</a>
                                </li>
                                @if (count(array_intersect($permissions, ['Manager'])) != 0)
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('projects.index') }}">Projects</a>
                                </li>
                                @endif
                                @if (count(array_intersect($permissions, ['Manager'])) != 0)
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('vendors.index') }}">Vendors</a>
                                </li>
                                @endif
                                @if (count(array_intersect($permissions, ['Report'])) != 0)
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Reports
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink1">
                                        <a class="dropdown-item" href="{{ route('summary') }}">Summary</a>
                                    </div>
                                </li>
                                @endif
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <h1 class="page-header text-primary" style="border-bottom: 1px solid #CCC; padding-bottom: 20px; margin-bottom: 10px;">{{ $page_title }}</h1>
                    @include('commons.message')
                    @yield('content')
                </div>
            </div>
            <div class="row" style="border-top: solid 1px #CCC; margin: 20px 0;">
                <div class="col-lg-4 offset-lg-8 justify-content-end text-right">Powered by <a href="https://halogensecurity.com" target="_blank">Strategy Hub | Halogen Security Company</a></div>
            </div>
        </div>
    </body>
</html>
