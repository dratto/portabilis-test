@extends('layouts.dashboard')

@section('page_header')
	Alunos
@stop

@section('page_content')

	@include('errors.alerts')

	<a href="{{ route('students.create') }}" class="btn btn-primary">Novo Aluno</a>

	@if(! $students->isEmpty())
		<table class="table table-bordered push-top-1">
			<thead>
			<tr>
				<th>Nome</th>
				<th>CPF</th>
				<th>Telefone</th>
				<th>Data de nascimento</th>
				<th>RG</th>
				<th></th>
				<th></th>
			</tr>
			</thead>
			<tbody>
				@foreach($students as $student)
					<tr>
						<td>{{$student->name}}</td>
						<td>{{$student->cpf}}</td>
						<td>{{$student->phone}}</td>
						<td>{{$student->date_of_birth}}</td>
						<td>{{$student->rg}}</td>
						<td>
							<a href="{{route('students.edit', $student->id)}}">
								<i class="fa fa-edit"></i>
							</a>
						</td>
						<td>
							<a href="{{route('students.delete', $student->id)}}" class="remove-action">
								<i class="fa fa-remove"></i>
							</a>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
		<div class="row">
			<div class="text-center">
				{!! $students->render() !!}
			</div>
		</div>
	@endif



@stop