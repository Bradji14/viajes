@extends('MasterAdmin')
@section('title', 'Users')
@section('description','Administrador')
@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

<link rel="stylesheet" href="../css/style.css">
<link href="https://code.jquery.com/ui/1.12.1/themes/ui-lightness/jquery-ui.css" rel="stylesheet" />
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3 d-flex">
                        <h6 class="text-white text-capitalize ps-3 col-8">Estados</h6>
                        <div class="col-4">
                            <button type="button" class="btn btn-outline-light btn-sm actionEs" data-action="create"
                                data-title="Agregar">Agregar</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @include('admin.destinos.estados.search')
                    @include('admin.destinos.estados.table')
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('scripts')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


<script>
    let path = $('#root').data('path');
 // configurate header token for all request
 $.ajaxSetup({
    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
  });
 // click action
 $('body').on('click', '.actionEs', function(event)
 {
   event.preventDefault();
   let btn = $(this);
   let parent = btn.parents('tr');
   let title = btn.data('title')+' Estado';
   let action = btn.data('action');
   let JDialog = $.dialog({
      title: title,
      icon: 'fa fa-plane',
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
              arraydata['paisid'] = $('#pais').data('id');
              // call ajax
              $.ajax({
                url: path+'/destinos/estados/action',
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
            let HtmlContent = '<div class="col-12"><p>¿Esta seguro que desea eliminar este estado?</p></div>'+
            '<form action="" class="col-12"><button type="button" class="btn btn-primary bg-gradient-primary">Si,eliminar</button></form>';
            this.$content.find('#contentDialog').append(HtmlContent);
          }
          else{
            let HtmlContent =
            '<form action="validar" class="formName was-validated" autocomplete="off" novalidate>' +
              '<div class="form-group">' +
                  '<label for="agencia" class="form-label">País</label>'+//autocomplet
                '<input type="text" id="pais" class="form-control array" name="pais" required>'+
                '<div class="invalid-feedback"> Ingrese Pais </div>'+
              '</div>'+

              '<div class="form-group">' +
                  '<label for="agencia" class="form-label">Estado </label>'+
                      '<input type="text" class="form-control array" name="estado" minlength="4" required>'+
                         '<div class="invalid-feedback"> Ingrese Estado </div>'+
                  '<div id="products_list">'+
                  '</div>'+
              '</div>'+
              '<div class="form-group mt-4">'+
                '<button type="button" class="btn btn-primary bg-gradient-primary confirmU">'+btn.data('title')+'</button>'+
              '</div>'+
              '</form>';

              $(document).ready(function(){
                aData={};
                $("#pais").autocomplete({
                    source: function(req,res){
                        $.ajax({
                            url:"{{ route('searchp') }}",
                            type:"GET",
                            data:'json',
                            success: function(data){
                                // console.log(data);
                                aData=$.map(data,function(val,key){
                                    return {
                                        id:val.id,
                                        label:val.pais
                                    };
                                });
                                // console.log(aData);
                                var results = $.ui.autocomplete.filter(aData,req.term);
                                res(results);

                            }
                        })
                    },
                    select:function(event,ui){
                            $('#pais').data("id",ui.item.id);
                    }
                })

              });+
                this.$content.find('#contentDialog').append(HtmlContent);
              // if is edit set values
                if(action == 'update')
                {
                    this.$content.find('#contentDialog input[name="pais"]').val(parent.data('pais'));
                    this.$content.find('#contentDialog input[name="pais"]').data("id",parent.data('paid'));
                    this.$content.find('#contentDialog input[name="estado"]').val(parent.data('estado'));
                }
            }
      }
    });
 });

</script>

@endsection

{{-- $('.snowy1').click(function()
                                {
                                    $('.alert').addClass("show");
                                    $('.alert').removeClass("hide");
                                    $('.alert').addClass("showAlert");
                                    setTimeout(function(){
                                        $('.alert').removeClass("show");
                                        $('.alert').addClass("hide");
                                    },5000);
                                    });
                                    $('.close-btn').click(function(){
                                    $('.alert').removeClass("show");
                                    $('.alert').addClass("hide");
                                }); --}}
