$(document).ready(function(){
  

  CargarCiudades();  //Carga Todas las Ciudades
  CargarTipos();


  //Estableciendo evento click en el boton mostrar Todos para mostrar todos los registros sin filtro
  $("#mostrarTodos").click(function(){
    MostrarTodos();
  });

  $("#formulario").submit(function(event){
    event.preventDefault();
    Buscar();
    
  });

});


/*
  Creación de una función personalizada para jQuery que detecta cuando se detiene el scroll en la página
*/
$.fn.scrollEnd = function(callback, timeout) {
  $(this).scroll(function(){
    var $this = $(this);
    if ($this.data('scrollTimeout')) {
      clearTimeout($this.data('scrollTimeout'));
    }
    $this.data('scrollTimeout', setTimeout(callback,timeout));
  });
};
/*
  Función que inicializa el elemento Slider
*/

function inicializarSlider(){
  $("#rangoPrecio").ionRangeSlider({
    type: "double",
    grid: false,
    min: 0,
    max: 100000,
    from: 200,
    to: 80000,
    prefix: "$"
  });
}
/*
  Función que reproduce el video de fondo al hacer scroll, y deteiene la reproducción al detener el scroll
*/
/* function playVideoOnScroll(){
  var ultimoScroll = 0,
      intervalRewind;
  var video = document.getElementById('vidFondo');
  $(window)
    .scroll((event)=>{
      var scrollActual = $(window).scrollTop();
      if (scrollActual > ultimoScroll){
       video.play();
     } else {
        //this.rewind(1.0, video, intervalRewind);
        video.play();
     }
     ultimoScroll = scrollActual;
    })
    .scrollEnd(()=>{
      video.pause();
    }, 10)
} */

inicializarSlider();
//playVideoOnScroll();



//1.- muestra Todos los registros sin filtro
function MostrarTodos(){
  $.ajax({
    type: 'POST',
    url: 'php/MostrarDatos.php'
 })
 .done(function(ListaProps){
    $("#Items").html(ListaProps);
    //console.log(ListaProps);
 })
 .fail(function(){
   alert("Erro al cargar todos los registros");
 })
}



//2.- Carga las ciudades en el Menu desplegable de la izquierda
function CargarCiudades(){
  $.ajax({
    type: 'POST',
    url: 'php/ciudades.php'  
  })
  .done(function(Listaciudades){
    $("#selectCiudad").html(Listaciudades);
    $('#selectCiudad').material_select();

  })
  .fail(function(){
    alert("Error al cargar las ciudades");

  }) 
}







//2.- Carga los Tipos de Propiedad
function CargarTipos(){
  $.ajax({
    type: 'POST',
    url: 'php/tiposProp.php'
  })
  .done(function(listaTipos){
    $("#selectTipo").html(listaTipos);
    $("#selectTipo").material_select();
  })
  .fail(function(){
    alert("Error al Cargar los Tipos de propiedad");
  })
}



// 3, 4 y 5.- Carga todas las ciudades segun el valor seleccionado de la ciudad, propiedad y Rango de precios
function Buscar(){
  var CiudadSel = $("#selectCiudad").val(); 
  var TipoSel = $("#selectTipo").val();
  var precio = $("#rangoPrecio").val(); 
  p = precio.split(";")
  var pMax = p[1];
  var pMin = p[0];
  
    
  $.ajax({
      type:'POST',
      url:'php/buscar.php',
      data: {CiudadS:CiudadSel,TipoS:TipoSel,PrecioMin:pMin,PrecioMax:pMax}

   })
   .done(function(data){
    $("#Items").html(data); 
    //console.log(data);
   })
   .fail(function(){
       alert("Error al buscar");
   })

}