  @extends('template')

  @section('title', 'Crear compra')

  @push('css')
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
      <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet"
          crossorigin="anonymous" />
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

      <div class="container-fluid mt-n10">
          <div class="row">
              <div class="col-lg-9">
                  <div id="default">
                      <div class="card mb-4">
                          <div class="card-header d-flex align-items-center">
                              <a href="{{ route('clientes.index') }}">
                                  <button class="btn btn-outline-danger" type="button">Cancelar</button>
                              </a>
                              <span class="me-3 p-2">
                                  Crear Cliente
                              </span>
                          </div>
                          <form action="{{ route('clientes.store') }}" method="post">
                              @csrf
                              <div class="card-body">
                                  <div class="sbp-preview">
                                      <div class="sbp-preview-content">
                                          <div class="row g-4">
                                              <!---Campo producto---->
                                              <div class="col-md-12">
                                                  <label for="tipo_persona" class="form-label">Busqueda de producto:</label>
                                                  <select class="form-control selectpicker show-tick" name="tipo_persona"
                                                      id="tipo_persona">
                                                      <option value="" selected disabled>Seleccione un producto
                                                      </option>
                                                      <option value="natural"
                                                          {{ old('tipo_persona') == 'natural' ? 'selected' : '' }}>Persona
                                                          natural</option>
                                                      <option value="juridica"
                                                          {{ old('tipo_persona') == 'juridica' ? 'selected' : '' }}>Persona
                                                          jurídica</option>
                                                  </select>
                                                  @error('tipo_persona')
                                                      <small class="text-danger">{{ '*' . $message }}</small>
                                                  @enderror
                                              </div>
                                              <!-------cantidad------->
                                              <div class="col-md-4" id="box-razon-social">
                                                  <label id="label-natural" for="razon_social"
                                                      class="form-label">Cantidad:</label>
                                                  <input required type="number" name="razon_social" id="razon_social"
                                                      class="form-control" value="{{ old('razon_social') }}">
                                                  @error('razon_social')
                                                      <small class="text-danger">{{ '*' . $message }}</small>
                                                  @enderror
                                              </div>

                                              <!------precio de compra---->
                                              <div class="col-md-4">
                                                  <label for="direccion" class="form-label">Precio de compra:</label>
                                                  <input required type="number" name="direccion" id="direccion"
                                                      class="form-control" value="{{ old('direccion') }}">
                                                  @error('direccion')
                                                      <small class="text-danger">{{ '*' . $message }}</small>
                                                  @enderror
                                              </div>
                                              <!------precio de venta---->
                                              <div class="col-md-4">
                                                  <label for="direccion" class="form-label">Precio de venta:</label>
                                                  <input required type="number" name="direccion" id="direccion"
                                                      class="form-control" value="{{ old('direccion') }}">
                                                  @error('direccion')
                                                      <small class="text-danger">{{ '*' . $message }}</small>
                                                  @enderror
                                              </div>
                                          </div>
                                      </div>

                                      <div class="sbp-preview-text">
                                          <button class="btn btn-primary" type="submit">Guardar</button>
                                      </div>
                                  </div>
                              </div>
                          </form>
                      </div>
                  </div>
              </div>
              <div class="card mb-5">
                  <div id="default">
                      <div class="card mb-4">
                          <div class="card-header d-flex align-items-center">
                              <span class="me-3 p-2">
                                  Datos generales
                              </span>
                          </div>
                          <div class="card-body">
                              <div class="sbp-preview">
                                  <div class="sbp-preview-content">
                                      <div class="col-md-12">
                                          <label id="label-natural" for="razon_social" class="form-label">Proveedor:</label>
                                          <select class="form-control selectpicker show-tick" name="tipo_persona"
                                              id="tipo_persona">
                                              <option value="" selected disabled>Seleccione un proveedor
                                              </option>
                                              <option value="natural"
                                                  {{ old('tipo_persona') == 'natural' ? 'selected' : '' }}>Persona
                                                  natural</option>
                                              <option value="juridica"
                                                  {{ old('tipo_persona') == 'juridica' ? 'selected' : '' }}>Persona
                                                  jurídica</option>
                                          </select>
                                      </div>
                                      {{-- tipo de comprobante --}}
                                      <div class="col-md-12">
                                          <label id="label-natural" for="razon_social" class="form-label">Tipo de
                                              comprobante:</label>
                                          <select class="form-control selectpicker show-tick" name="tipo_persona"
                                              id="tipo_persona">
                                              <option value="" selected disabled>Seleccione un comprobante
                                              </option>
                                              <option value="natural"
                                                  {{ old('tipo_persona') == 'natural' ? 'selected' : '' }}>Persona
                                                  natural</option>
                                              <option value="juridica"
                                                  {{ old('tipo_persona') == 'juridica' ? 'selected' : '' }}>Persona
                                                  jurídica</option>
                                          </select>
                                      </div>
                                      {{-- numero de comprobante  --}}
                                      <div class="col-md-12" id="box-razon-social">
                                          <label class="form-label">Numero de comprobante:</label>
                                          <input required type="text" name="direccion" id="direccion"
                                              class="form-control">
                                      </div>
                                      <div class="col-md-6" id="box-razon-social">
                                          <label class="form-label">Impuesto:</label>
                                          <input required type="number" name="direccion" id="direccion"
                                              class="form-control">
                                      </div>
                                      <div class="col-md-6" id="box-razon-social">
                                          <label class="form-label">Fecha:</label>
                                          <input required type="date" name="direccion" id="direccion"
                                              class="form-control">
                                      </div>

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
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
          integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous">
      </script>
      <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
      <script src="{{ asset('assets/demo/chart-area-demo.js') }}"></script>
      <script src="{{ asset('assets/demo/chart-bar-demo.js') }}"></script>
      <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
      <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
      <script src="{{ asset('assets/demo/datatables-demo.js') }}"></script>
  @endpush
