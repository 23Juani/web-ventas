  @extends('template')

  @section('title', 'Crear Proveedor')

  @push('css')
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

      <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet"
          crossorigin="anonymous" />

      <style>
          #descripcion {
              resize: none;
          }
      </style>
  @endpush

  @section('content')

      <div class="page-header pb-10 page-header-dark bg-gradient-primary-to-secondary">
          <div class="container-fluid">
              <div class="page-header-content">
                  <h1 class="page-header-title">
                      <div class="page-header-icon"><i data-feather="users"></i></div>
                      <span>Proveedores</span>
                  </h1>
                  <div class="page-header-subtitle">Crea un nuevo proveedor</div>
              </div>
          </div>
      </div>

      <div class="container-fluid mt-n10">
          <div class="row">
              <div class="col-lg-9">
                  <div id="default">
                      <div class="card mb-4">
                          <div class="card-header d-flex align-items-center">
                              <a href="{{ route('proveedores.index') }}">
                                  <button class="btn btn-outline-danger" type="button">Cancelar</button>
                              </a>
                              <span class="me-3 p-2">
                                  Crear Proveedor
                              </span>
                          </div>
                          <form action="{{ route('proveedores.store') }}" method="post">
                              @csrf
                              <div class="card-body">
                                  <div class="sbp-preview">
                                      <div class="sbp-preview-content">
                                          <div class="row g-4">

                                              <!---Tipo de cliente---->
                                              <div class="col-md-6">
                                                  <label for="tipo_persona" class="form-label">Tipo de proveedor:</label>
                                                  <select class="form-control selectpicker show-tick" name="tipo_persona"
                                                      id="tipo_persona">
                                                      <option value="" selected disabled>Seleccione una opción
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
                                              <!-------Razón social------->
                                              <div class="col-md-6" id="box-razon-social">
                                                  <label id="label-natural" for="razon_social" class="form-label">Nombres y
                                                      apellidos:</label>
                                                  <label id="label-juridica" for="razon_social" class="form-label">Nombre de
                                                      la empresa:</label>
                                                  <input required type="text" name="razon_social" id="razon_social"
                                                      class="form-control" value="{{ old('razon_social') }}">
                                                  @error('razon_social')
                                                      <small class="text-danger">{{ '*' . $message }}</small>
                                                  @enderror
                                              </div>

                                              <!------Dirección---->
                                              <div class="col-md-6">
                                                  <label for="direccion" class="form-label">Dirección:</label>
                                                  <input required type="text" name="direccion" id="direccion"
                                                      class="form-control" value="{{ old('direccion') }}">
                                                  @error('direccion')
                                                      <small class="text-danger">{{ '*' . $message }}</small>
                                                  @enderror
                                              </div>

                                              <!--------------Documento------->
                                              <div class="col-md-6">
                                                  <label for="documento_id" class="form-label">Tipo de documento:</label>
                                                  <select class="form-control selectpicker show-tick" name="documento_id"
                                                      id="documento_id">
                                                      <option value="" selected disabled>Seleccione una opción
                                                      </option>
                                                      @foreach ($documentos as $item)
                                                          <option value="{{ $item->id }}"
                                                              {{ old('documento_id') == $item->id ? 'selected' : '' }}>
                                                              {{ $item->tipo_documento }}</option>
                                                      @endforeach
                                                  </select>
                                                  @error('documento_id')
                                                      <small class="text-danger">{{ '*' . $message }}</small>
                                                  @enderror
                                              </div>
                                              <!-----------------Número de documento------------>
                                              <div class="col-md-6">
                                                  <label for="numero_documento" class="form-label">Numero de
                                                      documento:</label>
                                                  <input required type="text" name="numero_documento"
                                                      id="numero_documento" class="form-control"
                                                      value="{{ old('numero_documento') }}">
                                                  @error('numero_documento')
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
          </div>
      </div>




  @endsection

  @push('js')
      <script>
          $(document).ready(function() {
              $('.selectpicker').selectpicker();

              // Al iniciar, ocultamos el div
              $('#box-razon-social').hide();

              $('#tipo_persona').on('change', function() {
                  let selectValue = $(this).val();

                  if (!selectValue) {
                      $('#box-razon-social').hide();
                  } else if (selectValue === 'natural') {
                      $('#box-razon-social').show();
                      $('#label-juridica').hide();
                      $('#label-natural').show();
                  } else if (selectValue === 'juridica') {
                      $('#box-razon-social').show();
                      $('#label-natural').hide();
                      $('#label-juridica').show();
                  }
              });

              // Opcional: si hay valor precargado (por old()), mostrarlo al cargar
              let initialValue = $('#tipo_persona').val();
              if (initialValue === 'natural') {
                  $('#box-razon-social').show();
                  $('#label-juridica').hide();
                  $('#label-natural').show();
              } else if (initialValue === 'juridica') {
                  $('#box-razon-social').show();
                  $('#label-natural').hide();
                  $('#label-juridica').show();
              } else {
                  $('#box-razon-social').hide();
              }
          });
      </script>

      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
  @endpush
