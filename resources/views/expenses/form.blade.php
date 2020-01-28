<div class="form-group row">
    {!! Form::label('description', 'Description *', ['class' => 'col-md-2 col-form-label']) !!}
    <div class="col-md-4">
        {!! Form::text('description', $value = null, ['class' => 'form-control', 'placeholder' => 'Description', 'required' => true, 'maxlength' => 100]) !!}
    </div>
</div>
<div class="form-group row">
    {!! Form::label('expense_date', 'Expense Date *', ['class' => 'col-md-2 col-form-label']) !!}
    <div class="col-md-4">
        {!! Form::date('expense_date', $value = null, ['class' => 'form-control', 'placeholder' => 'Expense Date', 'required' => true]) !!}
    </div>
</div>
<div class="form-group row">
    {!! Form::label('amount', 'Budget *', ['class' => 'col-md-2 col-form-label']) !!}
    <div class="col-md-4">
        {!! Form::number('amount', $value = null, ['class' => 'form-control', 'placeholder' => 'Amount', 'required' => true, 'maxlength' => 20, 'step' => '0.01']) !!}
    </div>
</div>
<div class="form-group row">
    <div class="col-md-10 offset-md-2">
        {!! Form::submit($submit_text, ['class' => 'btn btn-primary']) !!}
    </div>
</div>