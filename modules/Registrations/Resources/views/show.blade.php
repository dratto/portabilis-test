@extends('layouts.dashboard')

@section('page_header')
    Matrícula
@stop

@section('page_content')

    @include('errors.alerts')

    @if($registration)

        <a href="" class="btn btn-primary">Pagar</a>
        <a href="" class="btn btn-danger">Cancelar</a>

        <div class="row push-top-1">

            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">Informações do Aluno</div>
                    <div class="panel-body">
                        <ul>
                            <li><strong>Nome</strong>: {{$registration->student->name}}</li>
                            <li><strong>CPF</strong>: {{$registration->student->cpf}}</li>
                            <li><strong>Telefone</strong>: {{$registration->student->phone}}</li>
                            <li><strong>RG</strong>: {{$registration->student->rg}}</li>
                            <li><strong>Data de nascimento</strong>: {{$registration->student->date_of_birth}}</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">Informações do Curso</div>
                    <div class="panel-body">
                        <ul>
                            <li><strong>Nome</strong>: {{$registration->course->name}}</li>
                            <li><strong>Valor da mensalidade</strong>: {{$registration->course->monthly_fee}}</li>
                            <li><strong>Valor da matrícula</strong>: {{$registration->course->registration_fee}}</li>
                            <li><strong>Período</strong>: {{$registration->course->period}}</li>
                            <li><strong>Duração</strong>: {{$registration->course->duration_months}}</li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    @endif



@stop