<div class="form-group row">
    {!! Form::label('name', 'Name *', ['class' => 'col-md-2 col-form-label']) !!}
    <div class="col-md-4">
        {!! Form::text('name', $value = null, ['class' => 'form-control', 'placeholder' => 'Name', 'required' => true, 'maxlength' => 100]) !!}
    </div>
</div>
<div class="form-group row">
    {!! Form::label('description', 'Description *', ['class' => 'col-md-2 col-form-label']) !!}
    <div class="col-md-4">
        {!! Form::textarea('description', $value = null, ['class' => 'form-control', 'placeholder' => 'Description', 'required' => true, 'maxlength' => 1000]) !!}
    </div>
</div>
<div class="form-group row">
    {!! Form::label('vendor_id', 'Vendor *', ['class' => 'col-md-2 col-form-label']) !!}
    <div class="col-md-4">
        {!! Form::select('vendor_id', App\IptVendor::where('active', true)->orderBy('name')->pluck('name', 'id'), $value = null, ['class' => 'form-control', 'placeholder' => '- Select Option -', 'required' => true]) !!}
    </div>
</div>
<div class="form-group row">
    {!! Form::label('start_date', 'Start Date *', ['class' => 'col-md-2 col-form-label']) !!}
    <div class="col-md-4">
        {!! Form::date('start_date', $value = null, ['class' => 'form-control', 'placeholder' => 'Start Date', 'required' => true]) !!}
    </div>
</div>
<div class="form-group row">
    {!! Form::label('end_date', 'End Date *', ['class' => 'col-md-2 col-form-label']) !!}
    <div class="col-md-4">
        {!! Form::date('end_date', $value = null, ['class' => 'form-control', 'placeholder' => 'End Date', 'required' => true]) !!}
    </div>
</div>
<div class="form-group row">
    {!! Form::label('status', 'Status *', ['class' => 'col-md-2 col-form-label']) !!}
    <div class="col-md-4">
        {!! Form::select('status', ['P' => 'Pending', 'A' => 'Active', 'C' => 'Completed', 'S' => 'Suspended', 'Z' => 'Canceled'], $value = null, ['class' => 'form-control', 'placeholder' => '- Select Option -', 'required' => true]) !!}
    </div>
</div>
<div class="form-group row">
    {!! Form::label('budget', 'Budget *', ['class' => 'col-md-2 col-form-label']) !!}
    <div class="col-md-4">
        {!! Form::number('budget', $value = null, ['class' => 'form-control', 'placeholder' => 'Budget', 'required' => true, 'maxlength' => 20, 'step' => '0.01']) !!}
    </div>
</div>
<div class="form-group row">
    <div class="col-md-10 offset-md-2">
        {!! Form::submit($submit_text, ['class' => 'btn btn-primary']) !!}
    </div>
</div>