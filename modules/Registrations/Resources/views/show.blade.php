@extends('layouts.dashboard')

@section('page_header')
    Matrícula - Status: {{$registration->present()->enabled}}
@stop

@section('page_content')

    @include('errors.alerts')

    @if($registration)
        @if($registration->enabled)
            <a href="{{route('registrations.cancel.index', $registration->id)}}" class="btn btn-danger">Cancelar Matrícula</a>
        @endif

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
                            <li><strong>Período</strong>: {{$registration->course->present()->period}}</li>
                            <li><strong>Duração</strong>: {{$registration->course->duration_months}}</li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-md-12">
                <h3>Informações de pagamento</h3>
                <div class="col-md-8">
                    @if($payments)
                        <table class="table table-bordered push-top-1">
                            <thead>
                                <tr>
                                    <th>Tipo de pagamento</th>
                                    <th>Valor a pagar</th>
                                    <th>Valor pago</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($payments as $payment)
                                    <tr>
                                        <td>{{$payment->present()->type}}</td>
                                        <td>{{$payment->present()->valueToPay}}</td>
                                        <td>{{$payment->present()->valuePaid}}</td>
                                        <td>{{$payment->present()->status}}</td>
                                        <td>
                                            @if($payment->status)
                                                <a href="{{route('registrations.payment.change', $payment->id)}}">Exibir melhor forma de troco</a>
                                            @else
                                                <a href="{{ route('registrations.payment.show', ['id' => $registration->id, 'paymentId' => $payment->id]) }}">Pagar</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    @else
        <p>
            A matrícula indicada não foi encontrada em nossa base de dados.
            Por favor, tente encontrar a matricula  que deseja na
            <a href="{{route('registrations.index')}}">listagem de matrículas</a>
        </p>
    @endif



@stop