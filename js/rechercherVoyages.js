$(document).ready(function(){
    xhr=createAjaxObj();

    $('#formRecherche').on('submit',btnRechercherVoyages_Click);
});

var xhr;
var depart;
var arrivee;

function btnRechercherVoyages_Process(){
    if(xhr.readyState==4 && xhr.status==200){
        var data=xhr.responseText;
        var newContent=$($.parseHTML(data)).find('#printVoyagesByDepartArriveeSuccess').html();
        addView(newContent,"rechercherVoyagesSuccess-res");

        // invoquer script js rechercherVoyages_boutonsReserver
        $.getScript("js/rechercherVoyages_boutonsReserver.js");
    }
}

function btnRechercherVoyages_Click(){
    depart=$('#inputTextVilleDepart').val();
    arrivee=$('#inputTextVilleArrivee').val();
    xhr.onreadystatechange=btnRechercherVoyages_Process;
    xhr.open("GET","CERIcar.php?action=printVoyagesByDepartArrivee&villeDepart="+depart+"&villeArrivee="+arrivee,true);
    xhr.send(null);
    return false;
}
  