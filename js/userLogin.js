$(document).ready(function(){

    $('#formLogin').on('click', function(){

        var login = $('#login').val();
        var password = $('#pwd').val();

        //      history.pushState({},"","?action=AfficherRechercheVoyage");
        $.ajax({
            type: 'POST',
            url: 'CERIcar.php?action=Userlogin',
            data:{
                login: login,
                pwd: password
            },
            success: function(data){
                if(data.match('Connexion reussit')) {
                    $('#page_maincontent').children().remove();
                    updateBandeau("Bingo vous etes Connecté !");
                    $('#connection').hide();
                    $('#add').show();
                    $('#register').hide();
                    $('#menuRechercher').show();
                    $('#deconnection').show();
                }
                else
                    updateBandeau("login ou mot de pass incorrect.");
            },
        });
    });
    
});

// $(document).ready(function(){
//     xhr=createAjaxObj();

//     $('#formLogin').on('submit',btnLogin_Click);
// });

// var xhr;

// function btnLogin_Process(){
//     if(xhr.readyState==4 && xhr.status==200){
//         var data=xhr.responseText;
//         var newContent=$($.parseHTML(data)).find('#printVoyagesByDepartArriveeSuccess').html();
//         addView(newContent,"rechercherVoyagesSuccess-res");
//     }
// }

// function btnLogin_Click(){
//     var login=$('#inputLogin').val();
//     var password=$('#inputPassword').val();
//     var params="login="+login+"&pwd="+password;
//     xhr.onreadystatechange=btnLogin_Process;
//     xhr.open("POST","CERIcar.php?action=userLogin",true);
//     xhr.send(params);
//     return false;
// }