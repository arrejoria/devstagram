import Dropzone from 'dropzone'

Dropzone.autoDiscover = false

document.addEventListener('DOMContentLoaded', () => {
    postFunctions()
})

const dropzone = new Dropzone('#dropzone', {
    dictDefaultMessage: 'Sube aquí tu imagen',
    acceptedFiles: '.png,.jpg,.jpeg,.gif',
    addRemoveLinks: true,
    dictRemoveFile: 'Borrar archivo',
    maxFiles: 1,
    uploadMultiple: false,

    init: function () {
        if (document.querySelector('[name="imagen"]').value.trim()) {
            const imagenPublicada = {}
            imagenPublicada.size = 1000
            imagenPublicada.name =
                document.querySelector('[name="imagen"]').value

            this.options.addedfile.call(this, imagenPublicada)
            this.options.thumbnail.call(
                this,
                imagenPublicada,
                `/uploads/${imagenPublicada.name}`
            )

            imagenPublicada.previewElement.classList.add(
                'dz-success',
                'dz-complete'
            )
            console.log(imagenPublicada)
        }
    }
})

dropzone.on('success', function (file, response) {
    document.querySelector('[name="imagen"]').value = response.imagen
})

dropzone.on('removedfile', function () {
    document.querySelector('[name="imagen"]').value = ''
})

function postFunctions () {
    const postOptions = document.querySelector('#postOptions'),
        showOptions = document.querySelector('#showOptions')

    // ShowOptions on Click
    if (postOptions) {
        postOptions.addEventListener('click', () => {
            showOptions.classList.toggle('hidden')

            if (!postOptions.classList.contains('hidden')) {
                document.addEventListener('click', hideOptionsOnClickOutside)
            } else {
                document.removeEventListener('click', hideOptionsOnClickOutside)
            }
        })

        function hideOptionsOnClickOutside (e) {
            if (
                !postOptions.contains(e.target) &&
                !showOptions.contains(e.target)
            ) {
                showOptions.classList.add('hidden')
                document.removeEventListener('click', hideOptionsOnClickOutside)
            }
        }

        showOptions.firstElementChild.addEventListener(
            'click',
            handleDeleteOption
        )

        function handleDeleteOption () {
            showOptions.classList.toggle('hidden')
            optionForm.submit()
        }
    }
}

