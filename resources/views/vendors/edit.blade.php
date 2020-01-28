@extends('app', ['page_title' => 'Vendors'])

@section('content')
<div class="row">
    <div class="col-12" style="margin-bottom: 20px;">
        <a class="btn btn-primary" href="{{ route('vendors.index') }}"><i class="fas fa-list"></i> Existing Vendors</a>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <legend>Edit Vendor</legend>
        {!! Form::model($vendor, ['route' => ['vendors.update', $vendor->slug()], 'class' => 'form-group']) !!}
        @method('PUT')
        @include('vendors/form', ['submit_text' => 'Update Vendor'])
        {!! Form::close() !!}
    </div>
</div>
@endsection