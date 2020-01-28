@extends('app', ['page_title' => 'Projects'])

@section('content')
<div class="row">
    <div class="col-12" style="margin-bottom: 20px;">
        <a class="btn btn-primary" href="{{ route('projects.create') }}"><i class="fas fa-plus"></i> New Project</a>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div id="accordion1">
            <div class="card">
                <div class="card-header bg-white text-primary" id="heading3" style="padding: 0;">
                    <h5 class="mb-0">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapse3" aria-expanded="true" aria-controls="collapse3">
                            <strong>Active</strong>
                        </button>
                    </h5>
                </div>
                <div id="collapse3" class="collapse show" aria-labelledby="heading3" data-parent="#accordion1">
                    <div class="card-body">
                        <table id="myTable1" class="display-1 table table-condensed table-hover table-striped">
                            <thead>
                                <tr class="text-center">
                                    <th><strong>NAME</strong></th>
                                    <th width="15%"><strong>VENDOR</strong></th>
                                    <th width="10%"><strong>START DATE</strong></th>
                                    <th width="10%"><strong>END DATE</strong></th>
                                    <th width="10%"><strong>STATUS</strong></th>
                                    <th width="10%"><strong>BUDGET (=N=)</strong></th>
                                    <th width="14%">&nbsp;</th>
                                    <th width="12%">&nbsp;</th>
                                    <th width="4%">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($projects as $project)
                                    @if ($project->status == "A")
                                <tr class="@if (date('Y-m-d') > $project->end_date) text-danger @endif">
                                    <td><a href="{{ route('projects.breakdown', $project->slug()) }}">{{ $project->name }}</a></td>
                                    <td>{{ $project->vendor->name }}</td>
                                    <td class="text-center">{{ $project->start_date }}</td>
                                    <td class="text-center">{{ $project->end_date }}</td>
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
                                    <td class="text-right">{{ number_format($project->budget, 2) }}</td>
                                    <td><a class="btn btn-primary btn-block btn-sm" href="{{ route('projects.components.index', [$project->slug()]) }}">Manage Components</a></td>
                                    <td><a class="btn btn-primary btn-block btn-sm" href="{{ route('projects.updates.index', [$project->slug()]) }}">Track Updates</a></td>
                                    <td class="text-center">
                                        <a title="Edit" href="{{ route('projects.edit', [$project->slug()]) }}"><i class="fas fa-edit"></i></a>
                                    </td>
                                </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div> 
            </div>
            <div class="card">
                <div class="card-header bg-white text-primary" id="heading4" style="padding: 0;">
                    <h5 class="mb-0">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapse4" aria-expanded="true" aria-controls="collapse4">
                            <strong>Others</strong>
                        </button>
                    </h5>
                </div>
                <div id="collapse4" class="collapse" aria-labelledby="heading4" data-parent="#accordion1">
                    <div class="card-body">
                        <table id="myTable2" class="display-1 table table-condensed table-hover table-striped">
                            <thead>
                                <tr class="text-center">
                                    <th><strong>NAME</strong></th>
                                    <th width="15%"><strong>VENDOR</strong></th>
                                    <th width="10%"><strong>START DATE</strong></th>
                                    <th width="10%"><strong>END DATE</strong></th>
                                    <th width="10%"><strong>STATUS</strong></th>
                                    <th width="10%"><strong>BUDGET (=N=)</strong></th>
                                    <th width="14%">&nbsp;</th>
                                    <th width="12%">&nbsp;</th>
                                    <th width="4%">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($projects as $project)
                                    @if (!($project->status == "A" || $project->status == "O"))
                                <tr>
                                    <td><a href="{{ route('projects.breakdown', $project->slug()) }}">{{ $project->name }}</a></td>
                                    <td>{{ $project->vendor->name }}</td>
                                    <td class="text-center">{{ $project->start_date }}</td>
                                    <td class="text-center">{{ $project->end_date }}</td>
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
                                    <td class="text-right">{{ number_format($project->budget, 2) }}</td>
                                    <td><a class="btn btn-primary btn-block btn-sm" href="{{ route('projects.components.index', [$project->slug()]) }}">Manage Components</a></td>
                                    <td><a class="btn btn-primary btn-block btn-sm" href="{{ route('projects.updates.index', [$project->slug()]) }}">Track Updates</a></td>
                                    <td class="text-center">
                                        <a title="Edit" href="{{ route('projects.edit', [$project->slug()]) }}"><i class="fas fa-edit"></i></a>
                                    </td>
                                </tr>
                                    @endif
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