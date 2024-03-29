import Dropzone from 'dropzone'
import axios from 'axios'

Dropzone.autoDiscover = false

document.addEventListener('DOMContentLoaded', () => {
    postFunctions()
})
const dropzoneId = document.getElementById('dropzone')
if (dropzoneId) {
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
}

function postFunctions () {
    const postOptions = document.querySelector('#postOptions'),
        showOptions = document.querySelector('#showOptions'),
        postOptionForm = document.querySelector('#optionsForm')

    // ShowOptions on Click
    if (postOptions) {
        postOptions.addEventListener('click', () => {
            showOptions.classList.toggle('hidden')

            if (!postOptions.classList.contains('hidden')) {
                document.addEventListener('click', hideOptionsOnClickOutside)
            } else {
                document.removeEventListener('click', hideOptionsOnClickOutside)
            }

            handlePostOptions(showOptions, 0, handleEditOption)
            handlePostOptions(showOptions, 1, handleDeleteOption)
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
    }
    function handlePostOptions (optionList, optionPosition, handle) {
        if (optionList) postOptionForm
        optionList.children[optionPosition].addEventListener('click', handle)
        showOptions.classList.toggle('hidden')
    }

    function handleEditOption () {
        console.log('editando')
        postOptionForm.method = 'DELETE'
    }

    function handleDeleteOption () {
        console.log('deleting')
        // return postOptionForm.submit()
    }
}

// Peticion HTTP mediante axios al darle like y dislike a un post

const likeButton = document.getElementById('like-button')

if (likeButton) {
    const likeCount = document.getElementById('like-count')
    const postId = likeButton.getAttribute('data-post-id')
    const likeText = document.getElementById('like-text')

    function updateLikeCountAndText (likeCount, response, likeText) {
        likeCount.textContent = response.data.likes
        likeText.textContent = `${response.data.likes === 1 ? 'like' : 'likes'}`
    }

    let isRequestPending = false

    likeButton.addEventListener('click', async () => {
        if (isRequestPending) return

        isRequestPending = true
        likeButton.disabled = true

        const alreadyLiked = likeButton.classList.contains('text-red-500')
        const action = alreadyLiked
            ? `/posts/${postId}/unlikes`
            : `/posts/${postId}/likes`

        try {
            const response = await axios({
                method: alreadyLiked ? 'DELETE' : 'POST',
                url: action
            })

            updateLikeCountAndText(likeCount, response, likeText)

            likeButton.classList = `text-${alreadyLiked ? 'gray' : 'red'}-500`
        } catch (error) {
            console.log(error)
        }

        isRequestPending = false
        likeButton.disabled = false
    })
}

// Nav Bar on Mobile

const menuToggle = document.getElementById('menu-toggle')
const menu = document.getElementById('menu')

if (menuToggle) {
    menuToggle.addEventListener('click', () => {
        menu.classList.toggle('show')
    })
}

// Handle Nav Bar on Scroll
const headerBar = document.querySelector('#headerBar'),
    scrollPositionY = 100

function handleScroll () {
    if (window.scrollY > scrollPositionY) {
        headerBar.classList.add('shadow-out')
    } else {
        headerBar.classList.remove('shadow-out')
    }
}

window.addEventListener('scroll', handleScroll)

// Libreria Emoji Picker


// // Comentarios
// const commentItem = document.getElementById('comment-item');
// const form = document.querySelector('#frm-comment');
// form.addEventListener('submit', (e) => {
//     e.preventDefault();
    
//     const formData = new FormData(form);
//     const url = form.getAttribute('action');

//     fetch(url, {
//         method: 'POST',
//         body: formData
//     })
//     .then(response => response.json())
//     .then(data => {
//         console.log(data);
        
//         // Actualizar la información de la página con el comentario recién creado
//         const commentUser = document.createElement('a')
//         const comment = document.createElement('p')

//         commentUser.textContent = data.username
//         comment.textContent = data.comentario
//         commentItem.append(commentUser, comment)
//     })
//     .catch(error => console.error(error));
// });
