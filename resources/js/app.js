import Dropzone from "dropzone"

Dropzone.autoDiscover = false

const dropzone = new Dropzone("#dropzone", {
    dictDefaultMessage: "Sube aquí tu imagen",
    acceptedFiles: ".png, .jpg, .jpeg, .gif",
    addRemoveLinks: true,
    dictRemoveFile: "Borrar Archivo",
    maxFiles: 1,
    uploadMultiple: false,
    maxFilesize: 5128,

    init: function () {
        if (document.getElementById("input_image").value.trim()) {
            const uploadImage = {}
            uploadImage.size = 123
            uploadImage.name = document.getElementById("input_image").value

            this.options.addedfile.call(this, uploadImage) // carga el archivo cuando se recarca si hay un archivo
            this.options.thumbnail.call(this, uploadImage, `/uploads/${uploadImage.name}`) // carga la imagen del archivo, la ruta es publica

            uploadImage.previewElement.classList.add('dz-success', 'dz-complete')
        }
    }
})

// dropzone.on("sending", (file, xhr, formData) => {
//     console.log(xhr)
// })

dropzone.on("success", (file, res) => {
    // console.log(res)
    document.getElementById('input_image').value = res
})

dropzone.on("error", (file, res) => {
    console.log(file)
    console.log(res)
})

dropzone.on("removedfile", (file, res) => {
    console.log('archivo eliminado')
})
