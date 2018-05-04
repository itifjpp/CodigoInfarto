
var video = document.querySelector('#camera-stream'),
    image = document.querySelector('#snap'),
    start_camera = document.querySelector('#start-camera'),
    controls = document.querySelector('.controls'),
    take_photo_btn = document.querySelector('#take-photo'),
    delete_photo_btn = document.querySelector('#delete-photo'),
    download_photo_btn = document.querySelector('#download-photo'),
    error_message = document.querySelector('#error-message');

// Utilizamos la funcion getUserMedia para obtener la salida de la webcam
navigator.getMedia = ( navigator.getUserMedia ||
                      navigator.webkitGetUserMedia ||
                      navigator.mozGetUserMedia ||
                      navigator.msGetUserMedia);
 
 
if(!navigator.getMedia){
    displayErrorMessage("Tu navegador no soporta la funcion getMedia.");
}
else{
    // Solicitamos la camara
    navigator.getMedia({
      video: true
    },function(stream){
        // A nuestro componente video le establecemos el src al stream de la webcam
        video.src = window.URL.createObjectURL(stream);
        // Reproducimos
        video.play();
        video.onplay = function() {
            showVideo();
        };
    },function(err){
        displayErrorMessage("Ocurrio un error al obtener el stream de la webcam: " + err.name, err);
    });
}
// En los moviles no se puede reproducir el video automaticamente, programamos funcionamiento del boton inicar camara
start_camera.addEventListener("click", function(e){
    e.preventDefault();
    $('#start-camera').addClass('hide');
    // Reproducimos manualmente
    video.play();
    showVideo();
});
take_photo_btn.addEventListener("click", function(e){
    e.preventDefault();
    var snap = takeSnapshot();
    // Mostramos la imagen
    image.setAttribute('src', snap);
    image.classList.add("visible");
    // Activamos los botones de eliminar foto y descargar foto
    delete_photo_btn.classList.remove("disabled");
    download_photo_btn.classList.remove("disabled");
    // Establecemos el atributo href para el boton de descargar imagen
    download_photo_btn.href = snap;
    // Pausamos el stream de video de la webcam
    video.pause();
 
});
$('#take-photo').click(function (evt) {
    evt.preventDefault();
    var snap = takeSnapshot();
    // Mostramos la imagen
    image.setAttribute('src', snap);
    image.classList.add("visible");
    // Activamos los botones de eliminar foto y descargar foto
    delete_photo_btn.classList.remove("disabled");
    download_photo_btn.classList.remove("disabled");
    // Establecemos el atributo href para el boton de descargar imagen
    download_photo_btn.href = snap;
    // Pausamos el stream de video de la webcam
    video.pause();
})
delete_photo_btn.addEventListener("click", function(e){
    e.preventDefault();
    // Ocultamos la imagen
    image.setAttribute('src', "");
    image.classList.remove("visible");
    // Deshabilitamos botones de descargar y eliminar foto
    delete_photo_btn.classList.add("disabled");
    download_photo_btn.classList.add("disabled");
    // Reanudamos la reproduccion de la webcam
    video.play();
 
});
if( navigator.userAgent.match(/Android/i)|| navigator.userAgent.match(/webOS/i)|| navigator.userAgent.match(/iPhone/i)|| navigator.userAgent.match(/iPad/i)|| navigator.userAgent.match(/iPod/i)|| navigator.userAgent.match(/BlackBerry/i)|| navigator.userAgent.match(/Windows Phone/i)){
    $('#start-camera').removeClass('hide');
}else {
    $('#start-camera').addClass('hide');
}
function showVideo(){
    // Mostramos el stream de la webcam y los controles
    hideUI();
    video.classList.add("visible");
    controls.classList.add("visible");
}
 
function takeSnapshot(){
 
    var hidden_canvas = document.querySelector('canvas'),
        context = hidden_canvas.getContext('2d');
    var width = video.videoWidth,
        height = video.videoHeight;
 
    if (width && height) {
        // Configuramos el canvas con las mismas dimensiones que el video
        hidden_canvas.width = width;
        hidden_canvas.height = height;
 
        // Hacemos una copia
        context.drawImage(video, 0, 0, width, height);
        // Convertimos la imagen del canvas en datarurl
        
        return hidden_canvas.toDataURL('image/png');
        
  }
}
 
 
function displayErrorMessage(error_msg, error){
    error = error || "";
    if(error){
        console.log(error);
    }
    error_message.innerText = error_msg;
    hideUI();
    error_message.classList.add("visible");
}
 
 
function hideUI(){
    // Limpiamos
    controls.classList.remove("visible");
    start_camera.classList.remove("visible");
    video.classList.remove("visible");
    //snap.classList.remove("visible");
    error_message.classList.remove("visible");
}    