let wrapperMobile =
  '<div class="ac-header">'+
    '<div class="ac-close-container">'+
      '<div class="ac-close-modal ">'+
        '<i class="suggester-icon-md suggester-icon-arrow-bold-left">'+
          '<span class="ac-close-modal-txt">Cancelar</span>'+
        '</i>'+
      '</div>'+
    '</div>'+
    '<div class="ac-input-mobile-container">'+
      '<input class="ac-input-mobile" placeholder="Ingresa al menos 3 letras">'+
      '<span class="ac-borrar"></span>'+
    '</div>'+
  '</div>'+
  '<div class="ac-container">'+
    '<div class="ac-group-container">'+
      '<div class="ac-group-title-container -error"><i class="suggester-icon-sm"></i><span class="ac-group-title">Ingresa al menos 3 letras, y aguarda los resultados  </span></div>'+
    '</div>'+
  '</div>';
let wrapperDesktop = '<div class="ac-container">'+
  '<div class="ac-group-container">'+
    '<div class="ac-group-title-container">'+
      '<div class="ac-group-title-icon"><i class="suggester-icon-xsm suggester-icon-city"></i> </div>'+
        '<span class="ac-group-title eva-3-overline-2">Ciudades</span>'+
      '</div>'+
      '<ul class="ac-group-items"></ul>'+
    '</div>'+
  '</div>';
let wrapper = $('.ac-wrapper'),inputsearch;let inputTag = $('.input-tag');
//* position */
let destination = $('.input-tag').offset();
/// windows
if ($(window).width() > 992) {
    wrapper.addClass('-desktop');wrapper.append(wrapperDesktop);$('.-desktop').css({top: destination.top+54, left: destination.left});
}else{wrapper.append(wrapperMobile);}
$(window).on('resize', function() {
  if ($(window).width() > 992) {
    wrapper.empty();
    wrapper.addClass('-desktop');
    wrapper.append(wrapperDesktop);
  } else {
    wrapper.empty();
    wrapper.removeClass('-desktop');
    wrapper.append(wrapperMobile);
    inputsearch = $('body').find('.ac-input-mobile');
  }if (wrapper.hasClass('-desktop')) {$('.-desktop').css({top: destination.top+54, left: destination.left});}
});
let closeicon = '<i class="suggester-icon-md suggester-icon-close"><span class="ac-borrar-txt">Borrar</span></i>';
let flag=0; let close = $('.ac-borrar'); let closeModal = $('.ac-close-modal');
inputsearch = wrapper.find('.ac-input-mobile');
// clear
inputsearch.val('');
// on input type
inputsearch.keyup(function(event) {
  /* Act on the event */
  let key = $(this);
  if(flag==0){inputsearch.next('.ac-borrar').append(closeicon);}
  if (key.val().length >= 3) {flag=1;}else{flag=0;inputsearch.next('.ac-borrar').empty();}
  // then ajax call
});
// close // erase input field
wrapper.on('click', '.ac-borrar', function(event) {
  /* Act on the event */
  console.log('erase');
  inputsearch.val('');flag=0;inputsearch.next('.ac-borrar').empty();
});
// close modal search
wrapper.on('click', '.ac-close-modal', function(event) {
  /* Act on the event */
  wrapper.removeClass('-show');
});
// click input tag
inputTag.click(function(event) {
  /* Act on the event */
  if(!wrapper.hasClass('-desktop')){wrapper.addClass('-show');}
});
// on keyup input tag
inputTag.keyup(function(event) {
  /* Act on the event */
  if(wrapper.hasClass('-desktop')){
    let key = $(this);
    if (key.val().length >= 3) {wrapper.addClass('-show');}else{wrapper.removeClass('-show');}
  }
});
