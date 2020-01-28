@extends('app', ['page_title' => 'Expenses', 'nest' => 2])

@section('content')
<div class="row">
    <div class="col-12" style="margin-bottom: 20px;">
        Project: {{ $project->name }}
    </div>
</div>
<div class="row">
    <div class="col-12" style="margin-bottom: 20px;">
        <a class="btn btn-primary" href="{{ route('projects.expenses.index', $project->slug()) }}"><i class="fas fa-list"></i> Existing Expenses</a>
        <a class="btn btn-primary" href="{{ route('projects.index') }}"><i class="fas fa-arrow-left"></i> Back to Projects</a>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <legend>Edit Expense</legend>
        {!! Form::model($expense, ['route' => ['projects.expenses.update', $project->slug(), $expense->slug()], 'class' => 'form-group']) !!}
        @method('PUT')
        @include('expenses/form', ['submit_text' => 'Update Expense'])
        {!! Form::close() !!}
    </div>
</div>
@endsection