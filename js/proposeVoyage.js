$(document).ready(function(){
    xhr=createAjaxObj();

    $('#propo_Submit').on('click',propo_Submit_Click);
});

var xhr;

function propo_Submit_Process(){
    if(xhr.readyState==4 && xhr.status==200){
        var data=xhr.responseText;
        $data=$($.parseHTML(data));

        // new content = form login qui se reset/affiche un panneau d'erreur par ex.
        var newContent=$data.find('#ProposerVoyageSuccess').html();

        // si redirection faites via ajax, alors faire redirection javascript
        if(newContent==null || !newContent.trim())
            window.location.replace("CERIcar.php");
        else
        {
            addView(newContent,"ProposerVoyageSuccess");

            // update du bandeau selon le message du bandeau de la page ajax
            $data.find('#bandeau').children().remove();
            var texteBandeau = $data.find('#bandeau').text();
            updateBandeau(texteBandeau);
            //recharger le script de la page
            $.getScript("js/proposeVoyage.js");
        }
    }
}

function propo_Submit_Click(){
    var depart=$('#depart').val();
    var arrivee=$('#arrivee').val();
    var hdepart=$('#hdepart').val();
    var nbplace=$('#nbplace').val();
    var tarif_voyage=$('#tarif_voyage').val();
    var tarif_km=$('#tarif_km').val();
    var commentaire=$('#commentaire').val();

    //verification conformite des champs, cote client
    if(!tarif_km.trim() || !depart.trim() || !arrivee.trim() || !hdepart.trim() || !nbplace.trim() || !tarif_voyage.trim())
    {
        updateBandeau("Veuillez completer les champs vides !");
        return;
    }
    if(!commentaire.trim())
         commentaire = " ";

    var params="depart="+depart+"&arrivee="+arrivee+"&hdepart="+hdepart+"&nbplace="+nbplace+"&tarif_voyage="+tarif_voyage+"&tarif_km="+tarif_km+"&commentaire="+commentaire;
    xhr.onreadystatechange=propo_Submit_Process;
    xhr.open("POST","CERIcar.php?action=ProposerVoyage",true);
    // si on met pas cet header, les parametres ne se passent pas correctement
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send(params);
}