<div class="hero d-flex align-items-end">
  <div class="container searchbox">
    <h2 class="text-white">Circuitos</h2>
    <form method="get" role="search" class="row py-3" action="{{url('circuitos/destino/')}}">
      <div class="col-lg-10">
        <select class="form-select form-select-lg mt-2" name="slug">
          <option selected>Seleccione un destino</option>
          <option value="europa">Viajes a Europa</option>
          <option value="oriente">Medio Oriente</option>
          <option value="sudamerica">Sudamérica</option>
        </select>
      </div>
      <div class="col-lg-2 d-grid">
        <button type="submit" class="btn btn-primary btn-lg sbox">
          <span class="material-symbols-outlined">search</span>
          <em class="btn-text">Buscar</em>
        </button>
      </div>
    </form>
  </div>
</div>
