<div class="row">
  <div class="table-responsive">
    <table class="table table-striped" id="tabla-usuarios">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Agencia</th>
          <th scope="col">Telefono</th>
          <th scope="col">Direccion</th>
          <th scope="col">Acciones</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($users as $key => $v)
          <tr data-key="{{$v->id}}" data-agencia="{{$v->nombreAgen}}" data-razon="{{$v->razon_social}}" data-rfc="{{$v->RFC}}"
            data-telefono="{{$v->telefono}}" data-web="{{$v->web}}" data-email="{{$v->email}}" data-direc="{{$v->direccion}}">

            <th scope="row">{{ $loop->iteration}}</th>
            <td>{{substr($v->nombreAgen,0,20)}}...</td>
            <td>{{$v->telefono}}</td>
            <td>{{$v->direccion}}</td>
            <td>
              <div class="btn-group btn-group-sm" role="group" aria-label="Basic outlined example">
                <button type="button" class="btn btn-outline-dark action" data-action="update" data-title="Editar">Edit</button>
                <button type="button" class="btn btn-outline-dark action" data-action="delete" data-title="Eliminar">Delete</button>
                {{-- <a href="{{url('/agencia/users')}}"> --}}
                <button type="button" class="btn btn-outline-dark usuarios" data-title="">Users</button>
            {{-- </a> --}}
              </div>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  {{ $users->links() }}
</div>
