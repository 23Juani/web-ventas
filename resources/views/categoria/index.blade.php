  @extends('template')

  @section('title', 'Categorias')

  @push('css')
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
      <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet"
          crossorigin="anonymous" />
  @endpush

  @section('content')

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
                      <div class="page-header-icon"><i data-feather="archive"></i></div>
                      <span>Categorias</span>
                  </h1>
                  <div class="page-header-subtitle">Listado de las categorias</div>
              </div>
          </div>
      </div>

      <div class="container-fluid mt-n10">
          <div class="card mb-4">
              <div class="card-header d-flex align-items-center">
                  <a href="{{ route('categorias.create') }}">
                      <button class="btn btn-outline-primary" type="button">Agregar</button>
                  </a>
                  <span class="me-3 p-2">
                      Tabla de categorias
                  </span>
              </div>

              <div class="card-body">
                  <div class="datatable table-responsive">
                      <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                          <thead>
                              <tr>
                                  <th>Nombre</th>
                                  <th>Descripcion</th>
                                  <th>Estado</th>
                                  <th>Acciones</th>
                              </tr>
                          </thead>
                          <tfoot>
                              <tr>
                                  <th>Nombre</th>
                                  <th>Descripcion</th>
                                  <th>Estado</th>
                                  <th>Acciones</th>
                              </tr>
                          </tfoot>
                          <tbody>
                              @foreach ($categorias as $categoria)
                                  <tr>
                                      <td>{{ $categoria->caracteristica->nombre }}</td>
                                      <td>{{ $categoria->caracteristica->descripcion }}</td>
                                      <td>
                                          @if ($categoria->caracteristica->estado == 1)
                                              <span class="badge badge-success badge-pill">Activo</span>
                                          @else
                                              <span class="badge badge-danger badge-pill">Inactivo</span>
                                          @endif
                                      </td>
                                      <td>
                                          <div class="d-flex justify-content-start">
                                              <form action="{{ route('categorias.edit', ['categoria' => $categoria]) }}"
                                                  method="get">
                                                  <button class="btn btn-datatable btn-icon btn-transparent-dark mr-2">
                                                      <i data-feather="edit"></i>
                                                  </button>
                                              </form>
                                              <div>
                                                  @if ($categoria->caracteristica->estado == 1)
                                                      <button class="btn btn-datatable btn-icon btn-transparent-dark"><i
                                                              data-feather="trash-2"></i>
                                                      </button>
                                                  @else
                                                      <button class="btn btn-datatable btn-icon btn-transparent-dark"><i
                                                              data-feather="rotate-cw"></i>
                                                      </button>
                                                  @endif
                                              </div>
                                          </div>
                                      </td>
                                  </tr>
                              @endforeach
                          </tbody>
                      </table>
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
