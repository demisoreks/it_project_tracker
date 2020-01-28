@extends('app', ['page_title' => 'Vendors'])

@section('content')
<div class="row">
    <div class="col-12" style="margin-bottom: 20px;">
        <a class="btn btn-primary" href="{{ route('vendors.index') }}"><i class="fas fa-list"></i> Existing Vendors</a>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <legend>New Vendor</legend>
        {!! Form::model(new App\IptVendor, ['route' => ['vendors.store'], 'class' => 'form-group']) !!}
            @include('vendors/form', ['submit_text' => 'Create Vendor'])
        {!! Form::close() !!}
    </div>
</div>
@endsection
