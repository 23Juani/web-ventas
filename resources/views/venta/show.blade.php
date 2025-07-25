  @extends('template')

  @section('title', 'Ver venta')

  @push('css')
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
      <style>
          @media (max-width:575px) {
              #hide-group {
                  display: none;
              }
          }

          @media (min-width:576px) {
              #icon-form {
                  display: none;
              }
          }
      </style>
      <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet"
          crossorigin="anonymous" />
  @endpush

  @section('content')
      <div class="container-fluid mt-5">
          <div id="Grupo1">
              <div class="card mb-4">
                  <div class="card-header d-flex align-items-center">
                      <div class="d-flex justify-content-center w-100">
                          <h1 class="text-primary">
                              <span class="me-3 p-2 mb-0 ">Datos generales de la venta</span>
                          </h1>
                      </div>
                  </div>
                  <div class="card-body">
                      <div class="sbp-preview">
                          <div class="sbp-preview-content">
                              <div class="row g-4">
                                  <!---Tipo comprobante--->
                                  <div class="col-sm-6 my-2">
                                      <div class="input-group" id="hide-group">
                                          <span class="input-group-text"><i class="fa-solid fa-file"></i></span>
                                          <input disabled type="text" class="form-control" value="Tipo de comprobante: ">
                                      </div>
                                  </div>
                                  <div class="col-sm-6 my-2">
                                      <div class="input-group">
                                          <span title="Tipo de comprobante" id="icon-form" class="input-group-text"><i
                                                  class="fa-solid fa-file"></i></span>
                                          <input disabled type="text" class="form-control"
                                              value="{{ $venta->comprobante->tipo_comprobante }}">
                                      </div>
                                  </div>
                                  <!---Numero comprobante--->
                                  <div class="col-sm-6 my-2">
                                      <div class="input-group" id="hide-group">
                                          <span class="input-group-text"><i class="fa-solid fa-hashtag"></i></span>
                                          <input disabled type="text" class="form-control"
                                              value="Número de comprobante: ">
                                      </div>
                                  </div>
                                  <div class="col-sm-6 my-2">
                                      <div class="input-group">
                                          <span title="Número de comprobante" id="icon-form" class="input-group-text"><i
                                                  class="fa-solid fa-hashtag"></i></span>
                                          <input disabled type="text" class="form-control"
                                              value="{{ $venta->numero_comprobante }}">
                                      </div>
                                  </div>
                                  <!---Tipo proveedor--->
                                  <div class="col-sm-6 my-2">
                                      <div class="input-group" id="hide-group">
                                          <span class="input-group-text"><i class="fa-solid fa-user-tie"></i></span>
                                          <input disabled type="text" class="form-control" value="Cliente:">
                                      </div>
                                  </div>
                                  <div class="col-sm-6 my-2">
                                      <div class="input-group">
                                          <span title="Proveedor" id="icon-form" class="input-group-text"><i
                                                  class="fa-solid fa-user-tie"></i></span>
                                          <input disabled type="text" class="form-control"
                                              value="{{ $venta->cliente->persona->razon_social }}">
                                      </div>
                                  </div>
                                  {{-- vendedor --}}
                                  <div class="col-sm-6 my-2">
                                      <div class="input-group" id="hide-group">
                                          <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                                          <input disabled type="text" class="form-control" value="Vendedor :">
                                      </div>
                                  </div>
                                  <div class="col-sm-6 my-2">
                                      <div class="input-group">
                                          <span title="Proveedor" id="icon-form" class="input-group-text"><i
                                                  class="fa-solid fa-user-tie"></i></span>
                                          <input disabled type="text" class="form-control"
                                              value="{{$venta->user->name}}">
                                      </div>
                                  </div>
                                  <!---Fecha--->
                                  <div class="col-sm-6 my-2">
                                      <div class="input-group" id="hide-group">
                                          <span class="input-group-text"><i class="fa-solid fa-calendar-days"></i></span>
                                          <input disabled type="text" class="form-control" value="Fecha: ">
                                      </div>
                                  </div>
                                  <div class="col-sm-6 my-2">
                                      <div class="input-group">
                                          <span title="Fecha" id="icon-form" class="input-group-text"><i
                                                  class="fa-solid fa-calendar-days"></i></span>
                                          <input disabled type="text" class="form-control"
                                              value="{{ \Carbon\Carbon::parse($venta->fecha_hora)->format('d-m-Y') }}">
                                      </div>
                                  </div>
                                  {{-- hora --}}
                                  <div class="col-sm-6 my-2">
                                      <div class="input-group" id="hide-group">
                                          <span class="input-group-text"><i class="fa-solid fa-clock"></i></span>
                                          <input disabled type="text" class="form-control" value="Hora: ">
                                      </div>
                                  </div>
                                  <div class="col-sm-6 my-2">
                                      <div class="input-group">
                                          <span title="Hora" id="icon-form" class="input-group-text"><i
                                                  class="fa-solid fa-clock"></i></span>
                                          <input disabled type="text" class="form-control"
                                              value="{{ \Carbon\Carbon::parse($venta->fecha_hora)->format('H:i') }}">
                                      </div>
                                  </div>
                                  {{-- impuesto --}}
                                  <div class="col-sm-6 my-2">
                                      <div class="input-group" id="hide-group">
                                          <span class="input-group-text"><i class="fa-solid fa-percent"></i></span>
                                          <input disabled type="text" class="form-control" value="Impuesto: ">
                                      </div>
                                  </div>
                                  <div class="col-sm-6 my-2">
                                      <div class="input-group">
                                          <span title="Impuesto" id="icon-form" class="input-group-text"><i
                                                  class="fa-solid fa-percent"></i></span>
                                          <input disabled type="text" id="input-impuesto" class="form-control"
                                              value="{{ $venta->impuesto }}">
                                      </div>
                                  </div>
                                  <div class="col-sm-12 my-2">
                                      <div class="card-header d-flex align-items-center">
                                          <div class="d-flex justify-content-center w-100">
                                              <span>
                                                  Tabla de detalle de la venta
                                              </span>
                                          </div>
                                      </div>
                                      <div class="card-body">
                                          <div class="datatable table-responsive">
                                              <table class="table table-bordered table-hover" id="dataTable"
                                                  width="100%" cellspacing="0">
                                                  <thead>
                                                      <tr>
                                                          <th>Producto</th>
                                                          <th>Cantidad</th>
                                                          <th>Precio de venta</th>
                                                          <th>Descuento</th>
                                                          <th>Subtotal</th>
                                                      </tr>
                                                  </thead>
                                                  <tbody>
                                                      @forelse ($venta->productos as $item)
                                                          <tr>
                                                              <td>
                                                                  {{ $item->nombre }}
                                                              </td>
                                                              <td>
                                                                  {{ $item->pivot->cantidad }}
                                                              </td>
                                                              <td>
                                                                  {{ $item->pivot->precio_venta }}
                                                              </td>
                                                              <td>
                                                                  {{ $item->pivot->descuento }}
                                                              </td>
                                                              <td class="td-subtotal">
                                                                  {{ $item->pivot->cantidad * $item->pivot->precio_venta - $item->pivot->descuento }}
                                                              </td>
                                                          </tr>
                                                      @empty
                                                          <tr>
                                                              <td colspan="5" class="text-center">No se encontraron
                                                                  registros</td>
                                                          </tr>
                                                      @endforelse
                                                  </tbody>
                                                  <tfoot>
                                                      <tr>
                                                          <th colspan="5"></th>
                                                      </tr>
                                                      <tr>
                                                          <th colspan="4">Sumas:</th>
                                                          <th id="th-suma"></th>
                                                      </tr>
                                                      <tr>
                                                          <th colspan="4">IGV:</th>
                                                          <th id="th-igv"></th>
                                                      </tr>
                                                      <tr>
                                                          <th colspan="4">Total:</th>
                                                          <th id="th-total"></th>
                                                      </tr>
                                                  </tfoot>
                                              </table>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <div class="col-md-12 my-2 d-flex justify-content-end">
                                  <div class="col-sm-3 my-2">
                                      <a href="{{ route('ventas.index') }}">
                                          <button type="button" class="btn btn-outline-secondary w-100">Volver</button>
                                      </a>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>


  @endsection

  @push('js')
      <script>
          //Variables
          let filasSubtotal = document.getElementsByClassName('td-subtotal');
          let cont = 0;
          let impuesto = $('#input-impuesto').val();

          $(document).ready(function() {
              calcularValores();
          });

          function calcularValores() {
              for (let i = 0; i < filasSubtotal.length; i++) {
                  cont += parseFloat(filasSubtotal[i].innerHTML);
              }

              $('#th-suma').html(cont);
              $('#th-igv').html(impuesto);
              $('#th-total').html(round(cont + parseFloat(impuesto)));
          }

          function round(num, decimales = 2) {
              var signo = (num >= 0 ? 1 : -1);
              num = num * signo;
              if (decimales === 0) //con 0 decimales
                  return signo * Math.round(num);
              // round(x * 10 ^ decimales)
              num = num.toString().split('e');
              num = Math.round(+(num[0] + 'e' + (num[1] ? (+num[1] + decimales) : decimales)));
              // x * 10 ^ (-decimales)
              num = num.toString().split('e');
              return signo * (num[0] + 'e' + (num[1] ? (+num[1] - decimales) : -decimales));
          }
          //Fuente: https://es.stackoverflow.com/questions/48958/redondear-a-dos-decimales-cuando-sea-necesario
      </script>
  @endpush
