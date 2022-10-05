<div class="row">
  <form method="get" role="search">
    <div class="input-group input-group-outline @if(isset($q)) is-filled @endif">
      <label class="form-label">Type here...</label>
      <input type="text" class="form-control" onfocus="focused(this)" onfocusout="defocused(this)"name="q" value="{{$q}}">
    </div>
  </form>
</div>


