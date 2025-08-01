  @extends('template')

  @section('title', 'Editar rol')

  @push('css')
      {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> --}}
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
  @endpush

  @section('content')

      <div class="page-header pb-10 page-header-dark bg-gradient-primary-to-secondary">
          <div class="container-fluid">
              <div class="page-header-content">
                  <h1 class="page-header-title">
                      <div class="page-header-icon"><i data-feather="clipboard"></i></div>
                      <span>Usuarios</span>
                  </h1>
                  <div class="page-header-subtitle">Editar rol</div>
              </div>
          </div>
      </div>
      <div class="container-fluid mt-n10">
          <div class="row">
              <div class="col-lg-9">
                  <div id="default">
                      <div class="card mb-4">
                          <div class="card-header d-flex align-items-center">
                              <a href="{{ route('roles.index') }}">
                                  <button class="btn btn-outline-danger" type="button">Cancelar</button>
                              </a>
                              <span class="me-3 p-2">
                                  Editar rol
                              </span>
                          </div>
                          <form action="{{ route('roles.update', ['role' => $role]) }}" method="post">
                              @method('PATCH')
                              @csrf
                              <div class="card-body">
                                  <div class="sbp-preview">
                                      <div class="sbp-preview-content">
                                          <div class="row g-4">
                                              <!----Codigo---->
                                              <div class="col-md-6">
                                                  <label for="name" class="form-label">Nombre del rol:</label>
                                                  <input type="text" name="name" id="name" class="form-control"
                                                      value="{{ old('name', $role->name) }}">
                                                  @error('name')
                                                      <small class="text-danger">{{ '*' . $message }}</small>
                                                  @enderror
                                              </div>
                                              <div class="col-md-12">
                                                  <p class="text-muted">Permisos para el rol:</p>
                                                  @foreach ($permisos as $item)
                                                      @if (in_array($item->id, $role->permissions->pluck('id')->toArray()))
                                                          <div class="form-check mb-2">
                                                              <input checked type="checkbox" name="permission[]"
                                                                  id="{{ $item->id }}" class="form-check-input"
                                                                  value="{{ $item->id }}">
                                                              <label for="{{ $item->id }}"
                                                                  class="form-check-label">{{ $item->name }}</label>
                                                          </div>
                                                      @else
                                                          <div class="form-check mb-2">
                                                              <input type="checkbox" name="permission[]"
                                                                  id="{{ $item->id }}" class="form-check-input"
                                                                  value="{{ $item->id }}">
                                                              <label for="{{ $item->id }}"
                                                                  class="form-check-label">{{ $item->name }}</label>
                                                          </div>
                                                      @endif
                                                  @endforeach
                                              </div>
                                              @error('permission')
                                                  <small class="text-danger">{{ '*' . $message }}</small>
                                              @enderror
                                          </div>
                                      </div>

                                      <div class="sbp-preview-text">
                                          <button class="btn btn-primary" type="submit">Guardar</button>
                                          <button class="btn btn-purple" type="reset">Reiniciar</button>
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
      <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/i18n/defaults-es_ES.min.js"></script>
      {{-- <script>
          $(document).ready(function() {
              $('.selectpicker').selectpicker();
          });
      </script> --}}
  @endpush
