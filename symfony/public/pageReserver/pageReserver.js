$(document).ready(() => {

    $(function() {
        $( "#date1" ).datepicker({
            prevText: 'Précédent',
            nextText: 'Suivant',
            changeMonth: true,
            monthNames: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
            monthNamesShort: ['Janv.', 'Févr.', 'Mars', 'Avril', 'Mai', 'Juin', 'Juil.', 'Août', 'Sept.', 'Oct.', 'Nov.', 'Déc.'],
            dayNames: ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'],
            dayNamesMin: ['D', 'L', 'M', 'M', 'J', 'V', 'S'],
            dateFormat: 'dd-mm-yy',
            firstDay: 1,
        });
    });

      
})