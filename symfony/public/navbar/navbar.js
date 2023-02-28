$(document).ready(() => {
    const lines = document.getElementById('menuLines')
    const cross = document.getElementById('menuCross')

    
    function show() {
        $('#sousMenu').show()
        $('#menuLines').hide()
        $('#menuCross').show()
    }

    function hide() {
        $('#sousMenu').hide()
        $('#menuLines').show()
        $('#menuCross').hide()
    }

    lines.addEventListener('click', show)
    cross.addEventListener('click', hide)
})