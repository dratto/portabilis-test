@extends('layouts.dashboard')

@section('page_header')
    Cancelamento de matrícula
@stop

@section('page_content')

    @include('errors.alerts')

    <div class="row">
        <div class="col-md-12">
            <span><strong>Valor da multa</strong>: R$ {{number_format($tax, 2, ',', '.')}}</span>
        </div>
        <div class="col-md-4 push-top-1">
            <a href="{{route('registrations.cancel.store', $registration->id)}}" class="btn btn-danger">Cancelar e pagar multa</a>
        </div>
    </div>

@stop