@extends('MasterAdmin')
@section('title', 'Circuitos')
@section('description','Administrador')
@section('styles')
<link href="https://code.jquery.com/ui/1.12.1/themes/ui-lightness/jquery-ui.css" rel="preload" as="style" onload="this.onload=null;this.rel='stylesheet'"/>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@400;600&display=swap" rel="preload" as="style" onload="this.onload=null;this.rel='stylesheet'">
<link rel="preload" href="{{asset('plugins/summernote/summernote-lite.min.css')}}" as="style" onload="this.onload=null;this.rel='stylesheet'">
<link rel="preload" href="{{asset('plugins/summernote/summernote-bs5.min.css')}}" as="style" onload="this.onload=null;this.rel='stylesheet'">
<link rel="preload" href="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone.css" as="style" onload="this.onload=null;this.rel='stylesheet'"/>
<style>
  .table-design > thead > tr, .table-design > thead, .table-design > thead > tr > th{
    background-color: transparent;
    color: #49494e;
    text-align: left;
    padding: 16px 10px;
  }
  .table-design tr.active {
    background-color: #0366ac24;
    border-left: solid 2px #0462a7;
  }
  .table .dropdown-toggle > i {
    font-size: 14px;
  }
  .table .dropdown-toggle {
    border: none;
    border-bottom: solid;
    border-right: solid;
    border-radius: 3px;
    border-width: 1px;
    border-color: #5c5858;
  }
  .table > tbody > tr > td {
    font-family: 'Source Sans Pro';
    font-size: 15px;
  }
  /* input style form */
  .input-gp {
    position: relative;
  }
  .input-gp > input, .input-gp > select, .input-gp > button {
      border: none !important;
      border-bottom: solid 1px #cdcdcd !important;
      border-radius: 0;
      padding-left: 32px;
  }
  .input-gp > input:focus, .input-gp > select:focus {
      box-shadow: 0px 2px 0px 0px rgb(2 82 136 / 50%) !important;
      border: none;
      border-bottom: solid 2px #02528880 !important;
  }
  .input-gp > span {
      position: absolute;
      bottom: 6px;
      left: 15px;
      color: #727272;
  }
  .input-gp input[type="file"] {padding-left: 12px;}
  .jconfirm label {
    font-family: 'Source Sans Pro', sans-serif;
    color: #202020;
    font-size: 13px;
    font-weight: 600;
    line-height: 27px;
    letter-spacing: 1px;
    text-decoration: underline 2px #f3f300;
  }
  .jconfirm .note-editable {
    font-size: 14px;
    font-family: 'Source Sans Pro';
  }
  .jconfirm input, .jconfirm select {
      color: #3a3a3a;
      font-size: 16px;
      font-family: 'Source Sans Pro';
      letter-spacing: 1px;
  }
  .jconfirm-content-pane > .jcloading {
    content: '';
    top: 0;
    left: 0;
    bottom: 0;
    right: 0;
    position: absolute;
    background: #fff;
    background-image: url('{{asset('/loader/content-loader.gif')}}');
    background-repeat: no-repeat;
    background-position: center center;
    z-index: 1;
  }.jconfirm-content-pane{max-height: 586.56px;}
  .jconfirm .nav-link {color: #6c6c6c;}
  /*tiger alert */
  .tiger-overlay {
    position: fixed;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    text-align: center;
    font-size: 0;
    overflow-y: auto;
    background-color: rgb(0 0 0 / 40%);
    z-index: 999999999999;
    pointer-events: none;
    opacity: 0;
    transition: opacity .3s;
  }

  .tiger-overlay--show-modal {
      opacity: 1;
      pointer-events: auto;
  }
  .tiger-alert {
    position: fixed;
    right: 10px;
    top: 10px;
    background: #fff;
    min-width: 220px;
    text-align: center;
    border: 2px solid transparent;
    border-radius: 7px;
    padding: 10px 15px;
    background-image: linear-gradient(white, white), linear-gradient(180deg, #00bbf3, #3f3f3f30 50%, #00bbf3);
    background-repeat: no-repeat;
    background-size: 100% 100%, 100% 200%;
    background-position: 0 0, 0 100%;
    background-origin: padding-box, border-box;
    animation: highlight 1s infinite alternate;
    z-index: 999999999999;
  }
  .tiger-alert > content {
      font-size: 15px;
      font-family: Source Sans Pro;
  }
  .tiger-alert > icon {
    position: absolute;
    left: 0;
    margin-left: 9px;
    color: #1371e7;
  }
  .items span{
    background: red;
    color: #fff;
    cursor: pointer;
    font-size: 10px;
    text-align: center;
    width: 14px;
    height: 18px;
    font-weight: bold;
    border-radius: 3px
  }

  @keyframes highlight {
      100% {
        background-position: 0 0, 0 0;
      }
    }
    /* gallery */
    @media only screen and (min-width: 980px){
      .sidebar {
        padding: 2rem 1rem;
        padding-left: 5rem;
      }
    }
</style>
@endsection
@section('content')
  <div class="container">
      <div class="row justify-content-center">
          <div class="col-md-12">
              <div class="card">
                <!-- header card -->
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                  <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3 d-flex">
                    <h4 class="text-white text-capitalize ps-3 col-10"><i class="fas fa-passport"></i> Circuitos</h4>
                    <div class="col-2">
                      <button type="button" class="btn btn-outline-light JdCircuitos" data-title="Crear" data-action="create"><i class="fas fa-plus-circle"></i> Crear</button>
                    </div>
                  </div>
                </div>
                  <div class="card-body">
                    <!-- search -->
                    <div class="row">
                      <div role="search">
                        <div class="input-group input-group-outline">
                          <label class="form-label">Type here...</label>
                          <input type="text" class="form-control" onfocus="focused(this)" onfocusout="defocused(this)" id="q">
                        </div>
                      </div>
                    </div>
                    <!-- filters // limit -->
                    <div class="row mt-3 justify-content-end">
                      <div class="col-1 pag">
                        <i class="far fa-file-alt"></i>
                        <select class="form-select form-select-sm" id="limit">
                          <option value="25" selected="">25</option>
                          <option value="50">50</option>
                          <option value="100">100</option>
                          <option value="200">200</option>
                        </select>
                      </div>
                    </div>
                    <!-- table -->
                    <div class="row mt-2">
                      <div class="table-responsive">
                        <table class="table table-design" id="CircuitosTbl">
                          <thead>
                            <tr>
                              <th scope="col">Clave</th>
                              <th scope="col">Circuito</th>
                              <th scope="col">Proveedor</th>
                              <th scope="col">Etiqueta</th>
                              <th scope="col">Salida</th>
                              <th scope="col">Operación</th>
                            </tr>
                          </thead>
                          <tbody></tbody>
                        </table>
                      </div>
                    </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
@endsection
@section('scripts')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js" defer></script>
<script src="{{asset('plugins/summernote/summernote-lite.min.js')}}" defer></script>
<script src="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone-min.js" defer></script>
<script>
  document.addEventListener('DOMContentLoaded', function(event) {
    let path = $('#root').data('path'); let CircuitosTbl = $('#CircuitosTbl > tbody');
    let search = $('#q'), selectLt = $('#limit'),query="",limit=25, file ="", flagAplicar = false;
    // php encode
    let proveedores = <?php echo json_encode($proveedores); ?>;
    let comision = <?php echo json_encode($comision); ?>;
    let tag = <?php echo json_encode($tag); ?>;
    let ProvItems = "", ComItems = "", TagItems = "";
    $.each( proveedores, function( i, e ) {ProvItems+='<option value="'+e.id+'">'+e.proveedor+'</option>';});
    $.each( comision, function( i, e ) {ComItems+='<option value="'+e.id+'">'+e.comision+'</option>';});
    $.each( tag, function( i, e ) {TagItems+='<option value="'+e.id+'">'+e.tag+'</option>';});
    // configurate header token for all request
    $.ajaxSetup({
       headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
     });
     // function ajax Circuitos
     function CircuitosCRUD(action,arraydata,id,q,limit){
       //encap
       let FormC = new FormData(); let datos = {};
       datos['action'] = action; datos['arraydata'] = arraydata;
       datos['id'] = id; datos['q'] = q; datos['limit'] = limit;
       //formData.append("datos",JSON.stringify(datos)); {action: action,arraydata:arraydata,id:id,q:q,limit:limit}
       FormC.append("file", file);
       FormC.append("datos",JSON.stringify(datos));
       $.ajax({
         url: path+'/circuitos/actionCT',
         type: 'POST',
         dataType: 'json',
         data: FormC,
         contentType: false,
         processData: false,
       })
       .done(function(data) {
         //
         switch (action) {
           case 'read':
             let TblHtml, TipoSalida;
             let options ='<div class="dropdup">'+
               '<button class="btn btn-outline-dark btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">'+
                 '<i class="fas fa-angle-right"></i> Opciones'+
               '</button>'+
               '<ul class="dropdown-menu" style="cursor: pointer;">'+
                 '<li><a class="dropdown-item JdCircuitos" data-title="Editar" data-action="view" title="Editar circuito"><i class="far fa-edit"></i> <span>Editar</span></a></li>'+
                 '<li><a class="dropdown-item JdItinerario"><i class="fas fa-list-ul"></i> <span>Itinerario</span></a></li>'+
                 '<li><a class="dropdown-item JdGaleria"><i class="far fa-images"></i> <span>Galeria</span></a></li>'+
                 '<li><a class="dropdown-item JdHoteles" data-title="Editar"><i class="fas fa-bed"></i> <span>Hoteles</span></a></li>'+
                 '<li><a class="dropdown-item JdSalidas"><i class="far fa-calendar-alt"></i> <span>Salidas</span></a></li>'+
                 '<li><a class="dropdown-item JdTarifas"><i class="far fa-money-bill-alt"></i> <span>Tarifas</span></a></li>'+
               '</ul>'+
             '</div>';
             $.each(data.circuitos, function(index, el) {
               if(el.tipo==1){TipoSalida='Grupal';}else{TipoSalida='Individual';}
               TblHtml+='<tr data-key="'+el.id+'" data-circuito="'+el.circuito+'">'+
                 '<td>'+el.clave+'</td>'+
                 '<td>'+el.circuito+'</td>'+
                 '<td>'+el.proveedor+'</td>'+
                 '<td>'+el.tag+'</td>'+
                 '<td>'+TipoSalida+'</td>'+
                 '<td>'+options+'</td>'+
               '</tr>';
             });
             CircuitosTbl.empty();
             CircuitosTbl.append(TblHtml);
             break;
           case 'view':
              let Jdialog = $('body').find('#contentDialog');
              // set
              Jdialog.find('#circuito').val(data.data.circuito);
              Jdialog.find('#tipo').val(data.data.tipo);
              Jdialog.find('#dias').val(data.data.dias);
              Jdialog.find('#noches').val(data.data.noches);
              /*second row */
              Jdialog.find('#proveedor').val(data.data.ProveedorID);
              Jdialog.find('#comision').val(data.data.ComisionID);
              Jdialog.find('#tag').val(data.data.TagID);
              Jdialog.find('#vigencia').val(data.data.vigencia);
              /*third */
              Jdialog.find('#visitando').val(data.data.visitando);
              /* four row */
              Jdialog.find('#incluye').val(data.data.incluye);
              Jdialog.find('#noincluye').val(data.data.no_incluye);
              /*five */
              Jdialog.find('#infosuplemento').val(data.data.info_suplemento);
              Jdialog.find('#infosalidas').val(data.data.info_salidas);
              /* image */
              Jdialog.find('#viewImage').prop('disabled',false);
              Jdialog.find('#viewImage').data('src',data.data.src);
              /* action update */
              Jdialog.find('#SubmitForm').data('action','update');
              $('textarea').summernote({height: 400,disableResizeEditor: true,
                callbacks: {
                  onPaste: function (e) {
                      var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');

                      e.preventDefault();

                      // Firefox fix
                      setTimeout(function () {
                          document.execCommand('insertText', false, bufferText);
                      }, 10);
                  }
              }});
              jsloading('hide');
              break;
           case 'update':
              flagAplicar = false;
              TigerAlert('Datos actualizados correctamente','close');
              CircuitosCRUD('read',null,null,query,limit)
              break;
          case 'create':
             flagAplicar = false;
             TigerAlert('Datos cargados correctamente','close');
             CircuitosCRUD('read',null,null,query,limit)
             break;
         }
       })
       .fail(function() {
         console.log("error");
       })
       .always(function() {
         console.log("complete");
       });

     }
     // call
     CircuitosCRUD('read',null,null,'',limit);
     // fucntion ajax Itinerario
     function Itinerario(action,arraydata,id){
       $.ajax({
         url: path+'/circuitos/itinerario',
         type: 'POST',
         dataType: 'json',
         data: {action: action,arraydata:arraydata, id:id}
       })
       .done(function(data) {
         switch (action) {
           case 'read':
              let Jdialog = $('body').find('#contentItinerario');
              if (data.itinerario !== null) {
                Jdialog.find('#SubmitForm').data('action','update');
                Jdialog.find('#SubmitForm').data('key',data.itinerario.id);
                Jdialog.find('#itinerario').val(data.itinerario.content);
              }else{
                Jdialog.find('#SubmitForm').data('action','create');
                TigerAlert('Favor de cargar el itinerario',null);
              }
              $('textarea').summernote({height: 400,disableResizeEditor: true,
                callbacks: {
                  onPaste: function (e) {
                      var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');

                      e.preventDefault();

                      // Firefox fix
                      setTimeout(function () {
                          document.execCommand('insertText', false, bufferText);
                      }, 10);
                  }
              }});
              jsloading('hide');
              break;
           case 'update':
             flagAplicar = false;
             TigerAlert('Datos actualizados correctamente','close');
             break;
           case 'create':
              flagAplicar = false;
              TigerAlert('Datos cargados correctamente','close');
              break;
         }
       });

     }
     search.keyup(function(event) {
       /* Act on the event */
       let put = $(this).val(); query = put;
       if (put.length>3) {
         CircuitosCRUD('read',null,null,put,limit);
       }else if (put == "") {
         CircuitosCRUD('read',null,null,put,limit);
       }
     });
     // limit
     selectLt.change(function(event) {
       /* Act on the event */
       limit = $(this).val();
       CircuitosCRUD('read',null,null,query,limit)
     });

     function HotelRel(action,arraydata,id)
        {
            $.ajax({
                url:path+'/circuitos/hoteles',
                dataType: "json",
                type:'post',
                data: {arraydata:arraydata,action:action,id:id}
            })
            .done(function(data)
                {
                    let arrayRec = "";
                        switch (action)
                        {
                            case 'read':
                            $.each(data.relacion, function() {
                                arrayRec+='<li class="list-group-item d-flex justify-content-between items" data-id="'+this.id+'">'+this.hotel +', '+ this.destino + ', ' + '('+this.iataPais+')' +'<span class="spX"> X </span>'+'</li>';
                            });
                            $('#elements > ul').append(arrayRec);
                            break;

                            case 'create':
                            TigerAlert('Datos guardados correctamente');
                            break;

                            case 'delete':
                            TigerAlert('Datos eliminados correctamente');
                            break;
                        }
                })
                .fail(function() {
                    console.log("error");
                })
                .always(function() {
                    console.log("complete");
                });
        }

     // Dialog Circuitos
     $('body').on('click', '.JdCircuitos', function(event) {
       event.preventDefault();
       /* Act on the event */
       let btn = $(this);
       let title = btn.data('title')+' circuito';
       let action = btn.data('action');
       let key; flagAplicar=false;
       if (action == 'view') {
         let trpadre = btn.parents('tr');
         key = trpadre.data('key');
       }
       let JDialog = $.dialog({
          title: title,
          icon: 'fas fa-route',
          theme: 'bootstrap',
          type:'dark',
          columnClass: 'col-md-10 col-md-offset-10 col-xs-4 col-xs-offset-8',
          containerFluid: true, // this will add 'container-fluid' instead of 'container'
          content:
          '<div class="container-fluid mt-3" id="contentDialog">'+
            '<div class="row">'+
               '<div class="col-6 input-gp">'+
                 '<label for="circuito" class="form-label">Nombre del circuito</label>'+
                 '<span><i class="fas fa-heading"></i></span>'+
                 '<input type="text" class="form-control array" name="circuito" id="circuito" required>'+
               '</div>'+
               '<div class="col-2 input-gp">'+
                 '<label for="tipo" class="form-label">Tipo</label>'+
                 '<span><i class="fas fa-chevron-right"></i></span>'+
                 '<select id="tipo" name="tipo" class="form-select array">'+
                   '<option value="0">Individual</option>'+
                   '<option value="1">Grupal</option>'+
                 '</select>'+
               '</div>'+
               '<div class="col-2 input-gp">'+
                 '<label for="dias" class="form-label">Dias</label>'+
                 '<span><i class="far fa-sun"></i></span>'+
                 '<input type="text" class="form-control array" name="dias" id="dias" required>'+
               '</div>'+
               '<div class="col-2 input-gp">'+
                 '<label for="noches" class="form-label">Noches</label>'+
                 '<span><i class="far fa-moon"></i></span>'+
                 '<input type="text" class="form-control array" name="noches" id="noches" required>'+
               '</div>'+
            '</div>'+
            '<div class="row mt-4">'+
               '<div class="col-3 input-gp">'+
                 '<label for="proveedor" class="form-label">Proveedor</label>'+
                 '<span><i class="fas fa-suitcase"></i></span>'+
                 '<select id="proveedor" name="proveedor" class="form-select array" required></select>'+
               '</div>'+
               '<div class="col-3 input-gp">'+
                 '<label for="comision" class="form-label">Comisión</label>'+
                 '<span><i class="fas fa-dollar-sign"></i></span>'+
                 '<select id="comision" name="comision" class="form-select array" required></select>'+
               '</div>'+
               '<div class="col-3 input-gp">'+
                 '<label for="tag" class="form-label">Destino</label>'+
                 '<span><i class="fas fa-globe-americas"></i></span>'+
                 '<select id="tag" name="tag" class="form-select array" required></select>'+
               '</div>'+
               '<div class="col-3 input-gp">'+
                 '<label for="vigencia" class="form-label">Vigencia</label>'+
                 '<span><i class="far fa-calendar"></i></span>'+
                 '<input type="date" class="form-control array" name="vigencia" id="vigencia" required>'+
               '</div>'+
            '</div>'+
            '<div class="row mt-4">'+
              '<div class="col-4 input-gp">'+
                '<label for="featuredid" class="form-label">Imagen destacada</label>'+
                '<input class="form-control" type="file" name="featuredid" id="featuredid">'+
              '</div>'+
              '<div class="col-1 input-gp">'+
                '<label for="view" class="form-label">Visualizar</label>'+
                '<button type="button" class="btn col-12" id="viewImage" disabled><i class="far fa-image"></i></button>'+
              '</div>'+
              '<div class="col-7 input-gp">'+
                '<label for="visitando" class="form-label">Visitando</label>'+
                '<span><i class="far fa-map"></i></span>'+
                '<input type="text" class="form-control array" name="visitando" id="visitando" required>'+
              '</div>'+
            '</div>'+
            '<div class="row mt-4">'+
               '<div class="col-6 input-gp">'+
                 '<label for="incluye" class="form-label">Incluye</label>'+
                 '<textarea class="form-control array" name="incluye" id="incluye" required></textarea>'+
               '</div>'+
               '<div class="col-6 input-gp">'+
                 '<label for="noincluye" class="form-label">No incluye</label>'+
                 '<textarea class="form-control array" name="noincluye" id="noincluye" required></textarea>'+
               '</div>'+
            '</div>'+
            '<div class="row mt-4">'+
               '<div class="col-6 input-gp">'+
                 '<label for="infosuplemento" class="form-label">Suplemento</label>'+
                 '<textarea class="form-control array" name="infosuplemento" id="infosuplemento" required></textarea>'+
               '</div>'+
               '<div class="col-6 input-gp">'+
                 '<label for="infosalidas" class="form-label">Salidas</label>'+
                 '<textarea class="form-control array" name="infosalidas" id="infosalidas" required></textarea>'+
               '</div>'+
            '</div>'+
            '<div class="row justify-content-end mt-4">'+
              '<button type="button" class="btn bg-gradient-dark col-2" data-action="create" id="SubmitForm"><i class="fas fa-angle-right"></i> Guardar</button>'+
            '</div>'+
          '</div>',
          onContentReady: function () {
              // bind to events
              let jc = this;
              let Trform = this.$content.find('#contentDialog');
              Trform.on('click','#SubmitForm', function (e)
              {
                let btn = $(this);
                let error=0; let formData = new FormData(); let datos={};
                Trform.find('.array').each(function(index, el) {
                  if ($(this).val()=="" && $(this).prop('required')) {error++;}
                  else{datos[$(this).attr("name")] = $(this).val();}
                });
                if (error==0 && flagAplicar==false) {
                  let files = Trform.find('input[name="featuredid"]')[0].files;
          				file = files["0"];
                  flagAplicar=true;
                  CircuitosCRUD(btn.data('action'),datos,key,query,limit);
                }else{TigerAlert('Faltan campos por llenar, por favor verifique',null);}
              });
              // view image
              Trform.on('click', '#viewImage', function(event) {
                event.preventDefault();
                /* Act on the event */
                $.dialog({
                  title: '',
                  content: '<img src="'+path+'/upfiles'+$(this).data('src')+'">',
                  draggable: true,
                  dragWindowGap: 0, // number of px of distance
                });
              });
         },onOpenBefore: function () {
           jsloading('loading');
           let Trform = this.$content.find('#contentDialog');
           // fk relaciones
           Trform.find('#proveedor').append(ProvItems);
           Trform.find('#comision').append(ComItems);
           Trform.find('#tag').append(TagItems);
           //
           if(action !== 'view'){$('textarea').summernote({height: 400,disableResizeEditor: true,
             callbacks: {
               onPaste: function (e) {
                   var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');

                   e.preventDefault();

                   // Firefox fix
                   setTimeout(function () {
                       document.execCommand('insertText', false, bufferText);
                   }, 10);
               }
           }});jsloading('hide');}
           // visualizar datos
           if (action == 'view') {
             CircuitosCRUD(action,null,key,query,limit);
           }
         }
       });
     });

     // Dialog itinerario
     $('body').on('click', '.JdItinerario', function(event) {
       event.preventDefault();
       /* Act on the event */
       let btn = $(this);
       let trpadre = btn.parents('tr');
       let key = trpadre.data('key'); flagAplicar=false;
       // dialog
       let JDialog = $.dialog({
          title: 'Itinerario de '+trpadre.data('circuito'),
          icon: 'fas fa-list-ul',
          theme: 'bootstrap',
          type:'dark',
          columnClass: 'col-md-8 col-md-offset-8 col-xs-4 col-xs-offset-8',
          containerFluid: true, // this will add 'container-fluid' instead of 'container'
          content:
          '<div class="container-fluid mt-3" id="contentItinerario">'+
            '<div class="row">'+
              '<div class="col-12 input-gp">'+
                '<label for="itinerario" class="form-label">Contenido</label>'+
                '<textarea class="form-control array" name="itinerario" id="itinerario" required></textarea>'+
              '</div>'+
              '<div class="row justify-content-end mt-4">'+
                '<button type="button" class="btn bg-gradient-dark col-2" data-action="create" id="SubmitForm"><i class="fas fa-angle-right"></i> Guardar</button>'+
              '</div>'+
            '</div>'+
          '</div>',
          onContentReady: function () {
              // bind to events
              let jc = this;
              let Trform = this.$content.find('#contentItinerario');
              Trform.on('click','#SubmitForm', function (e)
              {
                let btn = $(this); let action = btn.data('action');
                let error=0; let datos={};
                Trform.find('.array').each(function(index, el) {
                  if ($(this).val()=="" && $(this).prop('required')) {error++;}
                  else{datos[$(this).attr("name")] = $(this).val();}
                });
                if (error==0 && flagAplicar==false) {
                  flagAplicar=true;
                  if(action == 'update'){key = btn.data('key');}
                  Itinerario(action,datos,key);
                }else{TigerAlert('Faltan campos por llenar, por favor verifique',null);}
              });

         },onOpenBefore: function () {
           // call
           jsloading('loading');
           Itinerario('read',null,key);
           if(btn.data('action') == 'create'){
             /* textarea */
             $('textarea').summernote({height: 400,disableResizeEditor: true,
               callbacks: {
                 onPaste: function (e) {
                     var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');

                     e.preventDefault();

                     // Firefox fix
                     setTimeout(function () {
                         document.execCommand('insertText', false, bufferText);
                     }, 10);
                 }
             }});jsloading('hide');
           }
         }
       });

     });
     // galeria
     $('body').on('click', '.JdGaleria', function(event) {
       event.preventDefault();
       /* Act on the event */
       let btn = $(this);
       let trpadre = btn.parents('tr');
       let key = trpadre.data('key');
       // dialog
       let JDialog = $.dialog({
          title: 'Galeria de '+trpadre.data('circuito'),
          icon: 'far fa-images',
          theme: 'bootstrap',
          type:'dark',
          columnClass: 'col-md-12 col-md-offset-12 col-xs-4 col-xs-offset-4',
          containerFluid: true,
          content:
            '<div class="container-fluid mt-3" id="contentItinerario">'+
            '<ul class="nav nav-tabs" id="myTab" role="tablist">'+
              '<li class="nav-item" role="presentation">'+
                '<button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab"><i class="fas fa-upload"></i></button>'+
              '</li>'+
              '<li class="nav-item" role="presentation">'+
                '<button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab"><i class="far fa-images"></i></button>'+
              '</li>'+
            '</ul>'+
            '<div class="tab-content" id="myTabContent">'+
              '<div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">'+
                '<form action="/target" class="dropzone" id="my-great-dropzone">'+
                  '<input type="hidden" name="_token" value="{{ csrf_token() }}">'+
                '</form>'+
              '</div>'+
              '<div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">'+
                '<div class="row">'+
                  '<div class="col-8">'+
                  '</div>'+
                  '<div class="col-4 sidebar bg-light">'+
                    '<div class="mb-3">'+
                      '<label for="exampleInputEmail1" class="form-label">Email address</label>'+
                      '<input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">'+
                    '</div>'+
                    '<div class="mb-3">'+
                      '<label for="exampleInputPassword1" class="form-label">Password</label>'+
                      '<input type="text" class="form-control" id="exampleInputPassword1">'+
                    '</div>'+
                    '<div class="mb-3">'+
                      '<label for="exampleInputPassword1" class="form-label">Password</label>'+
                      '<input type="text" class="form-control" id="exampleInputPassword1">'+
                    '</div>'+
                  '</div>'+
                '</div>'+
              '</div>'+
            '</div>'+
            '</div>',
          onContentReady: function () {
              // bind to events
              let jc = this;
              let Trform = this.$content.find('#contentItinerario');
              Trform.on('click','#SubmitForm', function (e)
              {
                let btn = $(this); let action = btn.data('action');
                let error=0; let datos={};
                Trform.find('.array').each(function(index, el) {
                  if ($(this).val()=="" && $(this).prop('required')) {error++;}
                  else{datos[$(this).attr("name")] = $(this).val();}
                });
                if (error==0 && flagAplicar==false) {
                  flagAplicar=true;
                  if(action == 'update'){key = btn.data('key');}
                  Itinerario(action,datos,key);
                }else{TigerAlert('Faltan campos por llenar, por favor verifique',null);}
              });

         },onOpenBefore: function () {
           // call
           //jsloading('loading');
           let myDropzone = new Dropzone("#my-great-dropzone", {
             url: "/galeria",
             init: function() {
                this.on("sending", function(file, xhr, formData){
                  formData.append("key", key);
                  formData.append("action", 'create');
                });
              }
           });
         }
       });
     });

     $('body').on('click', '.JdHoteles', function(event) {
       event.preventDefault();
       /* Act on the event */
       let btn = $(this);
       let trpadre = btn.parents('tr');
       let key = trpadre.data('key');
       // dialog
       let JDialog = $.dialog({
          title: btn.data('title')+' Hoteles',
          icon: 'far fa-images',
          theme: 'bootstrap',
          type:'dark',
          columnClass: 'col-md-8 col-md-offset-8 col-xs-4 col-xs-offset-4',
          containerFluid: true,
          content:
            '<div class="container-fluid mt-3 row" id="contentHotelesCat">'+
                '<div class="form-group col-6">' +
                  '<label for="agencia" class="form-label">Hotel</label>'+//autocomplete
                  '<input type="text" id="destino" class="form-control array" name="dest" required>'+
                  '<div class="jcomplete"></div>'+
              '</div>'+

              '<div class="form-group col-6" id="elements">' +
                  '<ul class="list-group list-group-numbered">'+
                  '</ul>'+
                    '<button type="button" class="btn bg-gradient-dark col-4" data-action="create" id="SubmitForm"> Guardar</button>'+
              '</div>'+

            '</div>',
          onContentReady: function () {
            this.$content.find('#elements').on('click', '.spX',function(){

                let padre=$(this).parents('.items');
                let keyP = padre.data('id');

                padre.remove();
                HotelRel('delete',null,keyP);//--------------------------------------funcion--------------------------------
            })

            this.$content.find('#destino').keyup(function(event) {
               /* Act on the event */
               let q = $(this).val(); let array = "";
               let parent = $(this).parents('.form-group');
               if (q.length >=3) {
                 $.ajax({
                     url:"{{ route('searcho') }}",
                     dataType: "json",
                     type:'post',
                     data:{q:q},
                     success: function( data ) {
                        console.log(data);
                        $.each(data, function() {
                          array+='<li class="list-group-item item-destino" data-id="'+this.id+'" data-hotel="'+this.hotel+'" data-dest="'+this.destino+'" data-iata="'+this.iataPais+'">'+this.hotel+ ', ' + this.destino + ', ' + '('+this.iataPais +')'+ '</li>';
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
             HotelRel('read',null,key);//---------------------------funcion-----------------

             /// item
             this.$content.find('.jcomplete').on('click', '.item-destino', function(event) {
               event.preventDefault();
               /* Act on the event */
               let htmlBody='';
               let parent = $(this).parents('.jcomplete');
               let tableContent = jc.$content.find('#elements > ul');
               jc.$content.find('#destino').val($(this).text());
               jc.$content.find('#destino').data('id',$(this).data('id'));
              //  jc.$content.find('#destino').data('hotel',$(this).data('hotel'));
              //  jc.$content.find('#destino').data('hotel',$(this).data('pais'));
              //  jc.$content.find('#destino').data('hotel',$(this).data('iata'));
               parent.empty();
            //    jc.$content.find('#elements > ul > li').data('idcont',$(this).data('id'));
            //    jc.$content.find('#elements > ul > li').data('hottl',$(this).data('hotel'));
            htmlBody+='<li class="list-group-item d-flex justify-content-between items" name="lisHot" data-id="'+$(this).data('id')+'">'+$(this).data('hotel') +', ' +$(this).data('dest')+ ', '+ '('+$(this).data('iata')+')'+'<span class="spX"> X </span>'+'</li>';
               tableContent.append(htmlBody);

             });
              let jc = this;
              let Trform = this.$content.find('#contentHotelesCat');
              Trform.on('click','#SubmitForm', function (e)
                {
                    let arraydata= {};
                    let btn = $(this);
                    let span=$('.spX');
                    let action=btn.data('action');
                    let padre=span.parents('.items');
                    let keyP = padre.data('id');

                    if(action == 'create')
                    {
                        // console.log('id hotel '+keyP)
                        // console.log('circuito: '+key)
                        arraydata['idCircuito']=key;
                        arraydata['idHotel']=keyP
                        // console.log(arraydata)
                        // console.log('keyP: '+keyP)
                        HotelRel(action,arraydata,key)
                    }

                });
        }
    });
});

     // function loading animation
     function jsloading(action){
       let content = $('body').find('.jconfirm-content-pane');
       if(action === 'loading'){
         content.addClass('overflow-hidden');
         content.append('<div class="jcloading"></div>');
         }
       else{
         setTimeout(function(){
           content.find('.jcloading').fadeOut( "slow" );
           content.removeClass('overflow-hidden');
          },200);
         }
     }
     // alerts
     function TigerAlert(content,action){
       let focused = $(':focus');
       if(action == 'close'){focused.parents('.jconfirm-open').find('.jconfirm-closeIcon').trigger("click");}
       $('body').append('<div class="tiger-overlay"><div class="tiger-alert"><icon></icon><content>'+content+'</content></div></div>').fadeIn(2000);
       $('body').find('.tiger-overlay').addClass('tiger-overlay--show-modal');
       setTimeout(function(){
         $('body').find('.tiger-overlay').fadeOut('slow' , function() {
           $(this).remove();
         });
       },2000);
     }
     // active tr table
     CircuitosTbl.on('click', 'tr', function(event) {
       event.preventDefault();
       /* Act on the event */
       let tr = $(this);
       if(!tr.hasClass('active')){CircuitosTbl.find('.active').removeClass('active'); tr.addClass('active');}
     });
  });
</script>
@endsection
