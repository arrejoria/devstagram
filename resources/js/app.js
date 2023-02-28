import Dropzone from "dropzone";

Dropzone.autoDiscover = false;

const dropzone = new Dropzone("#dropzone", {
    dictDefaultMessage: "Sube aquí tu imagen",
    acceptedFiles: ".png,.jpg,.jpeg,.gif",
    addRemoveLinks: true,
    dictRemoveFile: "Borrar archivo",
    maxFiles: 1,
    uploadMultiple: false

});


dropzone.on('sending', function(file,xhr,formData){
    console.log(file, 'sending');
});
dropzone.on('success', function(file, response){
    console.log(response, 'success');
});
dropzone.on('canceled', function(file){
    console.log(file, 'canceled');
});
dropzone.on('error', function(file, message){
    console.log(file, 'error'+ message);
});

