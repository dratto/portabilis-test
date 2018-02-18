@extends('layouts.dashboard')

@section('page_header')
    Cancelamento de matrícula
@stop

@section('page_content')

    @include('errors.alerts')

    <div class="row">
        {!! Form::open(['route' => ['registrations.cancel.store', $registration->id], 'id' => 'main-form']) !!}
            <div class="col-md-12">
                <input value="{{$tax}}" name="tax" type="hidden">
                <span><strong>Valor da multa</strong>: R$ {{number_format($tax, 2, ',', '.')}}</span>
            </div>
            <div class="col-md-4 push-top-1">
                <input value="Cancelar e pagar multa" type="submit" class="btn btn-danger">
            </div>
        {!! Form::close() !!}
    </div>

@stop