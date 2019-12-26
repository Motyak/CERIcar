$(document).ready(function(){
    xhr=createAjaxObj();

    $('#voyages tr').hover(function() {
        // hover in
        $(this).find('button[name=reserver]').removeClass('invisible');
    }, function() {
        // hover out
        $(this).find('button[name=reserver]').addClass('invisible');
    });

    // quand un bouton reserver est cliqué, appel ajax vers cette meme page avec param post idReservation et param get ville depart arrivee
    $('#voyages tr button').click(function(){
        // recuperer id voyage de la ligne correspondante
        var idVoy=$(this).parent().parent().find('td[name=idVoy]').text();

        xhr.onreadystatechange=btnReserver_Process;
        xhr.open("POST","CERIcar.php?action=printVoyagesByDepartArrivee&villeDepart="+depart+"&villeArrivee="+arrivee,true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.send("reservationIdVoyage="+idVoy);
    });
});

var xhr;

function btnReserver_Process(){
    if(xhr.readyState==4 && xhr.status==200){
        var data=xhr.responseText;
        var newContent=$($.parseHTML(data)).find('#printVoyagesByDepartArriveeSuccess').html();
        addView(newContent,"rechercherVoyagesSuccess-res");

        // invoquer script js rechercherVoyages_boutonsReserver
        $.getScript("js/rechercherVoyages_boutonsReserver.js");
    }
}