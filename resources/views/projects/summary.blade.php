@extends('app', ['page_title' => 'Summary'])

@section('content')
<div class="row">
    <div class="col-12 text-primary">
        Overdue projects have their end dates in <span class="text-danger">red</span>.<br />
        Expenses beyond budget are in <span class="text-danger">red</span>.<br />
    </div>
    <div class="col-12">
        <table class="table table-bordered table-hover table-striped">
            <tr class="text-center">
                <th>NAME</th>
                <th width="15%">VENDOR</th>
                <th width="7%">START DATE</th>
                <th width="7%">END DATE</th>
                <th>COMPONENTS (WEIGHT)</th>
                <th width="7%">OVERALL % COMPLETION</th>
                <th width="10%">BUDGET (=N=)</th>
                <th width="10%">AMOUNT SPENT (=N=)</th>
            </tr>
            @foreach (App\IptProject::where('status', 'A')->get() as $project)
            <tr>
                <td><a href="{{ route('projects.breakdown', $project->slug()) }}">{{ $project->name }}</a></td>
                <td>{{ $project->vendor->name }}</td>
                <td class="text-center">{{ $project->start_date }}</td>
                <td class="text-center @if (date('Y-m-d') > $project->end_date) text-danger @endif">{{ $project->end_date }}</td>
                <td>
                    <?php
                    $total_weight = 0;
                    $total_score = 0;
                    $amount_spent = 0;
                    foreach (App\IptComponent::where('project_id', $project->id)->orderBy('order_no')->get() as $component) {
                        echo $component->description." (".$component->weight."): ";
                        $total_weight += $component->weight;
                        $last_score = 0;
                        $updates = App\IptUpdate::where('project_id', $project->id)->orderBy('tracking_date', 'desc');
                        if ($updates->count() > 0) {
                            $last_update = $updates->first();
                            $component_updates = json_decode($last_update->component_updates, true);
                            foreach ($component_updates as $component_update) {
                                if ($component_update['component_id'] == $component->id) {
                                    $last_score = $component_update['percentage'];
                                    break;
                                }
                            }
                            $amount_spent = $updates->sum('amount_spent');
                        }
                        $score = ($last_score/100)*$component->weight;
                        $total_score += $score;
                        echo $last_score."%";
                        echo "<br />";
                        
                        if ($total_weight == 0) {
                            $weighted_average = 0;
                        } else {
                            $weighted_average = number_format(($total_score/$total_weight)*100);
                        }
                    }
                    ?>
                </td>
                <td class="text-center"><?php echo number_format($weighted_average) ?>%</td>
                <td class="text-right">{{ number_format($project->budget, 2) }}</td>
                <td class="text-right @if ($amount_spent > $project->budget) text-danger @endif">{{ number_format($amount_spent, 2) }}</td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection