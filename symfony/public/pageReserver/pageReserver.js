$(document).ready(() => {

    let recherche = document.querySelector("input[id=reservations_date]")
    let display = document.getElementById("test")
    let dateBlock = document.getElementById('dateBlock')
    let dateClone = document.getElementById("dateClone")
    let dateCloneBlock = document.getElementById("dateCloneBlock")
    let timeBlock = document.getElementById('timeBlock')
    let dateBlockModal = document.getElementById('dateBlockModal')
    let timeBlockModal = document.getElementById('timeBlockModal')
    const modalButton = document.getElementById('modalButton')

    let heuresMidi = ['12h00', '12h15', '12h30', '12h45', '13h00']    
    let heuresSoir = ['19h00', '19h15', '19h30', '19h45', '20h00', '20h15', '20h30', '20h45', '21h00']

    //requete ajax sur datepicker
    recherche.addEventListener('change', function() {
        dateClone.setAttribute('value', recherche.value)
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

    //Choisir date et horaire de réservation dans fenêtre modale sur petit écran
    if (screen.height < 800) {
        modalButton.style.display = "block"
        dateCloneBlock.style.display = "inline-flex"
        timeBlockModal.prepend(timeBlock)
        dateBlockModal.prepend(dateBlock) 
    }
    
    
    let timeValue = document.getElementById('reservations_time')
    
    //transmettre heure selectionnée au champ de formulaire time
    for (let i = 0; i < heuresMidi.length; i++) {
        $(document).on('click', '#' + heuresMidi[i], function() {
            timeValue.style.visibility = "visible"
            timeValue.setAttribute('value', heuresMidi[i])
            
            //Garder background-color bleu au click sur l'heure
            let timeSliceMidi = heuresMidi.slice(0, i)
            let timeSliceMidi1 = heuresMidi.slice(i + 1)
            let timeSliceConcatMidi = timeSliceMidi.concat(timeSliceMidi1)
            let selectedTimeMidi = document.getElementById(heuresMidi.slice(i, i + 1))
            
            selectedTimeMidi.style.backgroundColor = '#1b998b'
            for (let k = 0; k < timeSliceConcatMidi.length; k++) {
                let notSelectedTimeMidi = document.getElementById(timeSliceConcatMidi[k])
                notSelectedTimeMidi.style.backgroundColor = "#fff3b0"
            }
        })
    }

    for (let j = 0; j < heuresSoir.length; j++) {
        $(document).on('click', '#' + heuresSoir[j], function() {
            timeValue.style.visibility = "visible"
            timeValue.setAttribute('value', heuresSoir[j])

            //Garder background-color bleu au click sur l'heure
            let timeSliceSoir = heuresSoir.slice(0, j)
            let timeSliceSoir1 = heuresSoir.slice(j + 1)
            let timeSliceConcatSoir = timeSliceSoir.concat(timeSliceSoir1)
            let selectedTimeSoir = document.getElementById(heuresSoir.slice(j, j + 1))
            
            selectedTimeSoir.style.backgroundColor = '#1b998b'
            for (let l = 0; l < timeSliceConcatSoir.length; l++) {
                let notSelectedTimeSoir = document.getElementById(timeSliceConcatSoir[l])
                notSelectedTimeSoir.style.backgroundColor = "#fff3b0"
            }
        })
    }

    
     
})