@extends('app', ['page_title' => 'Components', 'nest' => 2])

@section('content')
<div class="row">
    <div class="col-12" style="margin-bottom: 20px;">
        Project: {{ $project->name }}
    </div>
</div>
<div class="row">
    <div class="col-12" style="margin-bottom: 20px;">
        <a class="btn btn-primary" href="{{ route('projects.components.index', $project->slug()) }}"><i class="fas fa-list"></i> Existing Components</a>
        <a class="btn btn-primary" href="{{ route('projects.index') }}"><i class="fas fa-arrow-left"></i> Back to Projects</a>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <legend>Edit Component</legend>
        {!! Form::model($component, ['route' => ['projects.components.update', $project->slug(), $component->slug()], 'class' => 'form-group']) !!}
        @method('PUT')
        @include('components/form1', ['submit_text' => 'Update Component'])
        {!! Form::close() !!}
    </div>
</div>
@endsection