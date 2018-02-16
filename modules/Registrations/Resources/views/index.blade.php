@extends('layouts.dashboard')

@section('page_header')
	Matrículas
@stop

@section('page_content')

	@include('errors.alerts')

	<a href="{{ route('registrations.create') }}" class="btn btn-primary">Nova Matrícula</a>

	@include('registrations::partials.filter')

	@if(! $registrations->isEmpty())

		<table class="table table-bordered push-top-1">
			<thead>
			<tr>
				<th>Aluno</th>
				<th>Curso</th>
				<th>Status</th>
				<th>Pagamento</th>
				<th>Data de matrícula</th>
				<th class="alert alert-danger"></th>
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
						<td class="alert alert-danger text-center">
							<a href="{{route('registrations.delete', $registration->id)}}" class="remove-action text-danger" title="Deletar">
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