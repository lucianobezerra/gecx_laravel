@extends('layouts.auth')
  @section('content')
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
           <span class="sr-only">Toggle navigation</span>
           <span class="icon-bar"></span>
           <span class="icon-bar"></span>
           <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="{{url()}}">Tutorial Laravel</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
           <li><a href="{{url()}}">Inicio</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            @if (Auth::check())
              <li><a href="{{url()}}">{{Auth::user()->name}}</a></li>
              <li><a href="{{url('auth/logout')}}">Salir</a></li>
            @else
              <li><a href="{{url('auth/login')}}">Iniciar sesión</a></li>
            @endif
          </ul>
        </div>
      </div>
    </nav>

  @endsection  