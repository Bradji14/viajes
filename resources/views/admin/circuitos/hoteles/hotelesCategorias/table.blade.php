<div class="row">
  <div class="table-responsive">
    <table class="table table-striped" id="tabla-usuarios">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Categoria</th>
          <th scope="col">Acciones</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($users as $key => $v)
          <tr data-key="{{$v->id}}" data-cate="{{$v->categoria}}">
            <th scope="row">{{ $loop->iteration}}</th>
            <td>{{$v->categoria}}</td>
            <td>
              <div class="btn-group btn-group-sm" role="group" aria-label="Basic outlined example">
                <button type="button" class="btn btn-outline-dark actionHoC" data-action="update" data-title="Editar">Edit</button>
                <button type="button" class="btn btn-outline-dark actionHoC" data-action="delete" data-title="Eliminar">Delete</button>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  {{-- {{ $users->links() }} --}}
</div>
