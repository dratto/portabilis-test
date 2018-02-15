@extends('layouts.dashboard')

@section('page_header')
	Matrículas
@stop

@section('page_content')

	@include('errors.alerts')

	<a href="{{ route('registrations.create') }}" class="btn btn-primary">Nova Matrícula</a>

	@if(! $registrations->isEmpty())
		<table class="table table-bordered push-top-1">
			<thead>
			<tr>
				<th>Aluno</th>
				<th>Curso</th>
				<th>Status</th>
				<th>Pagamento</th>
				<th>Data de matrícula</th>
				<th></th>
				<th></th>
			</tr>
			</thead>
			<tbody>
				@foreach($registrations as $registration)
					<tr>
						<td>{{$registration->student->name}}</td>
						<td>{{$registration->course->name}}</td>
						<td>{{$registration->present()->enabled}}</td>
						<td>{{$registration->present()->isPaid}}</td>
						<td>{{$registration->present()->createdAt}}</td>
						<td>
							<a href="{{route('registrations.edit', $registration->id)}}">
								<i class="fa fa-edit"></i>
							</a>
						</td>
						<td>
							<a href="{{route('registrations.delete', $registration->id)}}" class="remove-action">
								<i class="fa fa-remove"></i>
							</a>
						</td>
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