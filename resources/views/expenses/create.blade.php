@extends('app', ['page_title' => 'Expenses', 'nest' => 1])

@section('content')
<div class="row">
    <div class="col-12" style="margin-bottom: 20px;">
        Project: {{ $project->name }}
    </div>
</div>
<div class="row">
    <div class="col-12" style="margin-bottom: 20px;">
        <a class="btn btn-primary" href="{{ route('projects.expenses.index', $project->slug()) }}"><i class="fas fa-list"></i> Existing Expenses</a>
        <a class="btn btn-primary" href="{{ route('projects.index') }}"><i class="fas fa-arrow-left"></i> Back to Expenses</a>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <legend>New Expense</legend>
        {!! Form::model(new App\IptExpense, ['route' => ['projects.expenses.store', $project->slug()], 'class' => 'form-group']) !!}
            @include('expenses/form', ['submit_text' => 'Create Expense'])
        {!! Form::close() !!}
    </div>
</div>
@endsection
