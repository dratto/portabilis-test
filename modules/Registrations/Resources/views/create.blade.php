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
			<div class="form-group col-md-4">
				<label>Cursos</label>
				<select name="course_id" class="form-control">
					@foreach($courses as $course)
						@if(old('course_id') == $course->id)
							<option selected="selected" value="{{$course->id}}">{{$course->name}} - {{$course->present()->period}}</option>
						@else
							<option value="{{$course->id}}">{{$course->name}} - {{$course->present()->period}}</option>
						@endif
					@endforeach
				</select>
			</div>
		</div>
		<input type="submit" class="btn btn-success" value="Realizar matrícula">
	{!! Form::close() !!}
@stop