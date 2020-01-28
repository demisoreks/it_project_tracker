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
    <div class="col-lg-5">
        <div class="card" style="margin-bottom: 10px;">
            <div class="card-header bg-white">
                <strong>Project Status</strong>
            </div>
            <div class="card-body" style="height: 440px; overflow-y: scroll;">
                <!--<h6 class="text-center"><a href="#">Download Full Project Tracker</a></h6>-->
                <p>
                    <span class="text-center">
                        <span class="text-info">On track</span> | <span class="text-danger">Overdue</span>
                    </span>
                </p>
                @foreach (App\IptProject::whereIn('status', ['A'])->orderBy('end_date')->get() as $project)
                <?php
                $class = "";
                if (date('Y-m-d') > $project->end_date)
                    $class = "progress-bar bg-danger";
                else
                    $class = "progress-bar";
                
                $total_weight = 0;
                $total_score = 0;
                /*foreach (App\IptComponent::where('project_id', $project->id)->get() as $component) {
                    $total_weight += $component->weight;
                    $score = ($component->percentage/100)*$component->weight;
                    $total_score += $score;
                }*/
                $updates = App\IptUpdate::where('project_id', $project->id)->orderBy('tracking_date', 'desc');
                if ($updates->count() > 0) {
                    $update = $updates->first();
                    $component_updates = json_decode($update->component_updates, true);
                    foreach ($component_updates as $component_update) {
                        $weight = App\IptComponent::whereId($component_update['component_id'])->first()->weight;
                        $percentage = $component_update['percentage'];
                        $score = ($percentage/100)*$weight;
                        $total_score += $score;
                        $total_weight += $weight;
                    }
                }
                if ($total_weight == 0) {
                    $weighted_average = 0;
                } else {
                    $weighted_average = number_format(($total_score/$total_weight)*100);
                }
                ?>
                {{ $project->name }} - {{ $weighted_average }}%
                <div class="progress" style="margin: 0 0 10px 0;">
                    <div class="{{ $class }} progress-bar-striped progress-bar-animated" role="progressbar" style="width: {{ $weighted_average }}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="col-lg-7">
        <div class="card" style="margin-bottom: 20px;">
            <div class="card-header bg-white">
                <strong>On Track/Overdue</strong>
            </div>
            <div class="card-body">
                {!! $status->container() !!}
                {!! $status->script() !!}
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-white">
                <strong>Expense Summary</strong>
            </div>
            <div class="card-body">
                {!! $cost->container() !!}
                {!! $cost->script() !!}
            </div>
        </div>
    </div>
</div>
@endsection