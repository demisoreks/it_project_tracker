@extends('app', ['page_title' => 'Updates'])

@section('content')
<div class="row">
    <div class="col-12" style="margin-bottom: 20px;">
        Project: {{ $project->name }}
    </div>
</div>
<div class="row">
    <div class="col-12" style="margin-bottom: 20px;">
        <a class="btn btn-primary" href="{{ route('projects.updates.create', $project->slug()) }}"><i class="fas fa-plus"></i> New Update</a>
        <a class="btn btn-primary" href="{{ route('projects.index') }}"><i class="fas fa-arrow-left"></i> Back to Projects</a>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div id="accordion">
            <div class="card">
                <div class="card-header bg-white text-primary" id="heading1" style="padding: 0;">
                    <h5 class="mb-0">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapse1" aria-expanded="true" aria-controls="collapse1">
                            <strong>ALL UPDATES</strong>
                        </button>
                    </h5>
                </div>
                <div id="collapse1" class="collapse show" aria-labelledby="heading1" data-parent="#accordion">
                    <div class="card-body">
                        <table id="myTable3" class="display-1 table table-condensed table-hover table-striped">
                            <thead>
                                <tr class="text-center">
                                    <th width="10%"><strong>DATE</strong></th>
                                    <th><strong>COMPONENT UPDATES</strong></th>
                                    <th width="15%"><strong>AMOUNT SPENT</strong></th>
                                    <th width="30%"><strong>REMARKS</strong></th>
                                    <th width="15%"><strong>UPDATED BY</strong></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($updates as $update)
                                    
                                <tr>
                                    <td class="text-center">{{ $update->tracking_date }}</td>
                                    <td>
                                        <?php
                                        $component_updates = json_decode($update->component_updates, true);
                                        $comp_updates = [];
                                        $order = [];
                                        foreach ($component_updates as $key => $row) {
                                            $order[$key] = $row['order_no'];
                                        }
                                        array_multisort($order, SORT_ASC, $component_updates);
                                        $count = 0;
                                        foreach ($component_updates as $component_update) {
                                            $comp_updates[$count] = $component_update['description'].": ".$component_update['percentage']."%";
                                            $count ++;
                                        }
                                        $update_details = implode("<br />", $comp_updates);
                                        echo $update_details;
                                        ?>
                                    </td>
                                    <td class="text-right">{{ number_format($update->amount_spent, 2) }}</td>
                                    <td>{{ $update->remarks }}</td>
                                    <td>{{ $update->employee->username }}</td>
                                </tr>
                                    
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div> 
            </div>
        </div>
    </div>
</div>
@endsection