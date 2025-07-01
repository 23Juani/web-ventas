  @extends('template')

  @section('title', 'Crear Categoria')

  @push('css')
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
                      <div class="page-header-icon"><i data-feather="archive"></i></div>
                      <span>Presentaciones</span>
                  </h1>
                  <div class="page-header-subtitle">Crea una nueva presentacion</div>
              </div>
          </div>
      </div>

      <div class="container-fluid mt-n10">
          <div class="row">
              <div class="col-lg-9">
                  <div id="default">
                      <div class="card mb-4">
                          <div class="card-header d-flex align-items-center">
                              <a href="{{ route('presentaciones.index') }}">
                                  <button class="btn btn-outline-danger" type="button">Cancelar</button>
                              </a>
                              <span class="me-3 p-2">
                                  Crear Presentacion
                              </span>
                          </div>
                          <form action="{{ route('presentaciones.store') }}" method="post">
                              @csrf
                              <div class="card-body">
                                  <div class="sbp-preview">
                                      <div class="sbp-preview-content">
                                          <div class="form-group">
                                              <label for="nombre">Nombre</label>
                                              <input class="form-control" id="nombre" type="text" name="nombre"
                                                  value="{{ old('nombre') }}" />
                                              @error('nombre')
                                                  <small class="text-danger">{{ '*' . $message }}</small>
                                              @enderror
                                          </div>

                                          <div class="form-group">
                                              <label for="descripcion">Descripcion</label>
                                              <textarea class="form-control" id="descripcion" name="descripcion" rows="3">{{ old('descripcion') }}</textarea>
                                              @error('descripcion')
                                                  <small class="text-danger">{{ '*' . $message }}</small>
                                              @enderror
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
      <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
      <script src="{{ asset('assets/demo/chart-area-demo.js') }}"></script>
      <script src="{{ asset('assets/demo/chart-bar-demo.js') }}"></script>
      <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
      <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
      <script src="{{ asset('assets/demo/datatables-demo.js') }}"></script>
  @endpush
