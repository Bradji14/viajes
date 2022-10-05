<div class="row">
  <div class="table-responsive">
    <table class="table table-striped" id="tabla-usuarios">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Destino</th>
          <th scope="col">IATA Destino</th>
          <th scope="col">Aeropuerto destino</th>
          <th scope="col">País IATA</th>
          <th scope="col">Acciones</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($users as $key => $v)
          <tr data-key="{{$v->id}}" data-destinop="{{$v->destino}}" data-iata="{{$v->iataDestino }}" data-aeropuerto="{{$v->aeropuertoDestino}}" data-iap="{{$v->iataPais}}">
            <th scope="row">{{ $loop->iteration}}</th>
            <td>{{$v->destino}}</td>
            <td>{{$v->iataDestino}}</td>
            <td>{{$v->aeropuertoDestino}}</td>
            <td>{{$v->iataPais}}</td>


            <td>
              <div class="btn-group btn-group-sm" role="group" aria-label="Basic outlined example">
                <button type="button" class="btn btn-outline-dark actionD" data-action="update" data-title="Editar">Edit</button>
                <button type="button" class="btn btn-outline-dark actionD" data-action="delete" data-title="Eliminar">Delete</button>

              </div>

              </div>
              </div>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  {{-- {{ $users->links() }} --}}
</div>
