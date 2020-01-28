@extends('app', ['page_title' => 'Project Tracker', 'more' => 2])

<?php
use GuzzleHttp\Client;

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
@section('content')
@include('commons.message')

<div class="row">
    <div class="col-lg-2">
        <legend>Quick Links</legend>
        @if (count(array_intersect($permissions, ['Manager'])) != 0)
        <div class="card">
            <div class="card-body text-center">
                <a href="{{ route('projects.index') }}">
                    <h1 class="text-primary"><i class="fas fa-project-diagram"></i></h1>
                    <h3 class="text-primary">Projects</h3>
                </a>
            </div>
        </div>
        <div class="card">
            <div class="card-body text-center">
                <a href="{{ route('vendors.index') }}">
                    <h1 class="text-primary"><i class="fas fa-industry"></i></h1>
                    <h3 class="text-primary">Vendors</h3>
                </a>
            </div>
        </div>
        @endif
        @if (count(array_intersect($permissions, ['Report'])) != 0)
        <div class="card">
            <div class="card-body text-center">
                <a href="{{ route('summary') }}">
                    <h1 class="text-primary"><i class="fas fa-chart-bar"></i></h1>
                    <h3 class="text-primary">Summary</h3>
                </a>
            </div>
        </div>
        @endif
    </div>
    <div class="col-lg-5">
        <legend>Overdue Projects</legend>
        <table class="table table-striped table-bordered table-hover table-danger">
            <tr>
                <th class="text-center">NAME</th>
                <th class="text-center">VENDOR</th>
                <th width="20%" class="text-center">START DATE</th>
                <th width="20%" class="text-center">END DATE</th>
            </tr>
            @foreach (App\PtrProject::where('status', 'A')->where('end_date', '<', date('Y-m-d'))->orderBy('end_date')->get() as $project)
            <tr>
                <td><a href="{{ route('projects.breakdown', $project->slug()) }}">{{ $project->name }}</a></td>
                <td>{{ $project->vendor->name }}</td>
                <td class="text-center">{{ $project->start_date }}</td>
                <td class="text-center">{{ $project->end_date }}</td>
            </tr>
            @endforeach
        </table>
        <legend>Countdown (30 days)</legend>
        <table class="table table-striped table-bordered table-hover table-warning">
            <tr>
                <th class="text-center">NAME</th>
                <th class="text-center">VENDOR</th>
                <th width="20%" class="text-center">START DATE</th>
                <th width="20%" class="text-center">END DATE</th>
            </tr>
            @foreach (App\PtrProject::where('status', 'A')->where('end_date', '>=', date('Y-m-d'))->whereRaw('DATEDIFF(end_date, now()) < 30')->orderBy('end_date')->get() as $project)
            <tr>
                <td><a href="{{ route('projects.breakdown', $project->id) }}">{{ $project->name }}</a></td>
                <td>{{ $project->vendor->name }}</td>
                <td class="text-center">{{ $project->start_date }}</td>
                <td class="text-center">{{ $project->end_date }}</td>
            </tr>
            @endforeach
        </table>
    </div>
    <div class="col-lg-5">
        <legend>On Track/Overdue</legend>
        <div class="card" style="margin-bottom: 20px;">
            <div class="card-body">
                <div id="project-status-data" style="width: 100%; height: 400px;"></div>
                @piechart('PSD', 'project-status-data')
            </div>
        </div>
        <legend>Expense Summary</legend>
        <div class="card">
            <div class="card-body">
                <div id="project-cost-data" style="width: 100%; height: 400px;"></div>
                @columnchart('PCD', 'project-cost-data')
            </div>
        </div>
        
        
    </div>
</div>
@endsection