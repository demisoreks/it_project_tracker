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
    <body style="background-color: #f6f7fb;">
        <div class="container-fluid" style="height: 100vh;">
            <div class="row bg-primary">
                <div class="col-md-6">
                    <div class="text-white float-left" style="display: flex; align-items: center; justify-content: center;">
                        {{ Html::image('images/logo-new-small.jpg', 'Halogen Logo', ['width' => 60]) }}&nbsp;&nbsp;
                        <h4><span class="font-weight-bold">Halo</span>Pivot - {{ config('app.name') }}</h4>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="float-right text-white" style="display: flex; align-items: center; justify-content: center; height: 100%;">
                        {{ $halo_user->username }}
                    </div>
                </div>
            </div>
            <div class="row bg-secondary">
                <div class="col-12" style="height: 10px;">
                    
                </div>
            </div>
            <div class="row">
                <div class="col-12 text-center">
                    <h1 class="page-header" style="border-bottom: 1px solid #999; padding: 30px 0; margin-bottom: 20px; color: #999;">{{ $page_title }}</h1>
                </div>
            </div>
            @include('commons.message')
            <div class="row">
                <div class="col-md-2">
                    <div class="card" style="margin-bottom: 10px;">
                        <div class="card-body text-center text-primary">
                            <a href="{{ route('welcome') }}">
                                <h3><i class="fas fa-home"></i></h3>
                                Home
                            </a>
                        </div>
                    </div>
                    @if (count(array_intersect($permissions, ['Manager'])) != 0)
                    <div class="card" style="margin-bottom: 10px;">
                        <div class="card-body text-center">
                            <a href="{{ route('projects.index') }}">
                                <h3><i class="fas fa-project-diagram"></i></h3>
                                Projects
                            </a>
                        </div>
                    </div>
                    <div class="card" style="margin-bottom: 10px;">
                        <div class="card-body text-center">
                            <a href="{{ route('vendors.index') }}">
                                <h3><i class="fas fa-industry"></i></h3>
                                Vendors
                            </a>
                        </div>
                    </div>
                    @endif
                    @if (count(array_intersect($permissions, ['Report'])) != 0)
                    <div class="card" style="margin-bottom: 10px;">
                        <div class="card-body text-center">
                            <a href="{{ route('summary') }}">
                                <h3><i class="fas fa-chart-bar"></i></h3>
                                Summary
                            </a>
                        </div>
                    </div>
                    @endif
                </div>
                <div class="col-md-10">
                    <div class="card">
                        <div class="card-body bg-white" style="padding: 20px;">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 justify-content-end text-right">
                    <div style="border-top: 1px solid #999; margin-top: 20px; padding: 10px 0;">Powered by <a href="https://halogensecurity.com" target="_blank">Strategy Hub | Halogen Security Company</a></div>
                </div>
            </div>
        </div>
    </body>
</html>
