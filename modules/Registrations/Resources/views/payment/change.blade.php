@extends('layouts.dashboard')

@section('page_header')
    Troco de matrícula
@stop

@section('page_content')

    @include('errors.alerts')

    <div class="row">
        <div class="col-md-12">
            <div class="col-md-4">
                <span><strong>Troco total</strong>: {{$change['value']}}</span>
            </div>
            <div class="col-md-8">
                Melhor forma de troco
                <ul>
                    @foreach($change['notes'] as $note => $quantity)
                        @if($quantity > 0)
                            <li>{{$quantity}} - {{$note}}</li>
                        @endif
                    @endforeach
                </ul>
            </div>

        </div>

    </div>




@stop