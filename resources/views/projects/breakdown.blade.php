@extends('app', ['page_title' => 'Breakdown'])

@section('content')
<div class="row">
    <div class="col-4">
        <legend>Project Details</legend>
        <table class="table table-striped table-bordered table-hover">
            <tr>
                <td width="35%"><strong>Name</strong></td>
                <td>{{ $project->name }}</td>
            </tr>
            <tr>
                <td><strong>Vendor</strong></td>
                <td>{{ $project->vendor->name }}</td>
            </tr>
            <tr>
                <td><strong>Start Date</strong></td>
                <td>{{ $project->start_date }}</td>
            </tr>
            <tr>
                <td><strong>End Date</strong></td>
                <td class="@if (date('Y-m-d') > $project->end_date && $project->status == 'A') text-danger @endif">{{ $project->end_date }}</td>
            </tr>
            <tr>
                <td><strong>Status</strong></td>
                <td>
                    @if ($project->status == "P")
                        Pending
                    @elseif ($project->status == "A")
                        Active
                    @elseif ($project->status == "C")
                        Completed
                    @elseif ($project->status == "S")
                        Suspended
                    @elseif ($project->status == "Z")
                        Canceled
                    @endif
                </td>
            </tr>
            <tr>
                <td><strong>Budget (=N=)</strong></td>
                <td>{{ number_format($project->budget, 2) }}</td>
            </tr>
            <tr>
                <td><strong>Amount Spent (=N=)</strong></td>
                <td class="@if (App\IptUpdate::where('project_id', $project->id)->sum('amount_spent') > $project->budget) text-danger @endif">{{ number_format(App\IptUpdate::where('project_id', $project->id)->sum('amount_spent'), 2) }}</td>
            </tr>
        </table>
        <div class="card">
            <div class="card-body text-center">
                <h1 class="display-4">{{ $weighted_average }}%</h1>
            </div>
        </div>
    </div>
    <div class="col-8">
        <legend>Project Updates</legend>
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
@endsection