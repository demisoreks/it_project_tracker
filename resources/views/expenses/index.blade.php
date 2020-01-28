@extends('app', ['page_title' => 'Expenses'])

@section('content')
<div class="row">
    <div class="col-12" style="margin-bottom: 20px;">
        Project: {{ $project->name }}
    </div>
</div>
<div class="row">
    <div class="col-12" style="margin-bottom: 20px;">
        <a class="btn btn-primary" href="{{ route('projects.expenses.create', $project->slug()) }}"><i class="fas fa-plus"></i> New Expense</a>
        <a class="btn btn-primary" href="{{ route('projects.index') }}"><i class="fas fa-arrow-left"></i> Back to Projects</a>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div id="accordion">
            <div class="card">
                <div class="card-header bg-secondary text-primary" id="heading1" style="padding: 0;">
                    <h5 class="mb-0">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapse1" aria-expanded="true" aria-controls="collapse1">
                            Active
                        </button>
                    </h5>
                </div>
                <div id="collapse1" class="collapse show" aria-labelledby="heading1" data-parent="#accordion">
                    <div class="card-body">
                        <table id="myTable1" class="display-1 table table-condensed table-hover table-striped">
                            <thead>
                                <tr class="text-center">
                                    <th><strong>DESCRIPTION</strong></th>
                                    <th width="15%"><strong>EXPENSE DATE</strong></th>
                                    <th width="10%"><strong>AMOUNT</strong></th>
                                    <th width="10%">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($expenses as $expense)
                                    
                                <tr>
                                    <td>{{ $expense->description }}</td>
                                    <td>{{ $expense->expense_date }}</td>
                                    <td class="text-right">{{ number_format($expense->amount, 2) }}</td>
                                    <td class="text-center">
                                        <a title="Edit" href="{{ route('projects.expenses.edit', [$project->slug(), $expense->slug()]) }}"><i class="fas fa-edit"></i></a>
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