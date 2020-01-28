@extends('app', ['page_title' => 'Components'])

@section('content')
<div class="row">
    <div class="col-12" style="margin-bottom: 20px;">
        Project: {{ $project->name }}
    </div>
</div>
<div class="row">
    <div class="col-12" style="margin-bottom: 20px;">
        <a class="btn btn-primary" href="{{ route('projects.components.create', $project->slug()) }}"><i class="fas fa-plus"></i> New Component</a>
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
                            <strong>Active</strong>
                        </button>
                    </h5>
                </div>
                <div id="collapse1" class="collapse show" aria-labelledby="heading1" data-parent="#accordion">
                    <div class="card-body">
                        <table id="myTable1" class="display-1 table table-condensed table-hover table-striped">
                            <thead>
                                <tr class="text-center">
                                    <th width="5%"><strong>ORDER NO.</strong></th>
                                    <th><strong>DESCRIPTION</strong></th>
                                    <th width="10%"><strong>START DATE</strong></th>
                                    <th width="10%"><strong>END DATE</strong></th>
                                    <th width="10%"><strong>WEIGHT</strong></th>
                                    <!--<th width="10%"><strong>PERCENTAGE</strong></th>-->
                                    <th width="10%">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($components as $component)
                                    
                                <tr class="@if (date('Y-m-d') > $component->end_date) text-danger @endif">
                                    <td class="text-right">{{ $component->order_no }}</td>
                                    <td>{{ $component->description }}</td>
                                    <td>{{ $component->start_date }}</td>
                                    <td>{{ $component->end_date }}</td>
                                    <td class="text-right">{{ $component->weight }}</td>
                                    <!--<td class="text-right"></td>-->
                                    <td class="text-center">
                                        <a title="Edit" href="{{ route('projects.components.edit', [$project->slug(), $component->slug()]) }}"><i class="fas fa-edit"></i></a>
                                    </td>
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