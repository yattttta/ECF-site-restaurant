$(document).ready(() => {

   

    let recherche = document.querySelector("input[id=reservations_date]")
    let display = document.getElementById("test")
    

    recherche.addEventListener('change', function() {
        if (recherche.value == "") {
            display.style.visibility = "hidden"
        } else {
            let xhr = new XMLHttpRequest
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    if (xhr.responseText == "") {
                        display.style.visibility = "hidden"
                    } else {
                        display.style.visibility = "visible"
                        display.innerHTML = xhr.responseText
                    }
                } else {
                    display.innerHTML = "En cours de chargement"
                }
            }
            xhr.open('post', 'timeDisplay', true)
            xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded")          
            xhr.send("date=" + recherche.value)
        }    
    })
})