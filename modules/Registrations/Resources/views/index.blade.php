@extends('layouts.dashboard')

@section('page_header')
	Matrículas
@stop

@section('page_content')

	@include('errors.alerts')

	<a href="{{ route('registrations.create') }}" class="btn btn-primary">Nova Matrícula</a>

	@include('registrations::partials.filter')

	@if(! $registrations->isEmpty())

		<table class="table table-bordered table-striped table-hover push-top-1">
			<thead>
			<tr>
				<th>Aluno</th>
				<th>Curso</th>
				<th>Status</th>
				<th>Pagamento</th>
				<th>Data de matrícula</th>
			</tr>
			</thead>
			<tbody>
				@foreach($registrations as $registration)
					<tr>
						<td>
							<a href="{{ route('registrations.show', $registration)  }}">
								{{$registration->student->name}}
							</a>
						</td>
						<td>{{$registration->course->name}}</td>
						<td>{{$registration->present()->enabled}}</td>
						<td>{{$registration->present()->isPaid}}</td>
						<td>{{$registration->present()->createdAt}}</td>
					</tr>
				@endforeach
			</tbody>
		</table>
		<div class="row">
			<div class="text-center">
				{!! $registrations->render() !!}
			</div>
		</div>
	@endif



@stop