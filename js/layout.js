$(document).ready(function () {
    xhr=createAjaxObj();

    $("#bandeau").animate({
        marginBottom: "0px",
    }, 500);

    $("#fermer").click(function () {
        $('#bandeau').animate({
            marginBottom: "-50px"
        }, 500);
    });

    $('#menuIndex').click(menuIndex_Click);
    $('#menuRechercher').click(menuRechercher_Click);
    $('#menuSeConnecter').click(menuSeConnecter_Click);
});

var xhr;

function updateBandeau(msg)
{
    //faire disparaitre le bandeau
    $('#bandeau').css("marginBottom","-50px");
    //attribuer msg au bandeau + la croix pour fermer
    $('#bandeau').html(msg + '\n<div id="fermer">&#10006</div>');
    //reinvoquer le script du layout pour l'anim du bandeau et la fermeture
    $.getScript("js/layout.js");
}

function createAjaxObj()
{
    if(window.ActiveXObject){
        try{
            return new ActiveXObject("Microsoft.XMLHTTP");
        }
        catch(e){
            return new ActiveXObject("MSXML2.XMLHTTP");
        }
    }
    else if(window.XMLHttpRequest){
        return new XMLHttpRequest();
    }
}

function clearPage()
{
    $('#page_maincontent').children().remove();
    updateBandeau("Contenu de la page effacé");
}

function delView(nomVue)
{
    $('#'+nomVue).remove();
    updateBandeau("Vue "+nomVue+" supprimée.");
}

function addView(newContent,nomVue,verbose=true)
{
    //si la vue existe déjà, on reactualise son contenu sans changer sa position sur la page
    if($('#'+nomVue).length)
    {
        $('#'+nomVue).html(newContent);
        if(verbose)
            updateBandeau("Vue "+nomVue+" actualisée.");
    }
        

    //sinon, on l'append au contenu principal de la page
    else
    {
        $('#page_maincontent').append("<div id="+nomVue+">\n"+newContent+"</div>\n");
        if(verbose)
            updateBandeau("Vue "+nomVue+" ajoutée.");
    }
        

}

function menuIndex_Process()
{
    if(xhr.readyState==4 && xhr.status==200){
        var data=xhr.responseText;
        var newContent=$($.parseHTML(data)).find('#indexSuccess').html();
        clearPage();
        addView(newContent,"indexSuccess");
        updateBandeau("Page index chargée.");
    }
}

function menuIndex_Click()
{
    xhr.onreadystatechange=menuIndex_Process;
    xhr.open("GET","CERIcar.php?action=index",true);
    xhr.send(null);
}

function menuRechercher_Process()
{
    if(xhr.readyState==4 && xhr.status==200){
        var data=xhr.responseText;
        var newContent=$($.parseHTML(data)).find('#rechercherVoyagesSuccess').html();
        clearPage();
        addView(newContent,"rechercherVoyagesSuccess");
        newContent=$($.parseHTML(data)).find('#rechercherVoyagesSuccess-res').html();
        addView(newContent,"rechercherVoyagesSuccess-res");
        //charger rechercherVoyages.js
        $.getScript("js/rechercherVoyages.js");
        updateBandeau("Page rechercherVoyages chargée.");
    }
}

function menuRechercher_Click()
{
    xhr.onreadystatechange=menuRechercher_Process;
    xhr.open("GET","CERIcar.php?action=rechercherVoyages",true);
    xhr.send(null);
}

function menuSeConnecter_Process()
{
    if(xhr.readyState==4 && xhr.status==200){
        var data=xhr.responseText;
        var newContent=$($.parseHTML(data)).find('#userLoginSuccess').html();
        
        // si c'est null/undefined -> redirection javascript vers index
        if(newContent==null || !newContent.trim())
            window.location.replace("CERIcar.php");
        else
        {
            clearPage();
            addView(newContent,"userLoginSuccess");
            //charger userLogin.js
            $.getScript("js/userLogin.js");
            updateBandeau("Page userLogin chargée.");
        }
    }
}

function menuSeConnecter_Click()
{
    xhr.onreadystatechange=menuSeConnecter_Process;
    xhr.open("GET","CERIcar.php?action=userLogin",true);
    xhr.send(null);
}