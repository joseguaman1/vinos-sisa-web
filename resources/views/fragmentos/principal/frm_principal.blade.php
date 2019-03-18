@extends('plantilla_principal')
@section('cuerpo')
<!-- Breadcrumbs-->
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{url('/')}}">Principal</a>
    </li>
    <li class="breadcrumb-item active">Bienvenida {{auth()->user()->persona->apellidos}}</li>
</ol>

<!-- Page Content -->
<h1>Listado de vinos</h1>
<hr>
<p>Se muestra los vinos que existen en catalogo.</p>
@endsection