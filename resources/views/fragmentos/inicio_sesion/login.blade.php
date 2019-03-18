@extends('plantilla_login')
@section('cuerpo')
<div class="container">
    <div class="card card-login mx-auto mt-5">
        <div class="card-header">Inicio de sesion</div>
        <div class="card-body">
            @if (Session::has('error'))
            <p>
                <span class="btn btn-danger btn-sm popover-error" data-rel="popover" data-placement="top" data-original-title="<i class='ace-icon fa fa-bolt red'></i> Top Danger" data-content="Hubo un error! {{Session::get('error')}}.">{{Session::get('error')}}</span>
            </p>
            @endif 
            @if (Session::has('success'))
            <p>
                <span class="btn btn-primary btn-sm popover-error" data-rel="popover" data-placement="top" data-original-title="<i class='ace-icon fa fa-bolt red'></i> Top Danger" data-content="Mensaje! {{Session::get('success')}}.">{{Session::get('success')}}</span>
            </p>
            @endif 
            <form method="POST" action="{{url('/inicior_sesion')}}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                <div class="form-group">
                    <div class="form-label-group">
                        <input type="email" id="inputEmail" name="correo" class="form-control" placeholder="Correo electronico"  autofocus="autofocus">
                        <label for="inputEmail">Correo electronico</label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-label-group">
                        <input type="password" id="inputPassword" name="clave" class="form-control" placeholder="Ingrese la clave" >
                        <label for="inputPassword">Clave</label>
                    </div>
                </div>
                <input class="btn btn-primary btn-block" type="submit" value="Iniciar sesion"/>

            </form>
            <div class="text-center">
                <a class="d-block small mt-3" href="{{ url('/registro')}}">Registrese!!</a>
                <a class="d-block small" href="forgot-password.html">Olvidastes tu clave?</a>
            </div>
        </div>
    </div>
</div>
@endsection