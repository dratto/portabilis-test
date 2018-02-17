<div class="row">
    <div class="col-md-12">
        <h3>Filtros</h3>
        {!! Form::open(['route' => 'registrations.index', 'method' => 'GET']) !!}
        <div class="row">
            <div class="form-group col-md-2">
                <label for="student">Aluno</label>
                {!! Form::text('student', $student, ['class' => 'form-control', 'placeholder' => 'Nome do aluno']) !!}
            </div>
            <div class="form-group col-md-2">
                <label for="student">Curso</label>
                {!! Form::text('course', $course, ['class' => 'form-control', 'placeholder' => 'Nome do curso']) !!}
            </div>
            <div class="form-group col-md-2">
                <label>Status</label>
                {!! Form::select('status', [
                    1 => 'Ativa',
                    0 => 'Cancelada'
                ], $status, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group col-md-2">
                <label>Ano</label>
                {!! Form::number('year', $year, ['class' => 'form-control', 'placeholder' => 'Ano da matrícula']) !!}
            </div>
            <div class="form-group col-md-2">
                <label>Status de pagamento</label>
                {!! Form::select('is_paid', [
                    0 => 'Pagamento pendente',
                    1 => 'Pagmento quitado'
                ], $isPaid, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <input type="submit" value="Filtrar" class="btn btn-small btn-primary">
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>