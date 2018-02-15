@extends('layouts.dashboard')

@section('page_header')
	Edita curso - {{ $course->name }}
@stop

@section('page_content')

	@include('errors.alerts')

	{!! Form::open(['route' => ['courses.update', $course->id], 'id' => 'main-form', 'role' => 'form']) !!}
		<div class="row">
			<div class="form-group col-md-2">
				<label>Nome</label>
				{!! Form::text('name', $course->name, ['class' => 'form-control', 'autofocus']) !!}
			</div>
			<div class="form-group col-md-2">
				<label>Valor da mensalidade</label>
				{!! Form::text('monthly_fee', $course->monthly_fee, ['class' => 'form-control']) !!}
			</div>

			<div class="form-group col-md-2">
				<label>Valor da matrícula</label>
				{!! Form::text('registration_fee', $course->registration_fee, ['class' => 'form-control']) !!}
			</div>
		</div>
		<div class="row">
			<div class="form-group col-md-2">
				<label>Período</label>
				{!! Form::select('period', [
					'morning'   => 'Matutino',
					'afternoon' => 'Vespertino',
					'night'     => 'Noturno'
				], $course->period, ['class' => 'form-control']) !!}
			</div>
			<div class="form-group col-md-2">
				<label>Meses de duração</label>
				{!! Form::number('duration_months', $course->duration_months, ['class' => 'form-control', 'min' => '1']) !!}
			</div>
		</div>
		<input type="submit" class="btn btn-success" value="Atualizar">
	{!! Form::close() !!}
@stop