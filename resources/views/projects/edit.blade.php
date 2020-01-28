@extends('app', ['page_title' => 'Projects'])

@section('content')
<div class="row">
    <div class="col-12" style="margin-bottom: 20px;">
        <a class="btn btn-primary" href="{{ route('projects.index') }}"><i class="fas fa-list"></i> Existing Projects</a>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <legend>Edit Project</legend>
        {!! Form::model($project, ['route' => ['projects.update', $project->slug()], 'class' => 'form-group']) !!}
        @method('PUT')
        @include('projects/form1', ['submit_text' => 'Update Project'])
        {!! Form::close() !!}
    </div>
</div>
@endsection