  @extends('template')

  @section('title', 'Compras')

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
                      <div class="page-header-icon"><i data-feather="shopping-cart"></i></div>
                      <span>Ventas</span>
                  </h1>
                  <div class="page-header-subtitle">Listado de ventas</div>
              </div>
          </div>
      </div>

      <div class="container-fluid mt-n10">
          <div class="card mb-4">
              <div class="card-header d-flex align-items-center">
                  <a href="{{ route('ventas.create') }}">
                      <button class="btn btn-outline-primary" type="button">Agregar</button>
                  </a>
                  <span class="me-3 p-2">
                      Tabla de ventas
                  </span>
              </div>

              <div class="card-body">
                  <div class="datatable table-responsive">
                      <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                          <thead>
                              <tr>
                                  <th>Tipo de comprobante</th>
                                  <th>Numero de comprobante</th>
                                  <th>Tipo de cliente</th>
                                  <th>Razon social</th>
                                  <th>Fecha</th>
                                  <th>Hora</th>
                                  <th>Total</th>
                                  <th>Acciones</th>
                              </tr>
                          </thead>
                          <tfoot>
                              <tr>
                                  <th>Tipo de comprobante</th>
                                  <th>Numero de comprobante</th>
                                  <th>Tipo de cliente</th>
                                  <th>Razon social</th>
                                  <th>Fecha</th>
                                  <th>Hora</th>
                                  <th>Total</th>
                                  <th>Acciones</th>
                              </tr>
                          </tfoot>
                          <tbody>
                              @foreach ($ventas as $item)
                                  <tr>
                                      <td>{{ $item->comprobante->tipo_comprobante }} </td>
                                      <td>{{ $item->numero_comprobante }}</td>
                                      <td>{{ ucfirst($item->cliente->persona->tipo_persona) }}</td>
                                      <td>{{ $item->cliente->persona->razon_social }}</td>
                                      <td><span class="m-1"><i
                                                  class="fa-solid fa-calendar-days"></i></span>{{ \Carbon\Carbon::parse($item->fecha_hora)->format('d-m-Y') }}
                                      </td>
                                      <td>
                                          <span class="m-1"><i
                                                  class="fa-solid fa-clock"></i></span>{{ \Carbon\Carbon::parse($item->fecha_hora)->format('H:i') }}
                                      </td>
                                      <td> {{ $item->total }}</td>
                                      <td>
                                          <div class="d-flex justify-content-start">
                                              <form action="{{ route('ventas.show', ['venta' => $item]) }}"
                                                  method="get">
                                                  <button class="btn btn-datatable btn-icon btn-transparent-dark mr-2">
                                                      <i data-feather="book"></i>
                                                  </button>
                                              </form>
                                              <div>
                                                  <button class="btn btn-datatable btn-icon btn-transparent-dark"
                                                      data-bs-toggle="modal"
                                                      data-bs-target="#exampleModal-{{$item->id}}"><i
                                                          data-feather="trash-2"></i>
                                                  </button>

                                              </div>
                                          </div>
                                      </td>
                                  </tr>

                                  <!-- Modal -->
                                  <div class="modal fade" id="exampleModal-{{$item->id}}" tabindex="-1"
                                      aria-labelledby="exampleModalLabel" aria-hidden="true">
                                      <div class="modal-dialog">
                                          <div class="modal-content">
                                              <div class="modal-header">
                                                  <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminar venta</h1>
                                              </div>
                                              <div class="modal-body">
                                                  ¿Seguro que quieres eliminar la venta?
                                              </div>
                                              <div class="modal-footer">
                                                  <button type="button" class="btn btn-danger"
                                                      data-bs-dismiss="modal">Cancelar</button>
                                                  <form
                                                      action="{{ route('ventas.destroy',['venta'=>$item->id]) }}"
                                                      method="post">
                                                      @method('DELETE')
                                                      @csrf
                                                      <button type="submit" class="btn btn-primary">Confirmar</button>
                                                  </form>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              @endforeach
                          </tbody>
                      </table>
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
