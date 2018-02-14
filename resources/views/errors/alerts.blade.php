@if(Session::has('destroy'))
    <div class="alert alert-warning alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
        <strong>Sucesso!</strong> {!!Session::get('destroy')!!}
    </div>
@endif

@if(Session::has('success'))
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
        <strong>Sucesso!</strong> {!! Session::get('success') !!}
    </div>
@endif

@if(Session::has('warning'))
    <div class="alert alert-warning alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
        <strong>Atenção!</strong> {!! Session::get('warning') !!}
    </div>
@endif

@if(Session::has('error'))
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
        <strong>Atenção!</strong> {!!Session::get('error')!!}
    </div>
@endif

@if(Session::has('errors'))
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
        <strong>Atenção!</strong>
        <p>
            @foreach(Session::get('errors')->all() as $error)
            &bull; {!!$error!!} <br>
            @endforeach
        </p>
    </div>
@endif