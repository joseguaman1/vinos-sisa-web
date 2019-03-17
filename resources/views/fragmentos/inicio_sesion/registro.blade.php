@extends('plantilla_login')
@section('cuerpo')
<script src="{{ asset('js/validate.js') }}"></script>
<script>
jQuery(function ($) {

    $.validator.addMethod("sololetras", function (value, element) {
        return this.optional(element) || /^[a-z\-.,()'"\s]+$/i.test(value);
    }, "Solo se aceptan letras");

    $("#formulario").validate({
        rules: {
            cedula: {
                required: true,
                minlength: 10,
                maxlength: 10,
                digits: true
            },
            apellidos: {
                required: true,
                minlength: 3,
                sololetras: true
            },
            nombres: {
                required: true,
                minlength: 3,
                sololetras: true
            },
            email: {
                required: true,
                email: true
            },
            clave: {
                required: true,
                minlength: 5,
                maxlength: 7
            },
            repita_clave: {
                equalTo: "#inputPassword"
            }

        },
        messages: {
            cedula: {
                required: "Ingrese la cedula",
                minlength: "Your username must consist of at least 10 characters"
            },
            apellidos: {
                required: "Ingrese su apellido",
                minlength: "Se debe ingresar minimo 3 caracteres"
            },
            nombres: {
                required: "Ingrese su nombre",
                minlength: "Se debe ingresar minimo 3 caracteres"
            }
        },
        highlight: function (e) {
            $(e).closest('.form-group').removeClass('has-info').addClass('has-error');
        },

        success: function (e) {
            $(e).closest('.form-group').removeClass('has-error');//.addClass('has-info');
            $(e).remove();


        },

        errorPlacement: function (error, element) {

            if (element.is('input[type=checkbox]') || element.is('input[type=radio]')) {
                var controls = element.closest('div[class*="col-"]');
                if (controls.find(':checkbox,:radio').length > 1)
                    controls.append(error);
                else
                    error.insertAfter(element.nextAll('.lbl:eq(0)').eq(0));
            } else if (element.is('.select2')) {
                error.insertAfter(element.siblings('[class*="select2-container"]:eq(0)'));
            } else if (element.is('.chosen-select')) {
                error.insertAfter(element.siblings('[class*="chosen-container"]:eq(0)'));
            } else {

                error.insertAfter(element.parent());
            }
        }
    });


});
</script>
<style>

    #formulario label.error {
        margin-left: 10px;
        width: auto;
        display: inline;
    }

</style>


<div class="container">
    <div class="card card-register mx-auto mt-5">
        <div class="card-header">Registro de cuenta</div>
        <div class="card-body">
            <form id="formulario" method="POST" action="{{url('/administrar/persona/save')}}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                <div class="form-group">
                    <div class="form-label-group">
                        <input type="text" name="cedula" id="inputCedula" class="form-control" placeholder="Cedula" autofocus="autofocus">
                        <label for="inputCedula">Cedula</label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-row">

                        <div class="col-md-6">
                            <div class="form-label-group">
                                <input type="text" id="firstName" name="nombres" class="form-control" placeholder="Nombres">
                                <label for="firstName">Nombres</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-label-group">
                                <input type="text" id="lastName" name="apellidos" class="form-control" placeholder="Apellidos" >
                                <label for="lastName">Apellidos</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-label-group">
                        <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Correo electronico">
                        <label for="inputEmail">Correo electronico</label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-label-group">
                                <input type="password" id="inputPassword" name="clave" class="form-control" placeholder="Clave" >
                                <label for="inputPassword">Clave</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-label-group">
                                <input type="password" id="confirmPassword" name="repita_clave" class="form-control" placeholder="Confirmar clave">
                                <label for="confirmPassword">Confirmar clave</label>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="submit" class="btn btn-primary btn-block" value="REGISTRARSE"/>
            </form>
            <div class="text-center">
                <a class="d-block small mt-3" href="login.html">Login Page</a>
                <a class="d-block small" href="forgot-password.html">Forgot Password?</a>
            </div>
        </div>
    </div>
</div>

@endsection