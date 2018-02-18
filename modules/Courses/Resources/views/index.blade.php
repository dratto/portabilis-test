@extends('layouts.dashboard')

@section('page_header')
	Cursos
@stop

@section('page_content')

	@include('errors.alerts')

	<a href="{{ route('courses.create') }}" class="btn btn-primary">Novo Curso</a>

	@if(! $courses->isEmpty())
		<table class="table table-bordered table-striped table-hover push-top-1">
			<thead>
			<tr>
				<th>Nome</th>
				<th>Valor da mensalidade</th>
				<th>Valor da matrícula</th>
				<th>Período</th>
				<th>Meses de duração</th>
				<th></th>
				<th></th>
			</tr>
			</thead>
			<tbody>
				@foreach($courses as $course)
					<tr>
						<td>{{$course->name}}</td>
						<td>{{$course->present()->monthlyFee}}</td>
						<td>{{$course->present()->registrationFee}}</td>
						<td>{{$course->present()->period}}</td>
						<td>{{$course->duration_months}}</td>
						<td class="alert-warning text-center">
							<a href="{{route('courses.edit', $course->id)}}" class="text-warning">
								<i class="fa fa-edit"></i>
							</a>
						</td>
						<td class="alert-danger text-center">
							<a href="{{route('courses.delete', $course->id)}}" class="remove-action text-danger">
								<i class="fa fa-remove"></i>
							</a>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
		<div class="row">
			<div class="text-center">
				{!! $courses->render() !!}
			</div>
		</div>
	@endif



@stop