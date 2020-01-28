<div class="form-group row">
    {!! Form::label('tracking_date', 'Tracking Date *', ['class' => 'col-md-2 col-form-label']) !!}
    <div class="col-md-4">
        {!! Form::date('tracking_date', $value = null, ['class' => 'form-control', 'placeholder' => 'Tracking Date', 'required' => true]) !!}
    </div>
</div>
<div class="form-group row">
    {!! Form::label('amount_spent', 'Amount Spent *', ['class' => 'col-md-2 col-form-label']) !!}
    <div class="col-md-4">
        {!! Form::number('amount_spent', $value = null, ['class' => 'form-control', 'placeholder' => 'Amount Spent (only after the last update)', 'required' => true, 'maxlength' => 20, 'step' => '0.01']) !!}
    </div>
</div>
<legend>Status of Components (last updates populated)</legend>
@foreach ($components as $component)
<div class="form-group row">
    {!! Form::label($component->id, $component->description.' *', ['class' => 'col-md-2 col-form-label']) !!}
    <div class="col-md-4">
        {!! Form::number($component->id, $value = $last_update[$component->id], ['class' => 'form-control', 'placeholder' => 'Percentage Completion', 'required' => true, 'min' => '0', 'max' => '100']) !!}
    </div>
</div>
@endforeach
<legend>Additional Information</legend>
<div class="form-group row">
    {!! Form::label('remarks', 'Remarks *', ['class' => 'col-md-2 col-form-label']) !!}
    <div class="col-md-4">
        {!! Form::textarea('remarks', $value = null, ['class' => 'form-control', 'placeholder' => 'Remarks', 'required' => true, 'maxlength' => 1000]) !!}
    </div>
</div>
<div class="form-group row">
    <div class="col-md-10 offset-md-2">
        {!! Form::submit($submit_text, ['class' => 'btn btn-primary']) !!}
    </div>
</div>