<div class="row">
  <div class="table-responsive">
    <table class="table table-striped" id="tabla-usuarios">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Hotel</th>
          <th scope="col">Destino</th>
          <th scope="col">Categoria</th>
          <th scope="col">Acciones</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($users as $key => $v)
          <tr data-key="{{$v->id}}"  data-catid="{{$v->CategoriaID}}" data-destinid="{{$v->DestinoID}}"  data-hotel="{{$v->hotel}}" data-categoria="{{$v->categoria}}" data-destino="{{$v->destino}}">
            <th scope="row">{{ $loop->iteration}}</th>
            <td>{{$v->hotel}}</td>
            <td>{{$v->destino}}</td>
            <td>{{$v->categoria}}</td>
            <td>
              <div class="btn-group btn-group-sm" role="group" aria-label="Basic outlined example">
                <button type="button" class="btn btn-outline-dark actionHo" data-action="update" data-title="Editar">Edit</button>
                <button type="button" class="btn btn-outline-dark actionHo" data-action="delete" data-title="Eliminar">Delete</button>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  {{-- {{ $users->links() }} --}}
</div>
