<div class="row">
  <div class="table-responsive">
    <table class="table table-striped" id="tabla-usuarios">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Estado</th>
          <th scope="col">País</th>
          <th scope="col">Acciones</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($users as $key => $v)
          <tr data-key="{{$v->id}}" data-paid="{{$v->paises_idPais}}" data-estado="{{$v->estado }}" data-pais="{{ $v->pais}}">
                <th scope="row">{{ $loop->iteration}}</th>
                <td>{{$v->estado}}</td>
                <td>{{$v->pais}}</td>
                <td>
                    <div class="btn-group btn-group-sm" role="group" aria-label="Basic outlined example">
                    <button type="button" class="btn btn-outline-dark actionEs" data-action="update" data-title="Editar">Edit</button>
                    <button type="button" class="btn btn-outline-dark actionEs" data-action="delete" data-title="Eliminar">Delete</button>
                    </div>

                </td>
            </tr>
          @endforeach
        </tbody>
    </table>
</div>
    {{-- {{ $users->links() }} --}}
</div>
