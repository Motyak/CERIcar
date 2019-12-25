$(document).ready(function(){
    xhr=createAjaxObj();

    $('#btnSubmit').on('click',btnSignin_Click);
});

var xhr;

function btnSignin_Process(){
    if(xhr.readyState==4 && xhr.status==200){
        var data=xhr.responseText;
        $data=$($.parseHTML(data));

        // new content = form login qui se reset/affiche un panneau d'erreur par ex.
        var newContent=$data.find('#userSigninSuccess').html();

        // si redirection faites via ajax, alors faire redirection javascript
        if(newContent==null || !newContent.trim())
            window.location.replace("CERIcar.php");
        else
        {
            addView(newContent,"userSigninSuccess");

            // update du bandeau selon le message du bandeau de la page ajax
            $data.find('#bandeau').children().remove();
            var texteBandeau = $data.find('#bandeau').text();
            updateBandeau(texteBandeau);
            //recharger le script de la page
            $.getScript("js/userSignin.js");
        }
    }
}

function btnSignin_Click(){
    var firstName=$('#inputFirstName').val();
    var lastName=$('#inputLastName').val();
    var dateOfBirth=$('#inputDateOfBirth').val();
    var username=$('#inputUserName').val();
    var password=$('#inputPassword').val();

    //verification conformite des champs, cote client
    if(!firstName.trim() || !lastName.trim() || !dateOfBirth.trim() || !username.trim() || !password.trim())
    {
        updateBandeau("Veuillez completer les champs vides !")
        return;
    }
    var params="firstName="+firstName+"&lastName="+lastName+"&dateOfBirth="+dateOfBirth+"&username="+username+"&password="+password;
    xhr.onreadystatechange=btnSignin_Process;
    xhr.open("POST","CERIcar.php?action=userSignin",true);
    // si on met pas cet header, les parametres ne se passent pas correctement
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send(params);
}