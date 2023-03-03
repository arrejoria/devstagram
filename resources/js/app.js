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

dropzone.on('success', function(file, response){
    document.querySelector('[name="imagen"]').value = response.imagen
});

dropzone.on('removedfile', function(file){
    console.log(file);
});