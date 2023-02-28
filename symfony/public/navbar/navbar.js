$(document).ready(() => {
    let toggle = document.querySelector('.toggle')
    let body = document.querySelector('body')

    toggle.addEventListener('click', function() {
        if(body.classList.contains('open')) {
            body.classList.remove('open')
        }
        else {
            body.classList.add('open')
        }
    })
})