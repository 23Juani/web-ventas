  @extends('template')

  @section('title', 'Realizar venta')

  @push('css')
      {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> --}}
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
      <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet"
          crossorigin="anonymous" />
      {{-- import jquery --}}
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  @endpush

  @section('content')

      {{-- este fracmento de codigo es para mostrar un mensaje de exito cuando se crea, edita o elimina una categoria --}}
      @if (session('success'))
          <script>
              let message = "{{ session('success') }}";
              const Toast = Swal.mixin({
                  toast: true,
                  position: "top-end",
                  showConfirmButton: false,
                  timer: 3000,
                  timerProgressBar: true,
                  didOpen: (toast) => {
                      toast.onmouseenter = Swal.stopTimer;
                      toast.onmouseleave = Swal.resumeTimer;
                  }
              });
              Toast.fire({
                  icon: "success",
                  title: message
              });
          </script>
      @endif

      <div class="page-header pb-10 page-header-dark bg-gradient-primary-to-secondary">
          <div class="container-fluid">
              <div class="page-header-content">
                  <h1 class="page-header-title">
                      <div class="page-header-icon"><i data-feather="shopping-cart"></i></div>
                      <span>Crear nueva venta</span>
                  </h1>
                  <div class="page-header-subtitle">Ventas</div>
              </div>
          </div>
      </div>

      <form action="{{ route('ventas.store') }}" method="post">
          @csrf
          <div class="container-fluid mt-n10">
              <div class="row gy-4">
                  {{-- Compra producto  --}}
                  <div class="col-xl-8">
                      <div class="card mb-4">
                          {{-- encabezado de la contenedor --}}
                          <div class="card-header d-flex align-items-center">
                              <div class="d-flex justify-content-center w-100">
                                  <h1 class="text-primary">
                                      <span class="me-3 p-2 mb-0 ">Detalles de la venta</span>
                                  </h1>
                              </div>
                          </div>

                          <div class="card-body">
                              <div class="sbp-preview">
                                  <div class="sbp-preview-content">
                                      <div class="row g-4">
                                          <!---Campo producto---->
                                          <div class="col-md-12 mb-2">
                                              <label for="producto_id" class="form-label">Busqueda de producto:</label>
                                              <select class="form-control selectpicker show-tick" name="producto_id"
                                                  id="producto_id" data-live-search="true" data-size="4">
                                                  <option value="" selected disabled>Busca un producto aqui
                                                  </option>
                                                  @foreach ($productos as $item)
                                                      <option
                                                          value="{{ $item->id }}-{{ $item->stock }}-{{ $item->precio_venta }}">
                                                          {{ $item->codigo . ' | ' . $item->nombre }}</option>
                                                  @endforeach
                                              </select>
                                          </div>
                                          <!-----Stock--->
                                          <div class="col-md-12 my-2 d-flex justify-content-end">
                                              <div class="row align-items-center" style="width: 250px;">
                                                  <label for="stock" class="col-form-label col-4">Stock:</label>
                                                  <div class="col-8">
                                                      <input disabled id="stock" type="text" class="form-control">
                                                  </div>
                                              </div>
                                          </div>

                                          <!-----Precio de venta---->
                                          <div class="col-md-4 mb-2" id="box-razon-social">
                                              <label for="precio_venta" class="form-label">Precio de venta:</label>
                                              <input disabled type="number" name="precio_venta" id="precio_venta"
                                                  class="form-control" step="0.1">
                                          </div>

                                          <!------cantidad--->
                                          <div class="col-md-4 mb-2">
                                              <label for="cantidad" class="form-label">Cantidad:</label>
                                              <input type="number" name="cantidad" id="cantidad" class="form-control"
                                                  min="0">
                                          </div>
                                          <!------Descuento---->
                                          <div class="col-md-4 mb-2">
                                              <label for="descuento" class="form-label">Descuento:</label>
                                              <input type="number" name="descuento" id="descuento" class="form-control"
                                                  min="0">
                                          </div>

                                          <div class="col-md-12 mb-2 mt-2 d-flex justify-content-center">
                                              <button id="btn_agregar" type="button"
                                                  class="btn btn-facebook w-100">Agregar</button>
                                          </div>
                                          {{-- tabla de registro de productos --}}
                                          <div class="col-md-12 mb-2">
                                              <div class="datatable table-responsive">
                                                  <table class="table table-bordered table-hover" id="tabla_detalle"
                                                      width="100%" cellspacing="0">
                                                      <thead>
                                                          <tr>
                                                              <th>#</th>
                                                              <th>Producto</th>
                                                              <th>Cantidad</th>
                                                              <th>Precio venta</th>
                                                              <th>Descuento</th>
                                                              <th>Subtotal</th>
                                                              <th>Acciones</th>
                                                          </tr>
                                                      </thead>
                                                      <tbody id="tabla_detalle_body">
                                                      </tbody>
                                                      {{-- <tbody>
                                                          <tr>
                                                              <th></th>
                                                              <td></td>
                                                              <td></td>
                                                              <td></td>
                                                              <td></td>
                                                              <td></td>
                                                              <td></td>
                                                          </tr>
                                                      </tbody> --}}
                                                      <tfoot>
                                                          <tr>
                                                              <th></th>
                                                              <th colspan="4">Sumas</th>
                                                              <th colspan="2"><span id="sumas">0</span></th>
                                                          </tr>
                                                          <tr>
                                                              <th></th>
                                                              <th colspan="4">Impuesto %</th>
                                                              <th colspan="2"><span id="igv">0</span></th>
                                                          </tr>
                                                          <tr>
                                                              <th></th>
                                                              <th colspan="4">Total</th>
                                                              <th colspan="2"> <input type="hidden" name="total"
                                                                      value="0" id="inputTotal"> <span
                                                                      id="total">0</span></th>
                                                          </tr>
                                                      </tfoot>
                                                  </table>
                                              </div>
                                          </div>

                                      </div>
                                  </div>
                                  <div id="container_cancelar" class="sbp-preview-text">
                                      <div class="d-flex justify-content-end">
                                          <button id="cancelar" type="button" class="btn btn-danger"
                                              data-bs-toggle="modal" data-bs-target="#exampleModal">Cancelar</button>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>

                  {{-- Datos generales --}}
                  <div class="col-xl-4">
                      <div id="default">
                          <div class="card mb-4">
                              {{-- encabezado de la tarjeta --}}
                              <div class="card-header d-flex align-items-center">
                                  <div class="d-flex justify-content-center w-100">
                                      <h1 class="text-primary">
                                          <span class="me-3 p-2 mb-0 ">Datos generales</span>
                                      </h1>
                                  </div>
                              </div>
                              <div class="card-body">
                                  <div class="sbp-preview">
                                      <div class="sbp-preview-content">
                                          <div class="row g-4">
                                              {{-- Cliente --}}
                                              <div class="col-md-12 mb-2">
                                                  <label for="cliente_id" class="form-label">Cliente:</label>
                                                  <select class="form-control selectpicker show-tick" name="cliente_id"
                                                      id="cliente_id" data-live-search="true" data-size="3">
                                                      <option value="" selected disabled>Seleccione un cliente
                                                      </option>
                                                      @foreach ($clientes as $item)
                                                          <option value="{{ $item->id }}" {{-- {{ old('cliente_id') == $item->id ? 'selected' : '' }} --}}>
                                                              {{ $item->persona->razon_social }}</option>
                                                      @endforeach
                                                  </select>
                                                  @error('cliente_id')
                                                      <small class="text-danger">{{ '*' . $message }}</small>
                                                  @enderror
                                              </div>
                                              {{-- tipo de comprobante --}}
                                              <div class="col-md-12 mb-2">
                                                  <label for="comprobante_id" class="form-label">Comprobante:</label>
                                                  <select class="form-control selectpicker show-tick"
                                                      name="comprobante_id" id="comprobante_id" data-live-search="true">
                                                      <option value="" selected disabled>Seleccione un comprobante
                                                      </option>
                                                      @foreach ($comprobantes as $item)
                                                          <option value="{{ $item->id }}" {{-- {{ old('comprobante_id') == $item->id ? 'selected' : '' }} --}}>
                                                              {{ $item->tipo_comprobante }}</option>
                                                      @endforeach
                                                  </select>
                                                  @error('comprobante_id')
                                                      <small class="text-danger">{{ '*' . $message }}</small>
                                                  @enderror
                                              </div>
                                              {{-- numero de comprobante  --}}
                                              <div class="col-md-12 mb-2">
                                                  <label for="numero_comprobante" class="form-label">Numero de
                                                      comprobante:</label>
                                                  <input type="text" name="numero_comprobante" id="numero_comprobante"
                                                      class="form-control">
                                              </div>
                                              @error('numero_comprobante')
                                                  <small class="text-danger">{{ '*' . $message }}</small>
                                              @enderror
                                              {{-- impuestos --}}
                                              <div class="col-md-6 mb-2">
                                                  <label class="form-label">Impuesto:</label>
                                                  <input readonly type="text" name="impuesto" id="impuesto"
                                                      class="form-control">
                                              </div>
                                              @error('impuesto')
                                                  <small class="text-danger">{{ '*' . $message }}</small>
                                              @enderror
                                              {{-- fecha de compra --}}
                                              <div class="col-md-6 mb-2">
                                                  <label class="form-label">Fecha:</label>
                                                  <input readonly type="date" name="fecha" id="fecha"
                                                      class="form-control" value="{{ date('Y-m-d') }}">
                                                  <?php
                                                  use Carbon\Carbon;
                                                  $fecha_hora = Carbon::now()->toDateTimeString();
                                                  ?>
                                                  <input type="hidden" name="fecha_hora" value="{{ $fecha_hora }}">
                                              </div>
                                              {{-- user autenticado  --}}
                                              <input type="hidden" name="user_id" value="1 {{-- {{ auth()->user()->id }} --}}">
                                              {{-- boton para resgistrar la compra --}}
                                              <div class="col-md-12 mb-2 mt-2 d-flex justify-content-center">
                                                  <button type="submit" id="guardar"
                                                      class="btn btn-facebook w-100">Realizar Venta</button>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          {{-- Modal de confirmacion para cancelar la compra --}}
          <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
              aria-hidden="true">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h1 class="modal-title fs-5" id="exampleModalLabel">Advertencia</h1>
                          {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
                      </div>
                      <div class="modal-body">
                          ¿Seguro que quieres cancelar la venta?
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cerrar</button>
                          <button id="btnCancelarVenta" type="button" class="btn btn-danger"
                              data-bs-dismiss="modal">Confirmar</button>
                      </div>
                  </div>
              </div>
          </div>
      </form>

  @endsection

  @push('js')
      <script>
          $(document).ready(function() {

              $('#producto_id').change(mostrarValores);
              $('#btn_agregar').click(function() {
                  agregarProducto();
              });
              $('#btnCancelarVenta').click(function() {
                  cancelarVenta();
              });
              disableButtons();

              $('#impuesto').val(impuesto + '%');
          });

          //Variables
          let cont = 0;
          let subtotal = [];
          let sumas = 0;
          let igv = 0;
          let total = 0;

          //Constantes
          const impuesto = 0;

          function mostrarValores() {
              let dataProducto = document.getElementById('producto_id').value.split('-');
              $('#stock').val(dataProducto[1]);
              $('#precio_venta').val(dataProducto[2]);
          }

          function agregarProducto() {
              let dataProducto = document.getElementById('producto_id').value.split('-');
              //Obtener valores de los campos
              let idProducto = dataProducto[0];
              let nameProducto = $('#producto_id option:selected').text();
              let cantidad = $('#cantidad').val();
              let precioVenta = $('#precio_venta').val();
              let descuento = $('#descuento').val();
              let stock = $('#stock').val();

              if (descuento == '') {
                  descuento = 0;
              }

              //Validaciones 
              //1.Para que los campos no esten vacíos
              if (idProducto != '' && cantidad != '') {

                  //2. Para que los valores ingresados sean los correctos
                  if (parseInt(cantidad) > 0 && (cantidad % 1 == 0) && parseFloat(descuento) >= 0) {

                      //3. Para que la cantidad no supere el stock
                      if (parseInt(cantidad) <= parseInt(stock)) {
                          //Calcular valores
                          subtotal[cont] = round(cantidad * precioVenta - descuento);
                          sumas += subtotal[cont];
                          igv = round(sumas / 100 * impuesto);
                          total = round(sumas + igv);

                          //Crear la fila
                          let fila = '<tr id="fila' + cont + '">' +
                              '<th>' + (cont + 1) + '</th>' +
                              '<td><input type="hidden" name="arrayidproducto[]" value="' + idProducto + '">' + nameProducto +
                              '</td>' +
                              '<td><input type="hidden" name="arraycantidad[]" value="' + cantidad + '">' + cantidad +
                              '</td>' +
                              '<td><input type="hidden" name="arrayprecioventa[]" value="' + precioVenta + '">' +
                              precioVenta + '</td>' +
                              '<td><input type="hidden" name="arraydescuento[]" value="' + descuento + '">' + descuento +
                              '</td>' +
                              '<td>' + subtotal[cont] + '</td>' +
                              '<td><button class="btn btn-danger" type="button" onClick="eliminarProducto(' + cont +
                              ')"><i class="fa-solid fa-trash"></i></button></td>' +
                              '</tr>';

                          //Acciones después de añadir la fila
                          $('#tabla_detalle').append(fila);
                          limpiarCampos();
                          cont++;
                          disableButtons();

                          //Mostrar los campos calculados
                          $('#sumas').html(sumas);
                          $('#igv').html(igv);
                          $('#total').html(total);
                          $('#impuesto').val(igv);
                          $('#inputTotal').val(total);
                      } else {
                          showModal('Cantidad incorrecta');
                      }

                  } else {
                      showModal('Valores incorrectos');
                  }

              } else {
                  showModal('Le faltan campos por llenar');
              }

          }

          function eliminarProducto(indice) {
              //Calcular valores
              sumas -= round(subtotal[indice]);
              igv = round(sumas / 100 * impuesto);
              total = round(sumas + igv);

              //Mostrar los campos calculados
              $('#sumas').html(sumas);
              $('#igv').html(igv);
              $('#total').html(total);
              $('#impuesto').val(igv);
              $('#InputTotal').val(total);

              //Eliminar el fila de la tabla
              $('#fila' + indice).remove();

              disableButtons();
          }

          function cancelarVenta() {
              //Elimar el tbody de la tabla
              $('#tabla_detalle tbody').empty();

              //Añadir una nueva fila a la tabla
            //   let fila = '<tr>' +
            //       '<th></th>' +
            //       '<td></td>' +
            //       '<td></td>' +
            //       '<td></td>' +
            //       '<td></td>' +
            //       '<td></td>' +
            //       '<td></td>' +
            //       '</tr>';
            //   $('#tabla_detalle').append(fila);

              //Reiniciar valores de las variables
              cont = 0;
              subtotal = [];
              sumas = 0;
              igv = 0;
              total = 0;

              //Mostrar los campos calculados
              $('#sumas').html(sumas);
              $('#igv').html(igv);
              $('#total').html(total);
              $('#impuesto').val(impuesto + '%');
              $('#inputTotal').val(total);

              limpiarCampos();
              disableButtons();
          }

          function disableButtons() {
              if (total == 0) {
                  $('#guardar').hide();
                  $('#cancelar').hide();
              } else {
                  $('#guardar').show();
                  $('#cancelar').show();
              }
          }

          function limpiarCampos() {
              let select = $('#producto_id');
              select.selectpicker('val', '');
              $('#cantidad').val('');
              $('#precio_venta').val('');
              $('#descuento').val('');
              $('#stock').val('');
          }

          function showModal(message, icon = 'error') {
              const Toast = Swal.mixin({
                  toast: true,
                  position: 'top-end',
                  showConfirmButton: false,
                  timer: 3000,
                  timerProgressBar: true,
                  didOpen: (toast) => {
                      toast.addEventListener('mouseenter', Swal.stopTimer)
                      toast.addEventListener('mouseleave', Swal.resumeTimer)
                  }
              })
              Toast.fire({
                  icon: icon,
                  title: message
              })
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
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
          integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous">
      </script>
      <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
      {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script> --}}
      <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
      <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
      <script src="{{ asset('assets/demo/datatables-demo.js') }}"></script>
  @endpush
