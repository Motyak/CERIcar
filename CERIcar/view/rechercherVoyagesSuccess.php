<body>
<!-- <form action="https://pedago.univ-avignon.fr/~uapv1903668/CERIcar.php"> -->
  <form id=formRecherche>
  <!-- <input type="hidden" name="action" value="printVoyagesByDepartArrivee" /> -->
  Ville de départ:<br>
  <input type="text" name="villeDepart" id="depart">
  <br>
  Ville d'arrivée:<br>
  <input type="text" name="villeArrivee" id="arrivee">
  <br><br>
  <input type="submit" value="Rechercher">
</form>
<!-- <script src="js/rechercherVoyages.js" type="text/javascript" defer></script> -->
<script type="text/javascript">

var xhr;
var voyages;

$('#formRecherche').on('submit',makeRequest);


function processServerResponse(){
    if(xhr.readyState==4 && xhr.status==200){
        var data=xhr.responseText;
        //losque la page a fini de chargé entièrement (toutes les vues)
        $( document ).ready(function() {
            //recuperer uniquement le nouveau contenu (lignes de la table en l'occurence)
            var newContent=$($.parseHTML(data)).find('thead').siblings().html();
            //supprime les lignes de la table actuelle
            $('thead').siblings().remove();
            //ajouter les nouvelles lignes à la table actuelle
            $('thead').after(newContent);
        });
    }
}

  function makeRequest(){
    var depart=$('#depart').val();
    var arrivee=$('#arrivee').val();
    if(window.ActiveXObject){
        try{
            xhr=new ActiveXObject("Microsoft.XMLHTTP");
        }
        catch(e){
            xhr=new ActiveXObject("MSXML2.XMLHTTP");
        }
    }
    else if(window.XMLHttpRequest){
        xhr=new XMLHttpRequest();
    }
    xhr.onreadystatechange=processServerResponse;
    xhr.open("GET","CERIcar.php?action=printVoyagesByDepartArrivee&villeDepart="+depart+"&villeArrivee="+arrivee,true);
    xhr.send(null);
    return false;
}
</script>
</body>