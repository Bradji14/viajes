@extends('Masteradmin')
@section('title', 'Users')
@section('description','Administrador')
@section('styles')
@endsection
@section('content')
  <div class="container">
      <div class="row justify-content-center">
          <div class="col-md-12">
              <div class="card">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                  <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3 d-flex">
                    <h6 class="text-white text-capitalize ps-3 col-8">Ejecutivos</h6>
                    <div class="col-4">
                      <button type="button" class="btn btn-outline-light btn-sm action" data-action="create" data-title="Agregar">Agregar</button>
                    </div>
                  </div>
                </div>
                  <div class="card-body">
                    @include('admin.ejecutivos.users.search')
                    @include('admin.ejecutivos.users.table')
                  </div>
              </div>
          </div>
      </div>
  </div>
@endsection
@section('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function(event) {
    let path = $('#root').data('path');
    // configurate header token for all request
    $.ajaxSetup({
       headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
     });
    // click action
    $('body').on('click', '.action', function(event)
    {
      event.preventDefault();
      /* Act on the event */
      let btn = $(this);
      let parent = btn.parents('tr');
      let title = btn.data('title')+' usuario';
      let action = btn.data('action');
      let JDialog = $.dialog({
         title: title,
         icon: 'fa fa-user',
         theme: 'modern',
         type:'dark',
         content:
         '<div class="container-fluid mt-3">'+
           '<div class="row" id="contentDialog">'+
           '</div>'+
         '</div>',
         onContentReady: function () {
             // bind to events
             var jc = this;
             this.$content.find('form').on('click','button', function (e)
             {
                 // if the user submits the form by pressing enter in the field.
                 e.preventDefault();
                 let error=0; let arraydata= {};
                 $('body').find('.formName .array').map(function () {
                   if ($(this).val()=="" && $(this).prop('required')){ error++;}
                   else{ arraydata[$(this).attr("name")] = $(this).val();}
                 }).get();
                 if(error==0)$(this).html('Procesando...');
                 // if action is edit or delete, id need it
                 if(action !== 'create'){arraydata['key'] = parent.data('key');}
                 // call ajax
                 $.ajax({
                   url: path+'/ejecutivo/users/action',
                   type: 'POST',
                   dataType: 'json',
                   data: {arraydata:arraydata,action:action}
                 })
                 .done(function(data)
                 {
                   if (data.tipo == 200)
                       setTimeout(() =>
                       {
                           window.location.reload();
                       }, 1000);
                       if (data.tipo == 300) alert('email existente');

                 })
                 .fail(function() {
                     console.log("error");
                 })
                 .always(function() {
                     console.log("complete");
                 });
             });
         },

         onOpenBefore: function (){
           if (action == 'delete') {
             let HtmlContent = '<div class="col-12"><p>¿Esta seguro que desea eliminar este usuario?</p></div>'+
             '<form action="" class="col-12"><button type="button" class="btn btn-primary bg-gradient-primary">Si,eliminar</button></form>';
             this.$content.find('#contentDialog').append(HtmlContent);
           }else{
             let HtmlContent = '<form action="" class="formName was-validated" autocomplete="off" novalidate>' +
               '<div class="form-group">' +
                 '<label for="name" class="form-label">Nombre</label>'+
                 '<input type="text" class="form-control array" name="name" required minlength="4">'+
                   '<div class="invalid-feedback"> Ingrese nombre</div>'+
               '</div>'+
               '<div class="form-group">' +
                 '<label for="name" class="form-label">Apellido</label>'+
                 '<input type="text" class="form-control array" name="apellidos" required minlength="4">'+
                    '<div class="invalid-feedback"> Ingrese Apellidos</div>'+
               '</div>'+
               '<div class="form-group">' +
                 '<label for="name" class="form-label">Telefono</label>'+
                 '<input type="number" class="form-control array" name="telefono" required minlength="10">'+
                   '<div class="invalid-feedback"> Ingrese Numero</div>'+
               '</div>'+
               '<div class="form-group">' +
                 '<label for="email" class="form-label">Correo electronico</label>'+
                 '<input type="email" class="form-control array" name="email" required >'+
                    '<div class="invalid-feedback"> Ingrese email valido</div>'+
               '</div>'+
               '<div class="form-group">' +
                 '<label for="password" class="form-label">Contraseña</label>'+
                 '<input type="password" class="form-control array" name="password" required minlength="8">'+
                   '<div class="invalid-feedback"> Ingrese Contraseña</div>'+
               '</div>'+
               '<div class="form-group mt-4">'+
                 '<button type="button" class="btn btn-primary bg-gradient-primary confirmU">'+btn.data('title')+'</button>'+
               '</div>'+
             '</form>';
             this.$content.find('#contentDialog').append(HtmlContent);
             // if is edit set values
             if(action == 'update'){
               this.$content.find('#contentDialog input[name="name"]').val(parent.data('nombres'));
               this.$content.find('#contentDialog input[name="email"]').val(parent.data('email'));
               this.$content.find('#contentDialog input[name="apellidos"]').val(parent.data('apellidos'));
               this.$content.find('#contentDialog input[name="telefono"]').val(parent.data('telefono'));
               this.$content.find('#contentDialog input[name="password"]').val('12345678');
             }
           }
         }
       });
    });
  });
</script>
@endsection
