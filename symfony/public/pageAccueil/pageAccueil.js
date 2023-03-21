$(document).ready(() => {
    
    const titre = document.querySelector('.titre')

    window.addEventListener('scroll', function() {
        if (window.scrollY > 50) {
            titre.style.visibility = "visible"

        } else {
            titre.style.visibility = "hidden"
        }
    } )
})