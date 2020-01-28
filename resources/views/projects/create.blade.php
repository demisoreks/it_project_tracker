@extends('app', ['page_title' => 'Projects'])

@section('content')
<div class="row">
    <div class="col-12" style="margin-bottom: 20px;">
        <a class="btn btn-primary" href="{{ route('projects.index') }}"><i class="fas fa-list"></i> Existing Projects</a>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <legend>New Project</legend>
        {!! Form::model(new App\IptProject, ['route' => ['projects.store'], 'class' => 'form-group']) !!}
            @include('projects/form', ['submit_text' => 'Create Project'])
        {!! Form::close() !!}
    </div>
</div>
@endsection
