@extends('plantilla_principal')
@section('cuerpo')

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
            <div class="card-header">
                <i class="fas fa-table"></i>
                Lista de marcas</div>
            <div class="card-body">
                <div class="table-responsive">
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
                                <td></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endsection
