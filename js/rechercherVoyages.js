var xhr;
var voyages;

$('#formRecherche').on('submit',makeRequest);


function processServerResponse(){
    if(xhr.readyState==4 && xhr.status==200){
        var data=xhr.responseText;
        // alert(data);
        // voyages=JSON.parse(data);
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
    xhr.open("GET","CERIcar.php?action=printVoyagesByDepartArrivee&villeDepart="+depart+"&villeArrivee="+arrivee+"&json=1",true);
    // xhr.open("GET","CERIcar.php?action=printVoyagesByDepartArrivee&villeDepart=Paris&villeArrivee=Lyon&json=1",true);
    xhr.send(null);
    return false;
}