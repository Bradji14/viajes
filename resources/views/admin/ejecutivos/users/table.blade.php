<div class="row">
  <div class="table-responsive">
    <table class="table" id="tabla-usuarios">
      <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nombres</th>
            <th scope="col">Apellidos</th>
            <th scope="col">Email</th>
          </tr>
      </thead>
      <tbody>
        @foreach ($users as $key => $v)
          <tr data-key="{{$v->id}}" data-nombres="{{$v->nombres}}"data-apellidos="{{$v->apellidos}}" data-telefono="{{$v->telefono}}" data-email="{{$v->email}}">
            <th scope="row">{{ $loop->iteration  }}</th>
            <td>{{$v->nombres}}</td>
            <td>{{$v->apellidos}}</td>
            <td>{{$v->email}}</td>
            <td>
              <div class="btn-group btn-group-sm" role="group" aria-label="Basic outlined example">
                <button type="button" class="btn btn-outline-dark action" data-action="update" data-title="Editar">Edit</button>
                <button type="button" class="btn btn-outline-dark action" data-action="delete" data-title="Eliminar">Delete</button>
              </div>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  {{ $users->links() }}
</div>
