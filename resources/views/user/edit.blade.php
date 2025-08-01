  @extends('template')

  @section('title', 'editar usuario')

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
                      <div class="page-header-icon"><i data-feather="user-plus"></i></div>
                      <span>Usuarios</span>
                  </h1>
                  <div class="page-header-subtitle">Editar usuario</div>
              </div>
          </div>
      </div>
      <div class="container-fluid mt-n10">
          <div class="row">
              <div class="col-lg-9">
                  <div id="default">
                      <div class="card mb-4">
                          <div class="card-header d-flex align-items-center">
                              <a href="{{ route('users.index') }}">
                                  <button class="btn btn-outline-danger" type="button">Cancelar</button>
                              </a>
                              <span class="me-3 p-2">
                                  Crear Usuario
                              </span>
                          </div>
                          <form action="{{ route('users.update', ['user' => $user]) }}" method="post">
                              @method('PATCH')
                              @csrf
                              <div class="card-body">
                                  <div class="sbp-preview">
                                      <div class="sbp-preview-content">
                                          <div class="row g-4">
                                              <!----nombre---->
                                              <div class="col-sm-6 my-2">
                                                  <div class="input-group" id="hide-group">
                                                      <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                                                      <input autocomplete="off" type="text" name="name" id="name"
                                                          class="form-control" value="{{ old('name', $user->name) }}"
                                                          aria-labelledby="nameHelpBlock">
                                                  </div>
                                                  @error('name')
                                                      <small class="text-danger">{{ '*' . $message }}</small>
                                                  @enderror
                                              </div>
                                              <div class="col-sm-6 my-2">
                                                  <div class="form-text" id="nameHelpBlock">
                                                      Escriba un solo nombre
                                                  </div>
                                              </div>
                                              <!----email---->
                                              <div class="col-sm-6 my-2">
                                                  <div class="input-group" id="hide-group">
                                                      <span class="input-group-text"><i
                                                              class="fa-solid fa-envelope"></i></span>
                                                      <input autocomplete="off" type="email" name="email" id="email"
                                                          class="form-control" value="{{ old('email', $user->email) }}"
                                                          aria-labelledby="emailHelpBlock">
                                                  </div>
                                                  @error('email')
                                                      <small class="text-danger">{{ '*' . $message }}</small>
                                                  @enderror
                                              </div>
                                              <div class="col-sm-6 my-2">
                                                  <div class="form-text" id="nameHelpBlock">
                                                      Dirección de correo eléctronico
                                                  </div>
                                              </div>
                                              <!----Password---->
                                              <div class="col-sm-6 my-2">
                                                  <div class="input-group" id="hide-group">
                                                      <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                                                      <input type="password" name="password" id="password"
                                                          class="form-control" aria-labelledby="passwordHelpBlock">
                                                  </div>
                                                  @error('password')
                                                      <small class="text-danger">{{ '*' . $message }}</small>
                                                  @enderror
                                              </div>
                                              <div class="col-sm-6 my-2">
                                                  <div class="form-text" id="nameHelpBlock">
                                                      Escriba una constraseña segura. Debe incluir números.
                                                  </div>
                                              </div>
                                              <!----Password---->
                                              <div class="col-sm-6 my-2">
                                                  <div class="input-group" id="hide-group">
                                                      <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                                                      <input type="password" name="password_confirm" id="password_confirm"
                                                          class="form-control" aria-labelledby="passwordConfirmHelpBlock">
                                                  </div>
                                                  @error('password_confirm')
                                                      <small class="text-danger">{{ '*' . $message }}</small>
                                                  @enderror
                                              </div>
                                              <div class="col-sm-6 my-2">
                                                  <div class="form-text" id="nameHelpBlock">
                                                      Vuelva a escribir su contraseña.
                                                  </div>
                                              </div>
                                              <!---rol---->
                                              <div class="col-sm-6 my-2">
                                                  {{-- <label for="role" class="form-label">Rol:</label> --}}
                                                  <select data-size="4" title="Seleccione un rol" data-live-search="true"
                                                      name="role" id="role"
                                                      class="form-control selectpicker show-tick">
                                                      @foreach ($roles as $item)
                                                          @if (in_array($item->name, $user->roles->pluck('name')->toArray()))
                                                              <option selected value="{{ $item->name }}"
                                                                  @selected(old('role') == $item->name)>
                                                                  {{ $item->name }}</option>
                                                          @else
                                                              <option value="{{ $item->name }}"
                                                                  @selected(old('role') == $item->name)>
                                                                  {{ $item->name }}</option>
                                                          @endif
                                                      @endforeach
                                                  </select>
                                                  @error('role')
                                                      <small class="text-danger">{{ '*' . $message }}</small>
                                                  @enderror
                                              </div>
                                              <div class="col-sm-6 my-2">
                                                  <div class="form-text" id="nameHelpBlock">
                                                      Escoja un rol para el usuario.
                                                  </div>
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
