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

    const nav = document.querySelector('.barre')

    window.addEventListener('scroll', function() {
        if (window.scrollY > 50) {
            nav.classList.add('scroll')

        } else {
            nav.classList.remove('scroll')
        }
    } )
})