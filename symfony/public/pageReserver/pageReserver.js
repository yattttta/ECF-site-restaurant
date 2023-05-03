$(document).ready(() => {

    let recherche = document.querySelector("input[id=reservations_date]")
    let display = document.getElementById("test")

    //requete ajax sur datepicker
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
    
    let heuresMidi = ['12h00', '12h15', '12h30', '12h45', '13h00']    
    let heuresSoir = ['19h00', '19h15', '19h30', '19h45', '20h00', '20h15', '20h30', '20h45', '21h00']
    let timeValue = document.getElementById('reservations_time')
    
    //transmettre heure selectionnée au champ de formulaire time
    for (let i = 0; i < heuresMidi.length; i++) {
        $(document).on('click', '#' + heuresMidi[i], function() {
            timeValue.style.visibility = "visible"
            timeValue.setAttribute('value', heuresMidi[i]) 

        })
    }

    for (let j = 0; j < heuresSoir.length; j++) {
        $(document).on('click', '#' + heuresSoir[j], function() {
            timeValue.style.visibility = "visible"
            timeValue.setAttribute('value', heuresSoir[j])
        })
    }

    
     
})