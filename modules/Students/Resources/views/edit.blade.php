@extends('layouts.dashboard')

@section('page_header')
	Edita aluno - {{ $student->name }}
@stop

@section('page_content')

	@include('errors.alerts')
	{!! Form::open(['route' => ['students.update', $student->id], 'id' => 'main-form', 'role' => 'form']) !!}
		<div class="row">
			<div class="form-group col-md-3">
				<label>Nome</label>
				{!! Form::text('name', $student->name, ['class' => 'form-control', 'autofocus']) !!}
			</div>
			<div class="form-group col-md-3">
				<label>CPF</label>
				{!! Form::text('cpf', $student->cpf, ['class' => 'form-control', 'data-mask-reference' => 'cpf']) !!}
			</div>
		</div>
		<div class="row">
			<div class="form-group col-md-2">
				<label>RG</label>
				{!! Form::text('rg', $student->rg, ['class' => 'form-control']) !!}
			</div>
			<div class="form-group col-md-2">
				<label>Data de nascimento</label>
				{!! Form::text('date_of_birth', $student->date_of_birth, ['class' => 'form-control', 'data-mask-reference' => 'date']) !!}
			</div>
			<div class="form-group col-md-2">
				<label>Telefone</label>
				{!! Form::text('phone', $student->phone, ['class' => 'form-control', 'data-mask-reference' => 'phone']) !!}
			</div>
		</div>
		<input type="submit" class="btn btn-success" value="Atualizar">
	{!! Form::close() !!}
@stop