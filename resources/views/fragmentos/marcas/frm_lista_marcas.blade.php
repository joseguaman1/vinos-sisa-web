@extends('plantilla_principal')
@section('cuerpo')
<script src="{{ asset('js/validate.js') }}"></script>
<script>
jQuery(function ($) {

    $.validator.addMethod("sololetras", function (value, element) {
        return this.optional(element) || /^[a-z\-.,()'"\s]+$/i.test(value);
    }, "Solo se aceptan letras");

    $("#formulario").validate({
        rules: {
            nombre_marca: {
                required: true,
                minlength: 3,
                sololetras: true
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
<!-- Page level plugin JavaScript-->
<script src="{{ asset('vendor/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('vendor/datatables/dataTables.bootstrap4.js') }}"></script>    

<!-- Custom scripts for all p    ages-->
<script src="{{ asset('js/sb-admin.min.js') }}"></script>

<!-- Demo scripts for this page-->
<script>
// Call the dataTables jQuery plugin
$(document).ready(function () {
    $('#dataTable').DataTable();
});
</script>
<!-- Breadcrumbs-->
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{url('/')}}">Principal</a>
    </li>
    <li class="breadcrumb-item active">Administrar Marcas</li>

</ol>

<!-- Page Content -->
<div class="card mb-3">
    @if (Session::has('error'))
    <p>
        <span class="btn btn-danger btn-sm popover-error" data-rel="popover" data-placement="top" data-original-title="<i class='ace-icon fa fa-bolt red'></i> Top Danger" data-content="Hubo un error! {{Session::get('error')}}.">{{Session::get('error')}}</span>
    </p>
    @endif 
    @if (Session::has('ok'))
    <p>
        <span class="btn btn-primary btn-sm popover-error" data-rel="popover" data-placement="top" data-original-title="<i class='ace-icon fa fa-bolt red'></i> Top Danger" data-content="Mensaje! {{Session::get('ok')}}.">{{Session::get('ok')}}</span>
    </p>
    @endif 
    <div class="card-header">
        <i class="fas fa-table"></i>
        Lista de marcas</div>
    <div class="card-body">
        <div class="table-responsive">
            <div class="col-2" style="margin-bottom: 10px;">
                <a class="btn btn-primary" href="#" onclick="return limpiar()" data-toggle="modal" data-target="#nuevaMarca">Nuevo</a>
            </div>
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Nro</th><th>Marca</th><th>Estado</th><th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($lista as $item)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$item->nombre}}</td>
                        <td>
                            @if($item->estado == true)
                            Activo
                            @else
                            Desactivo
                            @endif
                        </td>
                        <td>
                            <a href="#" data-toggle="modal" data-target="#nuevaMarca" class="btn btn-primary" onclick="return cargarData('{{$item->external_id}}', '{{$item->nombre}}')">Modificar</a>
                            <a href="#" class="btn btn-danger">dar de baja</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Logout Modal-->
<div class="modal fade" id="nuevaMarca" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registrar Marca</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <script>
                    $(document).ready(function () {
                        $("#nombre_marca1").keyup(function () {
                            var external = $("#external").val();
                            if (external == '0') {
                                var url = "{{url('/administrar/marcas/validar')}}";
                                var dato = $("#nombre_marca1").val();
                                $.ajax({
                                    url: url,
                                    type: 'GET',
                                    dataType: 'json',
                                    data: 'dato=' + dato,
                                    success: function (data, textStatus, jqXHR) {
                                        console.log(data.existe);
                                        if (data.existe == '1') {
                                            $("#boton").attr("disabled", true);
                                        } else {
                                            $("#boton").attr("disabled", false);
                                        }
                                    }, error: function (jqXHR, textStatus, errorThrown) {

                                    }
                                });
                            }

                        });
                        
                    });
                    function cargarData(external, nombre) {
                           
                           $("#nombre_marca1").val(nombre);
                           $("#external").val(external);
                       }
                       function limpiar() {
                           $("#nombre_marca1").val('');
                           $("#external").val('0');
                       }
                </script>
                <form id="formulario" method="POST" action="{{url('/administrar/marcas') }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                    <input type="hidden" name="external" id="external" value="0"/>
                    <div class="form-group">
                        <div class="form-label-group">
                            <input type="text" id="nombre_marca1" name="nombre_marca" class="form-control" placeholder="Nombre de la marca"  >
                            <label for="inputEmail">Nombre de la marca</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">No</button>
                        <input type="submit" id="boton" value="Guardar" class="btn btn-primary"/>

                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

@endsection
