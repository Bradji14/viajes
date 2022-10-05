@extends('MasterAdmin')
@section('title', 'Users')
@section('description','Administrador')
@section('styles')
<link rel="stylesheet" href="http://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3 d-flex">
                        <h6 class="text-white text-capitalize ps-3 col-8">Categoria de Servicios</h6>
                        <div class="col-4">
                            <button type="button" class="btn btn-outline-light btn-sm actionHoC" data-action="create"
                                data-title="Agregar">Agregar</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @include('admin.circuitos.hoteles.hotelesCategorias.search')
                    @include('admin.circuitos.hoteles.hotelesCategorias.table')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js" defer></script>
<script>
  document.addEventListener('DOMContentLoaded', function(event) {
    let path = $('#root').data('path');
    // configurate header token for all request
    $.ajaxSetup({
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
    });
    // click action
   $('body').on('click', '.actionHoC', function(event)
   {
     event.preventDefault();
     let btn = $(this);
     let parent = btn.parents('tr');
     let title = btn.data('title')+' Categoria';
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
                // call ajax
                $.ajax({
                  url: path+'/circuitos/servicios/action',
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
              let HtmlContent = '<div class="col-12"><p>¿Esta seguro que desea eliminar este hotel?</p></div>'+
              '<form action="" class="col-12"><button type="button" class="btn btn-primary bg-gradient-primary">Si,eliminar</button></form>';
              this.$content.find('#contentDialog').append(HtmlContent);
            }
            else{
              let HtmlContent =
              '<form action="validar" class="formName was-validated" autocomplete="off" novalidate>' +

                  '<div class="form-group">' +
                      '<label for="agencia" class="form-label">Categoria</label>'+
                      '<input type="text" class="form-control array" name="cat" required minlength="4">'+
                      '<div class="invalid-feedback"> Ingrese la categoria </div>'+
                  '</div>'+

                '<div class="form-group mt-4">'+
                  '<button type="button" class="btn btn-primary bg-gradient-primary confirmU">'+btn.data('title')+'</button>'+
                '</div>'+
                '</form>';

                  this.$content.find('#contentDialog').append(HtmlContent);
                // if is edit set values
                  if(action == 'update')
                  {
                      // $(document).ready(function(){

                      //         $('#destID').val(parent.data('destino'));

                      //         $('#destID').css('display', 'block');
                      // })
                      this.$content.find('#contentDialog input[name="cat"]').val(parent.data('cate'));

                  }
              }
        }
      });
   });
  });
</script>
@endsection
