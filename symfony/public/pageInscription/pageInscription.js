$(document).ready(() => {
    let eye = document.querySelector('.eye')
    let eyeSlash = document.querySelector('.eyeSlash')
    let input = document.querySelector('.password')

    eyeSlash.addEventListener('click', function() {
        input.setAttribute("type", "text")
        eyeSlash.style.display = "none"
        eye.style.display = "block"
    })

    eye.addEventListener('click', function() {
        input.setAttribute("type", "password")
        eye.style.display = "none"
        eyeSlash.style.display = "block"
    })
})