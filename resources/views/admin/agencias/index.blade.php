@extends('MasterAdmin')
@section('title', 'Users')
@section('description','Administrador')
@section('styles')
<link href="https://code.jquery.com/ui/1.12.1/themes/ui-lightness/jquery-ui.css" rel="stylesheet"/>
@endsection
@section('content')
  <div class="container">
      <div class="row justify-content-center">
          <div class="col-md-12">
              <div class="card">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                  <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3 d-flex">
                    <h6 class="text-white text-capitalize ps-3 col-8">Agencias</h6>
                    <div class="col-4">
                      <button type="button" class="btn btn-outline-light btn-sm action" data-action="create" data-title="Agregar">Agregar</button>
                    </div>
                  </div>
                </div>
                  <div class="card-body">
                    @include('admin.agencias.search')
                    @include('admin.agencias.table')
                  </div>
              </div>
          </div>
      </div>
  </div>
@endsection
@section('scripts')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
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
      let btn = $(this);
      let parent = btn.parents('tr');
      let title = btn.data('title')+' usuario';
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
                   url: path+'/agencias/action',
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
         onOpenBefore: function ()
         {
             if (action == 'delete') {
               let HtmlContent = '<div class="col-12"><p>¿Esta seguro que desea eliminar esta agencia?</p></div>'+
               '<form action="" class="col-12"><button type="button" class="btn btn-primary bg-gradient-primary">Si,eliminar</button></form>';
               this.$content.find('#contentDialog').append(HtmlContent);
             }
             else{
               let HtmlContent =
               '<form action="validar" class="formName was-validated" autocomplete="off" novalidate>' +
                 '<div class="form-group">' +
                     '<label for="agencia" class="form-label">Agencia</label>'+
                   '<input type="text" class="form-control array" name="agencia" required>'+
                   '<div class="invalid-feedback"> Ingrese agencia </div>'+
                 '</div>'+
                 '<div class="form-group">' +
                     '<label for="agencia" class="form-label">Destino</label>'+
                         '<input type="text" id="dest" class="form-control array" name="destinos" required>'+
                            '<div class="invalid-feedback"> Ingrese id de destino </div>'+
                     '<div id="products_list">'+
                     '</div>'+
                 '</div>'+
                 '<div class="form-group">' +
                   '<label for="social" class="form-label">Razon social</label>'+
                   '<input type="text" class="form-control array" name="social" required>'+
                   '<div class="invalid-feedback"> Ingrese razon social</div>'+
                 '</div>'+
                 '<div class="form-group">' +
                   '<label for="rfc" class="form-label">RFC</label>'+
                   '<input type="text" class="form-control array" name="rfc" required maxlength=15>'+
                   '<div class="invalid-feedback"> Ingrese RFC</div>'+
                 '</div>'+
                '<div class="form-group">' +
                   '<label for="phone" class="form-label">Telefono</label>'+
                   '<input type="number" class="form-control array" name="phone" required maxlength=11>'+
                   '<div class="invalid-feedback"> Ingrese Telefono</div>'+
                 '</div>'+
                 '<div class="form-group">' +
                   '<label for="web" class="form-label">Web</label>'+
                   '<input type="text" class="form-control array" name="web" required>'+
                   '<div class="invalid-feedback"> Ingrese sitio web</div>'+
                 '</div>'+
                 '<div class="form-group">' +
                   '<label for="email" class="form-label">Email</label>'+
                   '<input type="email" class="form-control array" name="email" required>'+
                   '<div class="invalid-feedback"> Ingrese e-mail</div>'+
                 '</div>'+
                 '<div class="form-group">' +
                   '<label for="direc" class="form-label">Direccion</label>'+
                   '<input type="text" class="form-control array" name="direc" required>'+
                   '<div class="invalid-feedback"> Ingrese direccion</div>'+
                 '</div>'+
                 '<div class="form-group mt-4">'+
                   '<button type="button" class="btn btn-primary bg-gradient-primary confirmU">'+btn.data('title')+'</button>'+
                 '</div>'+
               '</form>';
               this.$content.find('#contentDialog').append(HtmlContent);
               // if is edit set values
               if(action == 'update'){
                 this.$content.find('#contentDialog input[name="agencia"]').val(parent.data('agencia'));
                 this.$content.find('#contentDialog input[name="social"]').val(parent.data('razon'));
                 this.$content.find('#contentDialog input[name="rfc"]').val(parent.data('rfc'));
                 this.$content.find('#contentDialog input[name="destinos"]').val('1');
                 this.$content.find('#contentDialog input[name="phone"]').val(parent.data('telefono'));
                 this.$content.find('#contentDialog input[name="web"]').val(parent.data('web'));
                 this.$content.find('#contentDialog input[name="email"]').val(parent.data('email'));
                 this.$content.find('#contentDialog input[name="direc"]').val(parent.data('direc'));
             }
             }
         }
       });
    });
    // #
    $('body').on('click', '.usuarios', function(event)
    {
      event.preventDefault();
      let btn = $(this);
      let trPadre = btn.parents('tr');
      let AgenciaID = trPadre.data('key');
      let title = trPadre.data('agencia')+' | Usuarios registrados ';
      let JDialog = $.dialog({
         title: title,
         icon: 'fa fa-user-o',
         theme: 'material',
         type:'dark',
         columnClass:"col-md-10",
         content:
           '<div class="container-fluid mt-4">'+
             '<div class="row mb-3" id="UserForm">'+
               '<div class="col-3"><input type="text" name="nombre" class="form-control array" placeholder="Nombre" requerided></div>'+
               '<div class="col-3"><input type="email" name="email" class="form-control array" placeholder="Email" requerided></div>'+
               '<div class="col-3"><input type="password" name="password" class="form-control array" placeholder="Contraseña" requerided></div>'+
               '<div class="col-3"><button type="button" class="btn btn-outline-dark btn-action" data-action="create">Crear</button></div>'+
             '</div>'+
             '<div class="row">'+
                 '<table class="table" id="AgenciaUsuarios">'+
                   '<thead>'+
                         '<tr>'+
                         '<th scope="col">#</th>'+
                         '<th scope="col">Nombre</th>'+
                         '<th scope="col">Email</th>'+
                         '<th scope="col">Operaciones</th>'+
                         '</tr>'+
                   '</thead>'+
                   '<tbody></tbody>'+
                 '</table>'+
             '</div>'+
             '<div class="row mt-3" id="UserAlerts"></div>'+
           '</div>',
         onContentReady: function ()
         {
           var jc = this;
           let tableContent = jc.$content.find('#AgenciaUsuarios > tbody');
           let UserDiv = jc.$content.find('#UserAlerts');
           let UserBtn = jc.$content.find('.btn-action');
           let userForm = jc.$content.find('#UserForm');//189
           // function
           function AjaxUsers(action,array,AgenciaID){
             // ajax
             $.ajax({
               url: path+'/agencias/users/action',
               type: 'POST',
               dataType: 'json',
               data: {array:array,action:action,AgenciaID}
             })
             .done(function(data) {
               if (data.tipo == 200) {
                 // if is read then render html table
                 if(action == "read"){
                   let HtmlBody = '';
                   // each data
                   $.each(data.data.users, function(index, el) {
                     HtmlBody += '<tr data-key="'+el.id+'" data-name="'+el.name+'" data-email="'+el.email+'">'+
                       '<td>'+(index+1)+'</td>'+
                       '<td>'+el.name+'</td>'+
                       '<td>'+el.email+'</td>'+
                       '<td>'+
                         '<div class="btn-group btn-group-sm" role="group" aria-label="button group">'+
                           '<button type="button" class="btn btn-outline-dark actionU" data-action="edit"><i class="fas fa-cloud-upload-alt"></i> Editar</button>'+
                           '<button type="button" class="btn btn-outline-dark actionU" data-action="delete"><i class="fas fa-user-times"></i> Eliminar</button>'+
                       '</div>'+
                       '</td>'+
                     '</tr>';
                   });
                   // append html to table
                   tableContent.empty();
                   tableContent.append(HtmlBody);
                 }else{// else case {cread,update,delete} we need to call read method
                   let alertHtml = '<div class="alert alert-success alert-dismissible fade show" role="alert">'+
                     '<strong>'+data.title+'</strong>'+
                     '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>'+
                   '</div>';
                   UserDiv.empty();
                   UserDiv.append(alertHtml)
                 }
               }
             })
             .fail(function() {
               console.log("error");
             })
             .always(function() {
               console.log("complete");
             });
           }
           AjaxUsers('read',null,AgenciaID);
           // on click user button action
           UserBtn.click(function(event) {
             /* Act on the event */
             let btn = $(this);
             let divParent = btn.parents('#UserForm');
             let error=0; let arraydata= {};
             let action = btn.data('action');
             divParent.find('.array').map(function () {
               if ($(this).val()=="" && $(this).prop('required')){ error++;}
               else{ arraydata[$(this).attr("name")] = $(this).val();}
             }).get();
             if(error==0){btn.html('procesando...');}
             //
             if(action == 'create'){btn.data('key',AgenciaID);}
             // call ajax
             AjaxUsers(btn.data('action'),arraydata,btn.data('key'));
           });
           // table button action
           tableContent.on('click', '.actionU', function(event) {
             event.preventDefault();
             /* Act on the event */
             let btn = $(this);
             let trPadre = btn.parents('tr');
             // if action is edit then we need to show up the data
             if(btn.data('action') == "edit"){
               // change the user btn action and html
               userForm.find('input[name="nombre"]').val(trPadre.data('name'));
               userForm.find('input[name="email"]').val(trPadre.data('email'));
               userForm.find('input[name="password"]').val(12345678);
               UserBtn.html('Guardar cambios');
               UserBtn.data('action','update');
               UserBtn.data('key',trPadre.data('key'));
             }else{// else send the id to the user btn
               UserBtn.data('action','delete');
               UserBtn.data('key',trPadre.data('key'));
               AjaxUsers('delete',null,UserBtn.data('key'));
             }
           });
         }
       });
   });
  });
</script>
@endsection
