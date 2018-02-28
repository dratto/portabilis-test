@extends('layouts.dashboard')

@section('page_header')
	Nova matrícula
@stop

@section('page_content')

	@include('errors.alerts')

	{!! Form::open(['route' => 'registrations.store', 'id' => 'main-form', 'role' => 'form']) !!}

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
			<div class="form-group col-md-4">
				<label>Ano</label>
				<input type="number" name="year" class="form-control">
			</div>
			<div class="form-group col-md-4">
				<input type="submit" class="btn btn-success push-top-1" value="Realizar matrícula">
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<table class="table table-bordered table-striped table-hover push-top-1">
					<thead>
					<tr>
						<th></th>
						<th>Nome</th>
						<th>CPF</th>
						<th>Telefone</th>
						<th>Data de nascimento</th>
						<th>RG</th>
					</tr>
					</thead>
					<tbody>
					@foreach($students as $student)
						<tr>
							<td class="alert-primary text-center">
								<input name="student_id" type="radio" value="{{$student->id}}">
							</td>
							<td>{{$student->name}}</td>
							<td>{{$student->cpf}}</td>
							<td>{{$student->phone}}</td>
							<td>{{$student->date_of_birth}}</td>
							<td>{{$student->rg}}</td>
						</tr>
					@endforeach
					</tbody>
				</table>
				<div class="row">
					<div class="text-center">
						{!! $students->render() !!}
					</div>
				</div>
			</div>
		</div>

	{!! Form::close() !!}
@stop