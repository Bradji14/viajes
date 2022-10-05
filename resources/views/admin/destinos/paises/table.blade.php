<div class="row">
  <div class="table-responsive">
    <table class="table table-striped" id="tabla-usuarios">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Pais</th>
          <th scope="col">IATA</th>
          <th scope="col">Acciones</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($users as $key => $v)
          <tr data-key="{{$v->id}}" data-pais="{{$v->pais}}" data-iata="{{$v->IATA }}">
                <th scope="row">{{ $loop->iteration}}</th>
                <td>{{$v->pais}}</td>
                <td>{{$v->IATA}}</td>
                <td>
                    <div class="btn-group btn-group-sm" role="group" aria-label="Basic outlined example">
                    <button type="button" class="btn btn-outline-dark actionPa" data-action="update" data-title="Editar">Edit</button>
                    <button type="button" class="btn btn-outline-dark actionPa" data-action="delete" data-title="Eliminar">Delete</button>
                    </div>

                </td>
            </tr>
          @endforeach
        </tbody>
    </table>
</div>
    {{-- {{ $users->links() }} --}}
</div>
