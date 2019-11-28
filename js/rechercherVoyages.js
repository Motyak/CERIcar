$(document).ready(function(){
    xhr=createAjaxObj();

    $('#formRecherche').on('submit',btnRechercherVoyages_Click);  
});

var xhr;

function btnRechercherVoyages_Process(){
    if(xhr.readyState==4 && xhr.status==200){
        var data=xhr.responseText;
        var newContent=$($.parseHTML(data)).find('#printVoyagesByDepartArriveeSuccess').html();
        addView(newContent,"rechercherVoyagesSuccess-res");
    }
}

function btnRechercherVoyages_Click(){
    var depart=$('#inputTextVilleDepart').val();
    var arrivee=$('#inputTextVilleArrivee').val();
    xhr.onreadystatechange=btnRechercherVoyages_Process;
    xhr.open("GET","CERIcar.php?action=printVoyagesByDepartArrivee&villeDepart="+depart+"&villeArrivee="+arrivee,true);
    xhr.send(null);
    return false;
}
  