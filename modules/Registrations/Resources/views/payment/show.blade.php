@extends('layouts.dashboard')

@section('page_header')
    Pagamento de Matrícula
@stop

@section('page_content')

    @include('errors.alerts')

    {!! Form::open(['route' => ['registrations.payment.do', $registrationId, $payment->id], 'id' => 'main-form']) !!}

    <div class="row">
        <div class="form-group col-md-2">
            <span><strong>Valor a pagar</strong>: {{$payment->present()->valueToPay}}</span>
        </div>
        @if($payment->value_paid != 0.00)
            <div class="form-group col-md-2">
                <span>{{$payment->present()->valuePaid}}</span>
            </div>
        @endif
    </div>
    <div class="row">
        <div class="form-group col-md-2">
            <label>Valor</label>
            {!! Form::text('value', old('value'), ['class' => 'form-control', 'data-mask-reference' => 'decimal']) !!}
        </div>
    </div>
    <input type="submit" class="btn btn-success" value="Pagar">
    {!! Form::close() !!}




@stop