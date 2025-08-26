
// Code permettant de récupérer une liste d'idées via API REST
// Et de les afficher

var currentPage = 1;
var numPage = 1;


// Création/modification d'une idée
const resumeEditor = document.getElementById("resumeeIdee");
const resumeDescription = document.getElementById("descriptionIdee");
const btnBrouillon = document.querySelector("#brouillon");
const btnSoumission = document.querySelector("#soumission");
const hiddenDescIdea = document.querySelector("#hiddenDescIdea");
const hiddenResumeIdea = document.querySelector("#hiddenResumeIdea");

var simplemdeResume;
if(resumeEditor != null) {
  simplemdeResume = new SimpleMDE({ element: resumeEditor, lineWrapping: true });
  if(hiddenResumeIdea.value != "") {
    simplemdeResume.value(hiddenResumeIdea.value);
  }
}
var simplemdeDescription;
if(resumeDescription != null) {
  simplemdeDescription = new SimpleMDE({ element: resumeDescription, lineWrapping: true });
  if(hiddenDescIdea.value != "") {
    simplemdeDescription.value(hiddenDescIdea.value);
  }
}
if(btnBrouillon != null) {
  btnBrouillon.addEventListener('click', copyToHiddenFields);
  btnSoumission.addEventListener('click', copyToHiddenFields);
}

function copyToHiddenFields() {
  hiddenDescIdea.value = simplemdeDescription.value();
  hiddenResumeIdea.value = simplemdeResume.value();
}

  // Affichage d'une idée
const hiddenDesc = document.querySelector("#hiddenDesc");
if(hiddenDesc != null) {
  const afficheDesc = document.querySelector("#afficheDesc");
  afficheDesc.innerHTML = marked.parse(hiddenDesc.value);
}

const hiddenResume = document.querySelector("#hiddenResume");
if(hiddenResume != null) {
  const afficheResume = document.querySelector("#afficheResume");
  afficheResume.innerHTML = marked.parse(hiddenResume.value);
}


// Code permettant de "slide" les images d'une idee


const visuel = document.querySelectorAll('.idee-visuel')
const nbSlides = visuel.length
const next = document.querySelector(".carousel-right")
const prev = document.querySelector(".carousel-left")
let count = 0

const thumbs = document.querySelectorAll(".thumbs")
const carousel = document.querySelectorAll(".carousel-idee > img")

prev.addEventListener('click', ()=> {
  visuel[count].classList.remove('active')

  if(count > 0) count--
  else count = nbSlides - 1

  visuel[count].classList.add('active')

  //thumbs qui change en meme temps que l'image change, en cliquant sur les flèches
  for(const it of thumbs) 
    it.classList.remove('active')

  for(const car of carousel){
    car.classList.remove('active')
  }

  if(thumbs[count].id === carousel[count].dataset.target){
    thumbs[count].classList.add('active')
    carousel[count].classList.add('active')
  }//fin if
})

next.addEventListener('click', ()=> {
  visuel[count].classList.remove('active')

  if(count < nbSlides-1) count++
  else count = 0

  visuel[count].classList.add('active')

  //thumbs qui change en meme temps que l'image change, en cliquant sur les flèches
  for(const it of thumbs) 
    it.classList.remove('active')
  
  for(const car of carousel){
    car.classList.remove('active')
  }

  if(thumbs[count].id === carousel[count].dataset.target){
    thumbs[count].classList.add('active')
    carousel[count].classList.add('active')
  }//fin if
})

if(thumbs !=null){
  for(const thumb of thumbs){
    
    thumb.addEventListener('click', () => {

      // 2eme boucle for pour enlever "active" de tous les li de thumbs
      for(const it of thumbs) 
        it.classList.remove('active')
        
      for(const car of carousel){
        car.classList.remove('active')

        if(thumb.id === car.dataset.target){
          thumb.classList.add('active')
          car.classList.add('active')
          count = thumb.dataset.count
          thumb.scrollIntoViewIfNeeded(true)
        }//fin if

      }//fin boucle for of carousel

    });
  }
}



// Code permettant de selectionner et naviguer dans les onglets idee
// Et de les afficher

const list_onglet = document.querySelectorAll('.list_onglet > li')
const contents = document.querySelectorAll('.onglet-idee')

if(list_onglet != null) {

  for(const onglet of list_onglet){
    
    onglet.addEventListener('click', () => {

      // 2eme boucle for pour enlever "active" de tous les li de liste_onglet
      for(const it of list_onglet) 
        it.classList.remove('active')
        
      for(const content of contents){
        content.classList.remove('active')

        if(content.id === onglet.dataset.target){
          content.classList.add('active')
          onglet.classList.add('active')
        }//fin if

      }//fin boucle for of contents

      onglet.scrollIntoViewIfNeeded(true)
    });
  }//fin boucle for of list_onglet
}

// Code permettant de scroll avec les fleches dans les onglets idee

let button = document.querySelector('.arrow-r')
let onglet_active = document.querySelector('.list_onglet > .active')

button.onclick = function () {
    let container = document.querySelector('.list_onglet')
    sideScroll(container,'right',25,100,250);
};

let back = document.querySelector('.arrow-l')
back.onclick = function () {
    let container = document.querySelector('.list_onglet')
    sideScroll(container,'left',25,100,250);
};

function sideScroll(element,direction,speed,distance,step){
    scrollAmount = 0;
    let slideTimer = setInterval(function(){

        if(direction == 'left')
          element.scrollLeft -= step;
        else 
          element.scrollLeft += step;

        scrollAmount += step;
        if(scrollAmount >= distance)
          window.clearInterval(slideTimer);

    }, speed);
}

window.addEventListener("resize", () => {
  let container = document.querySelector('.list_onglet')
  onglet_active.scrollTo(onglet_active.width / 2, 0)
});

// Code permettant de "dévoiler" les reponses des FAQ

let accordion = document.querySelectorAll(".faq-box")

if(accordion != null) {

  for(const accord of accordion){
    
    accord.addEventListener('click', () => {
        accord.lastChild.classList.toggle('active')
    });
  }
}


/*
// Récupère une liste d'idées en fonction de l'URL passée
async function getIdeas(url) {

  ideasContainer.innerHTML = "";

  await fetch(url)
  .then(function (response) {
    return response.json();
  })
  .then(function (response) {
    numPage = Math.ceil(response[0]['count'] / ideasPerPage) ;

    if(response[1] != undefined) {
      createIdeasUi(response[1]);
    }
    else {
      const h2 = document.createElement('h2');
      h2.classList.add('cartel2');
      h2.innerText = "Pas d'idée à afficher";
      ideasContainer.appendChild(h2);
    }
    return 1;

  }).catch(function (error) {
    console.log('Il y a eu un problème avec l\'opération fetch: ' + error.message);
  });

}

async function createIdeasUi(idees) {
  var counter = 1;

  for (const idee of idees) {

    const article = document.createElement('article');

    if (page == "slider") {
      article.classList.add('cartelbis');
    } else {
      article.classList.add('cartel');
      article.classList.add('cartel' + counter);
    }

    counter++;
    if (counter > 3) {
      counter = 1;
    }

    if (page != "slider") {
      const anchor = document.createElement('a');
      anchor.href = 'idea?idee=' + idee.id_idee;
      anchor.style.visible = "hidden";
      article.appendChild(anchor);
      article.addEventListener("click", function () {
        goPage(anchor);
      });
    }

    const divImg = document.createElement('div');
    divImg.classList.add('img-cartel');
    article.appendChild(divImg);

    const img = document.createElement('img');
    if (idee.est_protegee_idee == 1) {
      img.src = "public/img/protected.jpg";
      img.alt = "Idée protégée";
    } else {
      img.src = "public/img/" + idee.visuel_idee;
      img.alt = idee.titre_idee;
    }

    divImg.appendChild(img);

    const divText = document.createElement('div');
    divText.classList.add('text');
    article.appendChild(divText);

    const divTextHaut = document.createElement('div');
    divTextHaut.classList.add('text-haut');
    divText.appendChild(divTextHaut);

    const h4 = document.createElement('h4');
    h4.classList.add('nom');
    divTextHaut.appendChild(h4);
    if (idee.est_protegee_idee == 1) {
      h4.innerText = "Cette idée est protégée";
    } else {
      h4.innerText = idee.titre_idee;
    }

    const divDomaine = document.createElement('div');
    divDomaine.classList.add('domaine');
    const h4Domaine = document.createElement('h4');
    h4Domaine.innerText = idee.libelle_idee_domaine;
    divDomaine.appendChild(h4Domaine);
    divTextHaut.appendChild(divDomaine);

    const p = document.createElement('p');
    p.classList.add('date');
    today = new Date();
    dateIdee = new Date(idee.date_creation_idee);
    dateDifference = dateDiff(dateIdee, today);
    if (dateDifference.day == 0 && dateDifference.hour == 0) {
      min_s = dateDifference.min == 1 ? " minute" : " minutes";
      p.innerText = "publié il y a " + dateDifference.min + min_s;
    } else if (dateDifference.day == 0) {
      hour_s = dateDifference.hour == 1 ? " heure" : " heures";
      p.innerText = "publié il y a " + dateDifference.hour + hour_s;
    } else {
      day_s = dateDifference.day == 1 ? " jour" : " jours";
      p.innerText = "publié il y a " + dateDifference.day + day_s;
    }

    if (page == "slider") {
      const divBtnDate = document.createElement('div');
      divBtnDate.classList.add('btn-date');

      const a = document.createElement('a');
      a.classList.add('btn-slidder');
      a.href = 'idee.php?idee=' + idee.id_idee;
      a.innerText = "Découvrir";

      divBtnDate.appendChild(p);
      divBtnDate.appendChild(a);
      divText.appendChild(divBtnDate);
    } else {
      divText.appendChild(p);
    }

    nb_likes = 0;

    ideasContainer.appendChild(article);

  }

}

function goPage(anchor){
  //window.location.replace('idee.php?idee=' + id_idee);
  anchor.click();
}

// Fonction qui calcule le nombre de minutes, heuress et jours entre 2 dates
function dateDiff(date1, date2){
  var diff = {}                           // Initialisation du retour
  var tmp = date2 - date1;

  tmp = Math.floor(tmp/1000);             // Nombre de secondes entre les 2 dates
  diff.sec = tmp % 60;                    // Extraction du nombre de secondes

  tmp = Math.floor((tmp-diff.sec)/60);    // Nombre de minutes (partie entière)
  diff.min = tmp % 60;                    // Extraction du nombre de minutes

  tmp = Math.floor((tmp-diff.min)/60);    // Nombre d'heures (entières)
  diff.hour = tmp % 24;                   // Extraction du nombre d'heures

  tmp = Math.floor((tmp-diff.hour)/24);   // Nombre de jours restants
  diff.day = tmp;

  return diff;
}

// // Fonction qui calcule le nombre de minutes, heuress et jours entre 2 dates
// function dateDiff(date1, date2){
//   var diff = {}                           // Initialisation du retour
//   var tmp = date2 - date1;

//   tmp = Math.floor(tmp/1000);             // Nombre de secondes entre les 2 dates
//   diff.sec = tmp % 60;                    // Extraction du nombre de secondes

//   tmp = Math.floor((tmp-diff.sec)/60);    // Nombre de minutes (partie entière)
//   diff.min = tmp % 60;                    // Extraction du nombre de minutes

//   tmp = Math.floor((tmp-diff.min)/60);    // Nombre d'heures (entières)
//   diff.hour = tmp % 24;                   // Extraction du nombre d'heures

//   tmp = Math.floor((tmp-diff.hour)/24);   // Nombre de jours restants
//   diff.day = tmp;

//   return diff;
// }
*/