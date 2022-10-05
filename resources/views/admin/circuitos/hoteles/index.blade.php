@extends('MasterAdmin')
@section('title', 'Users')
@section('description','Administrador')
@section('styles')
  <style>
    .jcomplete {
      z-index: 999999999999;
      position: absolute;
      right: 10px;
      left: 10px;
      text-align: left;
    }.jcomplete .item-destino {cursor: pointer;}
</style>
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3 d-flex">
                        <h6 class="text-white text-capitalize ps-3 col-8">Hoteles de Circuitos</h6>
                        <div class="col-4">
                            <button type="button" class="btn btn-outline-light btn-sm actionHo" data-action="create"
                                data-title="Agregar">Agregar</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @include('admin.circuitos.hoteles.search')
                    @include('admin.circuitos.hoteles.table')
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
    // configurate header token for all request
    $.ajaxSetup({
       headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
     });
    // click action
    $('body').on('click', '.actionHo', function(event)
    {
      event.preventDefault();
      let btn = $(this);
      let parent = btn.parents('tr');
      let title = btn.data('title')+' Hotel';
      let action = btn.data('action');
      let JDialog = $.dialog({
         title: title,
         icon: 'fa fa-bed',
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
                 arraydata['destinoid'] = $('#destino').data('id');

                 // call ajax
                 $.ajax({
                   url: path+'/circuitos/hoteles/action',
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
             //
             this.$content.find('#destino').keyup(function(event) {
               /* Act on the event */
               let q = $(this).val(); let array = "";
               let parent = $(this).parents('.form-group');
               if (q.length >=3) {
                 $.ajax({
                     url:"{{ route('search') }}",
                     dataType: "json",
                     type:'post',
                     data:{q:q},
                     success: function( data ) {
                        $.each(data, function() {
                          array+='<li class="list-group-item item-destino" data-id="'+this.idDestino+'">'+this.destino+'</li>';
                        });
                        // append div parent
                        parent.find('.jcomplete').empty();
                        parent.find('.jcomplete').append('<ul class="list-group">'+array+'</ul>');
                      }
                 })
               }
               else{
                parent.find('.jcomplete').empty();
               }
             });
             /// item
             this.$content.find('.jcomplete').on('click', '.item-destino', function(event) {
               event.preventDefault();
               /* Act on the event */
               let parent = $(this).parents('.jcomplete');
               jc.$content.find('#destino').val($(this).text());
               jc.$content.find('#destino').data('id',$(this).data('id'));
               parent.empty();
             });
         },
         onOpenBefore: function ()
         {
             if (action == 'delete') {
               let HtmlContent = '<div class="col-12"><p>¿Esta seguro que desea eliminar este hotel?</p></div>'+
               '<form action="" class="col-12"><button type="button" class="btn btn-primary bg-gradient-primary">Si,eliminar</button></form>';
               this.$content.find('#contentDialog').append(HtmlContent);
             }
             else{
               let HtmlContent =
               '<form action="validar" class="formName was-validated" autocomplete="off" novalidate>' +
                '<div class="form-group">' +
                     '<label for="agencia" class="form-label">Categoria</label>'+
                     '<select class="form-select array" name="cat" aria-label="Default select example" required>'+
                        '<option selected value="0" disabled selected>Seleccione categoria...</option>'+
                        '@foreach ( $categorias as $categorias )'+
                          '<option value="{{ $categorias->id }}">{{$categorias->categoria }}</option>' +
                        '@endforeach'+
                      '</select>' +
                 '</div>'+
                 '<div class="form-group">' +
                     '<label for="agencia" class="form-label">Destino</label>'+
                       '<input type="text" id="destino" class="form-control array" name="dest" required>'+
                       '<div class="jcomplete"></div>'+
                       '<div class="invalid-feedback"> Ingrese destino </div>'+
                 '</div>'+
                 '<div class="form-group">' +
                   '<label for="social" class="form-label">Hotel</label>'+
                   '<input type="text" class="form-control array" name="hotel" required>'+
                   '<div class="invalid-feedback"> Ingrese hotel</div>'+
                 '</div>'+
                 '<div class="form-group mt-4">'+
                   '<button type="button" class="btn btn-primary bg-gradient-primary confirmU">'+btn.data('title')+'</button>'+
                 '</div>'+
                 '</form>';
                   this.$content.find('#contentDialog').append(HtmlContent);
                 // if is edit set values
                   if(action == 'update')
                   {
                       this.$content.find('#contentDialog select[name="cat"]').val(parent.data('catid'));
                       this.$content.find('#contentDialog input[name="dest"]').val(parent.data('destino'));
                       this.$content.find('#contentDialog input[name="dest"]').data("id",parent.data('destinid'));
                       this.$content.find('#contentDialog input[name="hotel"]').val(parent.data('hotel'));
                   }
               }
         }
       });
    });
  });
</script>
@endsection
