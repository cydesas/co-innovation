const particulier = 2;
const entreprise = 3;
const esn = 4;

const raisonsociale = document.querySelector('#raisonsociale');
const lblRaisonsociale = document.querySelector('#lbl-raisonsociale');
const siret = document.querySelector('#siret');
const lblSiret = document.querySelector('#lbl-siret');
const lblNom = document.querySelector('#lbl-nom');
const prenom = document.querySelector('#prenom');
const lblPrenom = document.querySelector('#lbl-prenom');

const typeutilisateur = document.querySelector('#typeutilisateur');
typeutilisateur.addEventListener('change', typeUtilisateurChange);
typeutilisateur.addEventListener("change", function(){ typeUtilisateurChange(typeutilisateur); } );

// Il faut appeler la fonction une fois au démarrage pour pouvoir afficher ou cacher les zones SIRET et raison sociale si on a forcé la valeur de la liste via PHP
typeUtilisateurChange(typeutilisateur);

function typeUtilisateurChange(select) {

    if(select.value == entreprise || select.value == esn) {
        raisonsociale.style.display = 'block';
        lblRaisonsociale.style.display = 'inline';
        siret.style.display = 'block';
        lblSiret.style.display = 'inline';
        prenom.style.display = 'none';
        lblPrenom.style.display = 'none';
        lblNom.innerText = "Nom de l'entreprise";
    }
    else {
        raisonsociale.style.display = 'none';
        lblRaisonsociale.style.display = 'none';
        siret.style.display = 'none';
        lblSiret.style.display = 'none';
        prenom.style.display = 'block';
        lblPrenom.style.display = 'inline';
        lblNom.innerText = "Nom*";
    }
}