btnNewsletter = document.querySelector('#btn-newsletter');

btnNewsletter.addEventListener("click", function(){ addEmailToNewsletter(event); } );

function addEmailToNewsletter(e){
    e.preventDefault();
    email = document.querySelector('#n_email').value;

    // L'adresse mail doit avoir été renseignée
    if(email == "") {
        alert("Vous devez saisir une adresse mail");
        return false;        
    }

    // on vérifie le format de l'email
    var re = /^(([^<>()[]\.,;:s@]+(.[^<>()[]\.,;:s@]+)*)|(.+))@(([[0-9]{1,3}.[0-9]{1,3}.[0-9]{1,3}.[0-9]{1,3}])|(([a-zA-Z-0-9]+.)+[a-zA-Z]{2,}))$/;
    if(!re.test(email)) {
        alert("l'adresse mail n'est pas valide");
        return false;
    }

    fetch("../api/inscription-newsletter.php?email=" + email)
    .then(function (response) {
        return response.text();
    })
    .then(function (response) { 
        alert("Votre adresse mail a bien été ajoutée. Vous recevrez notre prochaine newsletter.");
    }).catch(function (error) {
        console.log('Il y a eu un problème avec l\'opération fetch: ' + error.message);
    }); 
    
}
