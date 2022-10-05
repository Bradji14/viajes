<div class="row">
  <div class="table-responsive">
    <table class="table table-striped" id="tabla-usuarios">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Proveedor</th>
          <th scope="col">Telefono</th>
          <th scope="col">Email</th>
          <th scope="col">Acciones</th>

        </tr>
      </thead>
      <tbody>
        @foreach ($users as $key => $v)
          <tr data-key="{{$v->id}}" data-prov="{{$v->proveedor}}" data-telefono="{{$v->telefono}}" data-email="{{$v->email}}">
            <th scope="row">{{ $loop->iteration  }}</th>
            <td>{{$v->proveedor}}</td>
            <td>{{$v->telefono}}</td>
            <td>{{$v->email}}</td>

            <td>
              <div class="btn-group btn-group-sm" role="group" aria-label="Basic outlined example">
                <button type="button" class="btn btn-outline-dark actionP" data-action="update" data-title="Editar">Edit</button>
                <button type="button" class="btn btn-outline-dark actionP" data-action="delete" data-title="Eliminar">Delete</button>
              </div>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
