// $(document).ready(function(){

//     $('#formLogin').on('click', function(){

//         var login = $('#login').val();
//         var password = $('#pwd').val();

//         //      history.pushState({},"","?action=AfficherRechercheVoyage");
//         $.ajax({
//             type: 'POST',
//             url: 'CERIcar.php?action=Userlogin',
//             data:{
//                 login: login,
//                 pwd: password
//             },
//             success: function(data){
//                 if(data.match('Connexion reussit')) {
//                     $('#page_maincontent').children().remove();
//                     updateBandeau("Bingo vous etes Connecté !");
//                     $('#connection').hide();
//                     $('#add').show();
//                     $('#register').hide();
//                     $('#menuRechercher').show();
//                     $('#deconnection').show();
//                 }
//                 else
//                     updateBandeau("login ou mot de pass incorrect.");
//             },
//         });
//     });
    
// });

$(document).ready(function(){
    xhr=createAjaxObj();

    $('#btnSubmit').on('click',btnLogin_Click);
});

var xhr;

function btnLogin_Process(){
    // pouvoir detecter si une redirection a été faite ou doit être envisagée, puis la faire en javascript
    if(xhr.readyState==4 && xhr.status==200){
        var data=xhr.responseText;
        $data=$($.parseHTML(data));

        // new content = form login qui se reset/affiche un panneau d'erreur par ex.
        var newContent=$data.find('#userLoginSuccess').html();

        //si la div userLoginSuccess de la reponse est vide, alors redirigez vers index
        if(newContent==null || !newContent.trim())
            window.location.replace("CERIcar.php");
        else
        {
            addView(newContent,"userLoginSuccess");

            // update du bandeau selon le message du bandeau de la page ajax
            $data.find('#bandeau').children().remove();
            var texteBandeau = $data.find('#bandeau').text();
            updateBandeau(texteBandeau);
            //recharger le script de la page
            $.getScript("js/userLogin.js");
        }
    }
}

function btnLogin_Click(){
    var login=$('#inputLogin').val();
    var password=$('#inputPassword').val();
    var params="login="+login+"&pwd="+password;
    xhr.onreadystatechange=btnLogin_Process;
    xhr.open("POST","CERIcar.php?action=userLogin",true);
    // si on met pas cet header, les parametres ne se passent pas correctement
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send(params);
}