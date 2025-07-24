  @extends('template')

  @section('title', 'Crear compra')

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
                      <div class="page-header-icon"><i data-feather="users"></i></div>
                      <span>Crear nueva compra</span>
                  </h1>
                  <div class="page-header-subtitle">Compras</div>
              </div>
          </div>
      </div>

      <form action="{{ route('compras.store') }}" method="post">
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
                                      <span class="me-3 p-2 mb-0 ">Detalles de la compra</span>
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
                                                  <option value="" selected disabled>Busca un producto
                                                  </option>
                                                  @foreach ($productos as $item)
                                                      <option value="{{ $item->id }}">
                                                          {{ $item->codigo . ' | ' . $item->nombre }}</option>
                                                  @endforeach
                                              </select>
                                          </div>
                                          <!-------cantidad------->
                                          <div class="col-md-4 mb-2" id="box-razon-social">
                                              <label for="cantidad" class="form-label">Cantidad:</label>
                                              <input type="number" name="cantidad" id="cantidad" class="form-control"
                                                  min="0">
                                          </div>

                                          <!------precio de compra---->
                                          <div class="col-md-4 mb-2">
                                              <label for="precio_compra" class="form-label">Precio de compra:</label>
                                              <input type="number" name="precio_compra" id="precio_compra"
                                                  class="form-control" step="0.1" min="0">
                                          </div>
                                          <!------precio de venta---->
                                          <div class="col-md-4 mb-2">
                                              <label for="precio_venta" class="form-label">Precio de venta:</label>
                                              <input type="number" name="precio_venta" id="precio_venta"
                                                  class="form-control" step="0.1" min="0">
                                          </div>

                                          <div class="col-md-12 mb-2 mt-2 d-flex justify-content-center">
                                              <button id="btn_agregar" type="button"
                                                  class="btn btn-outline-blue-soft w-100">Agregar</button>
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
                                                              <th>Precio compra</th>
                                                              <th>Precio venta</th>
                                                              <th>Subtotal</th>
                                                              <th>Acciones</th>
                                                          </tr>
                                                      </thead>
                                                      <tbody id="tabla_detalle_body">
                                                      </tbody>
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
                                              {{-- Proveedor --}}
                                              <div class="col-md-12 mb-2">
                                                  <label for="proveedore_id" class="form-label">Proveedor:</label>
                                                  <select class="form-control selectpicker show-tick" name="proveedore_id"
                                                      id="proveedore_id" data-live-search="true" data-size="3">
                                                      <option value="" selected disabled>Seleccione un proveedor
                                                      </option>
                                                      @foreach ($proveedores as $item)
                                                          <option value="{{ $item->id }}" {{-- {{ old('proveedore_id') == $item->id ? 'selected' : '' }} --}}>
                                                              {{ $item->persona->razon_social }}</option>
                                                      @endforeach
                                                  </select>
                                                  @error('proveedore_id')
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
                                              {{-- serie de comprobante --}}
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
                                              </div>
                                              {{-- boton para resgistrar la compra --}}
                                              <div class="col-md-12 mb-2 mt-2 d-flex justify-content-center">
                                                  <button type="submit" id="guardar"
                                                      class="btn btn-outline-blue-soft w-100">Realizar compra</button>
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
      </form>
      {{-- Modal de confirmacion para cancelar la compra --}}
      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <h1 class="modal-title fs-5" id="exampleModalLabel">Advertencia</h1>
                      {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
                  </div>
                  <div class="modal-body">
                      ¿Seguro que quieres cancelar la compra?
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cerrar</button>
                      <button id="btnCancelarCompra" type="button" class="btn btn-danger"
                          data-bs-dismiss="modal">Confirmar</button>
                  </div>
              </div>
          </div>
      </div>

  @endsection

  @push('js')
      <script>
          $(document).ready(function() {
              $('#btn_agregar').click(function() {
                  agregarProducto();
              });

              $('#btnCancelarCompra').click(function() {
                  cancelarCompra();
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

          //Constantes en caso de que se cambie el impuesto
          //En este caso el impuesto es 18%
          const impuesto = 0;

          function cancelarCompra() {
              //Elimar el tbody de la tabla
              $('#tabla_detalle tbody').empty();

              //Añadir una nueva fila a la tabla
              let fila = '<tr>' +
                  '<th></th>' +
                  '<td></td>' +
                  '<td></td>' +
                  '<td></td>' +
                  '<td></td>' +
                  '<td></td>' +
                  '<td></td>' +
                  '</tr>';
              $('#tabla_detalle').append(fila);

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

          function agregarProducto() {
              //Obtener valores de los campos
              let idProducto = $('#producto_id').val();
              let nameProducto = ($('#producto_id option:selected').text()).split(' | ')[1];
              let cantidad = $('#cantidad').val();
              let precioCompra = $('#precio_compra').val();
              let precioVenta = $('#precio_venta').val();

              //Validaciones 
              //1.Para que los campos no esten vacíos
              if (nameProducto != '' && nameProducto != undefined && cantidad != '' && precioCompra != '' && precioVenta !=
                  '') {

                  //2. Para que los valores ingresados sean los correctos
                  if (parseInt(cantidad) > 0 && (cantidad % 1 == 0) && parseFloat(precioCompra) > 0 && parseFloat(
                          precioVenta) > 0) {

                      //3. Para que el precio de compra sea menor que el precio de venta
                      if (parseFloat(precioVenta) > parseFloat(precioCompra)) {
                          //Calcular valores
                          subtotal[cont] = round(cantidad * precioCompra);
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
                              '<td><input type="hidden" name="arraypreciocompra[]" value="' + precioCompra + '">' +
                              precioCompra + '</td>' +
                              '<td><input type="hidden" name="arrayprecioventa[]" value="' + precioVenta + '">' +
                              precioVenta + '</td>' +
                              '<td>' + subtotal[cont] + '</td>' +
                              '<td><button class="btn btn-outline-danger" type="button" onClick="eliminarProducto(' +
                              cont +
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
                          showModal('Precio de compra incorrecto');
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

          function limpiarCampos() {
              let select = $('#producto_id');
              select.selectpicker('val', '');
              $('#cantidad').val('');
              $('#precio_compra').val('');
              $('#precio_venta').val('');
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
