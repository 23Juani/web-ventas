  @extends('template')

  @section('title', 'Crear Producto')

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
                      <div class="page-header-icon"><i data-feather="package"></i></div>
                      <span>Productos</span>
                  </h1>
                  <div class="page-header-subtitle">Crea un nuevo producto</div>
              </div>
          </div>
      </div>

      <div class="container-fluid mt-n10">
          <div class="row">
              <div class="col-lg-9">
                  <div id="default">
                      <div class="card mb-4">
                          <div class="card-header d-flex align-items-center">
                              <a href="{{ route('productos.index') }}">
                                  <button class="btn btn-outline-danger" type="button">Cancelar</button>
                              </a>
                              <span class="me-3 p-2">
                                  Crear Producto
                              </span>
                          </div>
                          <form action="{{ route('productos.store') }}" method="post">
                              @csrf
                              <div class="card-body">
                                  <div class="sbp-preview">
                                      <div class="sbp-preview-content">
                                          <div class="row g-4">
                                              <!----Codigo---->
                                              <div class="col-md-6">
                                                  <label for="codigo" class="form-label">Código:</label>
                                                  <input type="text" name="codigo" id="codigo" class="form-control"
                                                      value="{{ old('codigo') }}">
                                                  @error('codigo')
                                                      <small class="text-danger">{{ '*' . $message }}</small>
                                                  @enderror
                                              </div>

                                              <!---Nombre---->
                                              <div class="col-md-6">
                                                  <label for="nombre" class="form-label">Nombre:</label>
                                                  <input type="text" name="nombre" id="nombre" class="form-control"
                                                      value="{{ old('nombre') }}">
                                                  @error('nombre')
                                                      <small class="text-danger">{{ '*' . $message }}</small>
                                                  @enderror
                                              </div>

                                              <!---Descripción---->
                                              <div class="col-12">
                                                  <label for="descripcion" class="form-label">Descripción:</label>
                                                  <textarea name="descripcion" id="descripcion" rows="3" class="form-control">{{ old('descripcion') }}</textarea>
                                                  @error('descripcion')
                                                      <small class="text-danger">{{ '*' . $message }}</small>
                                                  @enderror
                                              </div>

                                              <!---Fecha de vencimiento---->
                                              <div class="col-md-6">
                                                  <label for="fecha_vencimiento" class="form-label">Fecha de
                                                      vencimiento:</label>
                                                  <input type="date" name="fecha_vencimiento" id="fecha_vencimiento"
                                                      class="form-control" value="{{ old('fecha_vencimiento') }}">
                                                  @error('fecha_vencimiento')
                                                      <small class="text-danger">{{ '*' . $message }}</small>
                                                  @enderror
                                              </div>

                                              <!---Imagen---->
                                              <div class="col-md-6">
                                                  <label for="img_path" class="form-label">Imagen:</label>
                                                  <input type="file" name="img_path" id="img_path" class="form-control"
                                                      accept="image/*">
                                                  @error('img_path')
                                                      <small class="text-danger">{{ '*' . $message }}</small>
                                                  @enderror
                                              </div>

                                              <!---Marca---->
                                              <div class="col-md-6">
                                                  <label for="marca_id" class="form-label">Marca:</label>
                                                  <select data-size="4" title="Seleccione una marca"
                                                      data-live-search="true" name="marca_id" id="marca_id"
                                                      class="form-control selectpicker show-tick">
                                                      @foreach ($marcas as $item)
                                                          <option value="{{ $item->id }}"
                                                              {{ old('marca_id') == $item->id ? 'selected' : '' }}>
                                                              {{ $item->nombre }}</option>
                                                      @endforeach
                                                  </select>
                                                  @error('marca_id')
                                                      <small class="text-danger">{{ '*' . $message }}</small>
                                                  @enderror
                                              </div>

                                              <!---Presentaciones---->
                                              <div class="col-md-6">
                                                  <label for="presentacione_id" class="form-label">Presentación:</label>
                                                  <select data-size="4" title="Seleccione una presentación"
                                                      data-live-search="true" name="presentacione_id" id="presentacione_id"
                                                      class="form-control selectpicker show-tick">
                                                      @foreach ($presentaciones as $item)
                                                          <option value="{{ $item->id }}"
                                                              {{ old('presentacione_id') == $item->id ? 'selected' : '' }}>
                                                              {{ $item->nombre }}</option>
                                                      @endforeach
                                                  </select>
                                                  @error('presentacione_id')
                                                      <small class="text-danger">{{ '*' . $message }}</small>
                                                  @enderror
                                              </div>

                                              <!---Categorías---->
                                              <div class="col-md-6">
                                                  <label for="categorias" class="form-label">Categorías:</label>
                                                  <select data-size="4" title="Seleccione las categorías"
                                                      data-live-search="true" name="categorias[]" id="categorias"
                                                      class="form-control selectpicker show-tick" multiple>
                                                      @foreach ($categorias as $item)
                                                          <option value="{{ $item->id }}"
                                                              {{ in_array($item->id, old('categorias', [])) ? 'selected' : '' }}>
                                                              {{ $item->nombre }}</option>
                                                      @endforeach
                                                  </select>
                                                  @error('categorias')
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
      <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
      <script src="{{ asset('assets/demo/chart-area-demo.js') }}"></script>
      <script src="{{ asset('assets/demo/chart-bar-demo.js') }}"></script>
      <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
      <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
      <script src="{{ asset('assets/demo/datatables-demo.js') }}"></script>
  @endpush
