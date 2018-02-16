@extends('layouts.dashboard')

@section('page_header')
	Novo Curso
@stop

@section('page_content')

	@include('errors.alerts')

	{!! Form::open(['route' => 'courses.store', 'id' => 'main-form', 'role' => 'form']) !!}
		<div class="row">
			<div class="form-group col-md-2">
				<label>Nome</label>
				{!! Form::text('name', old('name'), ['class' => 'form-control', 'autofocus']) !!}
			</div>
			<div class="form-group col-md-2">
				<label>Valor da mensalidade</label>
				{!! Form::text('monthly_fee', old('monthly_fee'), ['class' => 'form-control', 'data-mask-reference' => 'decimal']) !!}
			</div>

			<div class="form-group col-md-2">
				<label>Valor da matrícula</label>
				{!! Form::text('registration_fee', old('registration_fee'), ['class' => 'form-control', 'data-mask-reference' => 'decimal']) !!}
			</div>
		</div>
		<div class="row">
			<div class="form-group col-md-2">
				<label>Período</label>
				{!! Form::select('period', [
					'morning'   => 'Matutino',
					'afternoon' => 'Vespertino',
					'night'     => 'Noturno'
				], old('period'), ['class' => 'form-control']) !!}
			</div>
			<div class="form-group col-md-2">
				<label>Meses de duração</label>
				{!! Form::number('duration_months', old('duration_months'), ['class' => 'form-control', 'min' => '1']) !!}
			</div>
		</div>
		<input type="submit" class="btn btn-success" value="Cadastrar">
	{!! Form::close() !!}
@stop