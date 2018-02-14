@extends('layouts.dashboard')

@section('page_header')
	Novo Aluno
@stop

@section('page_content')

	@include('errors.alerts')
	{!! Form::open(['route' => 'students.store', 'id' => 'main-form', 'role' => 'form']) !!}
		<div class="row">
			<div class="form-group col-md-3">
				<label>Nome</label>
				{!! Form::text('name', old('name'), ['class' => 'form-control', 'autofocus']) !!}
			</div>
			<div class="form-group col-md-3">
				<label>CPF</label>
				{!! Form::text('cpf', old('cpf'), ['class' => 'form-control']) !!}
			</div>
		</div>
		<div class="row">
			<div class="form-group col-md-2">
				<label>RG</label>
				{!! Form::text('rg', old('rg'), ['class' => 'form-control']) !!}
			</div>
			<div class="form-group col-md-2">
				<label>Data de nascimento</label>
				{!! Form::text('date_of_birth', old('date_of_birth'), ['class' => 'form-control']) !!}
			</div>
			<div class="form-group col-md-2">
				<label>Telefone</label>
				{!! Form::text('phone', old('phone'), ['class' => 'form-control']) !!}
			</div>
		</div>
		<input type="submit" class="btn btn-success" value="Cadastrar">
	{!! Form::close() !!}
@stop