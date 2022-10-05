@extends('MasterAdmin')
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
                    <h6 class="text-white text-capitalize ps-3 col-8">Administradores</h6>
                    <div class="col-4">
                      <button type="button" class="btn btn-outline-light btn-sm actionP" data-action="create" data-title="Agregar">Agregar</button>
                    </div>
                  </div>
                </div>
                  <div class="card-body">
                    @include('admin.circuitos.proveedores.search')
                    @include('admin.circuitos..proveedores.table')
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
    $('body').on('click', '.actionP', function(event)
    {
      event.preventDefault();
      /* Act on the event */
   //    parent.idkey
      let btn = $(this);
      let parent = btn.parents('tr');
      let title = btn.data('title')+' Proveedor';
      let action = btn.data('action');
      let JDialog = $.dialog({
         title: title,
         icon: 'fa fa-user',
         theme: 'modern',
         type:'dark',
         columnClass:"col-md-5",
         content:
         '<div class="container-fluid mt-3">'+
           '<div clas="row" id="contentDialog">'+
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
                   url: path+'/circuitos/proveedores/action',
                   type: 'POST',
                   dataType: 'json',
                   data: {arraydata:arraydata,action:action}
                 })
                 .done(function(data)
                 {
                   if (data.tipo == 200) {

                       setTimeout(() =>
                       {
                           window.location.reload();
                       }, 1000);
                   }
                   else{
                       console.log('Error');
                   }
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
                 '<label for="name" class="form-label">Proveedor</label>'+
                 '<input type="text" class="form-control array" name="prov" required minlength="4">'+
               '<div class="invalid-feedback"> Ingrese el proveedor</div>'+
               '</div>'+
               '<div class="form-group">' +
                 '<label for="email" class="form-label">Telefono</label>'+
                 '<input type="number" class="form-control array" name="tel" required>'+
                 '<div class="invalid-feedback"> Ingrese telefono valido</div>'+
               '</div>'+
               '<div class="form-group">' +
                 '<label for="password" class="form-label">E-mail</label>'+
                 '<input type="email" class="form-control array" name="email" required>'+
                 '<div class="invalid-feedback"> Ingrese email</div>'+
               '</div>'+
               '<div class="form-group mt-4">'+
                 '<button type="button" class="btn btn-primary bg-gradient-primary confirmU">'+btn.data('title')+'</button>'+
               '</div>'+
             '</form>';
             this.$content.find('#contentDialog').append(HtmlContent);
             // if is edit set values
             if(action == 'update'){
               this.$content.find('#contentDialog input[name="prov"]').val(parent.data('prov'));
               this.$content.find('#contentDialog input[name="tel"]').val(parent.data('telefono'));
               this.$content.find('#contentDialog input[name="email"]').val(parent.data('email'));
             }
           }
         }
       });
    });
  });
</script>
@endsection
