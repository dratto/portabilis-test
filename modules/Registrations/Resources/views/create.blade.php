@extends('layouts.dashboard')

@section('page_header')
	Nova matrícula
@stop

@section('page_content')

	@include('errors.alerts')

	{!! Form::open(['route' => 'registrations.store', 'id' => 'main-form', 'role' => 'form']) !!}
		<div class="row">
			<div class="form-group col-md-4">
				<label>Alunos</label>
				{!! Form::select('student_id', $students, old('student_id'), ['class' => 'form-control']) !!}
			</div>
		</div>
		<div class="row">
			<div class="form-group col-md-2">
				<label>Cursos</label>
				{!! Form::select('course_id', $courses, old('course_id'), ['class' => 'form-control']) !!}
			</div>
		</div>
		<input type="submit" class="btn btn-success" value="Realizar matrícula">
	{!! Form::close() !!}
@stop