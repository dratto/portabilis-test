@extends('layouts.plane')

@section('body')
 <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ url ('/') }}">
                    <img alt="Portabilis - Soluções para gestão pública"
                         title="Portabilis - Soluções para gestão pública"
                         class="logo img-fluid"
                         src="{{ url('/assets/img/logo.png') }}">
                </a>
            </div>
            <!-- /.navbar-header -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li {{ (Request::is('/') ? 'class="active"' : '') }}>
                            <a href="{{ url ('') }}"><i class="fa fa-home fa-fw"></i> Home</a>
                        </li>
                        <li {{ (Request::is('*alunos') ? 'class="active"' : '') }}>
                            <a href="{{ url ('alunos') }}"><i class="fa fa-graduation-cap fa-fw"></i> Alunos</a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{ route('students.create') }}">Cadastrar novo Aluno</a>
                                </li>
                                <li>
                                    <a href="{{ route('students.index') }}">Listagem de Alunos</a>
                                </li>
                            </ul>
                        </li>
                        <li {{ (Request::is('*cursos') ? 'class="active"' : '') }}>
                            <a><i class="fa fa-book fa-fw"></i> Cursos</a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{ route('courses.create') }}">Cadastrar novo curso</a>
                                </li>
                                <li>
                                    <a href="{{ route('courses.index') }}">Listagem de Cursos</a>
                                </li>
                            </ul>
                        </li>
                        <li {{ (Request::is('*matriculas') ? 'class="active"' : '') }}>
                            <a><i class="fa fa-folder fa-fw"></i> Matrículas</a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{ route('registrations.create') }}">Cadastrar nova matrícula</a>
                                </li>
                                <li>
                                    <a href="{{ route('registrations.index') }}">Listagem de Matrículas</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
			 <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">@yield('page_header')</h1>
                </div>
                <!-- /.col-lg-12 -->
           </div>
			<div class="row">  
				@yield('page_content')
            </div>
            <!-- /#page-wrapper -->
        </div>
    </div>
@stop

