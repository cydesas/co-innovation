/*const domainCheck1 = document.querySelector('.checkbox1');
const domainCheck2 = document.querySelector('.checkbox2');
const userTypesCheck = document.querySelector('.checkbox3');
const pagination = document.querySelector('.pagination2');

var ideasContainer = document.querySelector('.ideas-container');
//var page = "grille";
var ideasPerPage = 9; // le nombre d'idées par page
var limitParams = "&limit=" + ideasPerPage;


document.addEventListener('DOMContentLoaded', () => {
    updateCheckbox();
});

async function init() {

    if(page == "grille") {
      //result = await getDomains();
      //result = await getUserTypes();
      //getFilters();

      url = apiUrl + domainParams + userParams + extraParams + "&firstTime=1" + limitParams;
    }
    else {
      url = apiUrl + domainParams + userParams + extraParams + limitParams;
    }*/
    //result = await getIdeas(url);
    //createPagination();

//}

// Récupère les domaines
/*async function getDomains() {
  await fetch('../api/domaines.php')
  .then(function (response) {

    return response.json();
  })
  .then(function (response) {

    createDomainCheck(response);

  }).catch(function (error)  {
    console.log('Il y a eu un problème avec l\'opération fetch lors de la récupération des domaines: ' + error.message);
  });  
}*/

// Crée les checkboxes des domaines
/*function createDomainCheck(domains) {
  var counter = 1;

  domainCheck1.innerHTML = "";
  domainCheck2.innerHTML = "";

  for (const domain of domains) {

    const label = document.createElement('label');
    label.classList.add('container');
    label.innerText = capitalizeFirstLetter(domain.libelle_idee_domaine);
    if(counter == 1) {
      domainCheck1.appendChild(label);
      counter = 2;
    }
    else {
      domainCheck2.appendChild(label);
      counter = 1;
    }

    const input = document.createElement('input');
    input.id = "domain" + domain.id_idee_domaine;
    input.setAttribute('type', 'checkbox');
    input.checked = 'checked';
    input.addEventListener('click', refreshGrid);
    label.appendChild(input);

    const span = document.createElement('span');
    span.classList.add('checkmark');
    label.appendChild(span);

  }
}*/

// Récupère les types d'utilisateurs
/*async function getUserTypes() {
  await fetch('../api/utilisateur_types.php')
  .then(function (response) {

    return response.json();
  })
  .then(function (response) {

    createUserCheck(response);

  }).catch(function (error) {
    console.log('Il y a eu un problème avec l\'opération fetch lors de la récupération des types d\'utilisateurs: ' + error.message);
  });  
}*/

// Crée les checkboxes des types d'utilisateurs
/*function createUserCheck(users) {

    userTypesCheck.innerHTML = "";

    for (const user of users) {

      const label = document.createElement('label');
      label.classList.add('container');
      label.innerText = capitalizeFirstLetter(user.libelle_utilisateur_type);
      userTypesCheck.appendChild(label);

      const input = document.createElement('input');
      input.id = "user" + user.id_utilisateur_type;
      input.setAttribute('type', 'checkbox');
      input.checked = 'checked';
      input.addEventListener('click', refreshGrid);
      label.appendChild(input);   
      
      const span = document.createElement('span');
      span.classList.add('checkmark');
      label.appendChild(span); 

    }
}*/

document.getElementById("filter").addEventListener("click", getFilters);
const page = document.querySelector('li.active').innerText;

function like(){
    const urlParams = new URLSearchParams(window.location.search);
    const idee = urlParams.get('idee');
    var url = "/api/like.php?idee=" + idee;
    fetch(url)
        .then(function (response) {
            return response.json();
        }).then(function (response) {
            window.location.reload("/liste-idees?idee=" + idee);
        }).catch(function (error) {
        console.log('Il y a eu un problème avec l\'opération fetch: ' + error.message);
    });
}

/**
 * Cette fonction permet de générer la chaîne de caractères qui sera ajoutée à l'URL et
 * recharge la page avec les filtres choisis
 */
function getFilters() {
    const checkBoxes = document.querySelectorAll('input[type=checkbox]');

    const apiUrl = "/liste-idees?page=1";
    var userParams = "";
    var domainParams = "";
    var extraParams = "&statut=3";

    for (const checkBox of checkBoxes) {
        if (checkBox.id.substring(0, 6) === "domain" && checkBox.checked) {
            domainId = checkBox.id.substring(6);
            if (domainParams === "") {
                domainParams = "&domaine=" + domainId;
            } else {
                domainParams += ";" + domainId;
            }
        }

        if (checkBox.id.substring(0, 4) === "user" && checkBox.checked) {
            userId = checkBox.id.substring(4);
            if (userParams === "") {
                userParams = "&type_utilisateur=" + userId;
            } else {
                userParams += ";" + userId;
            }
        }
    }
    if (domainParams === "") {
        domainParams = "";
    }
    if (userParams === "") {
        userParams = "";
    }
    //console.log(apiUrl + domainParams + userParams + extraParams)
    window.location.replace(apiUrl + domainParams + userParams + extraParams);
}


/**
 * Cette fonction permet de garder une cohérence entre les filtres choisis dans l'URL et les cases cochées dans la grille
 * de filtres (par exemple, au rechargement d'une page
 */
function updateCheckbox() {
    const urlParams = new URLSearchParams(window.location.search);
    const domainParams = urlParams.get('domaine');
    const userParams = urlParams.get('type_utilisateur');

    const checkBoxes = document.querySelectorAll('input[type=checkbox]');
    for (const checkBox of checkBoxes) {
        if (checkBox.id.substring(0, 6) === "domain") {
            domainId = checkBox.id.substring(6);
            checkBox.checked = domainParams.includes(domainId);
        }

        if (checkBox.id.substring(0, 4) === "user") {
            userId = checkBox.id.substring(4);
            checkBox.checked = userParams.includes(userId);
        }
    }
}

/*function createPagination() {

  pagination.innerHTML = "";

  let ul = document.createElement('ul');
  pagination.appendChild(ul);

  let content = 0;

  // toujours afficher : page 1, page précedente, page courante, page suivante et dernière page
  // Jusqu'à 5 pages, on aura 1 | 2 | 3 | 4 | 5 avec focus sur la page courante
  if(numPage <= 5) {
    for(let i = 1; i <= numPage; i++) {
      let li = document.createElement('li');
      li.innerText = i;
      if(i == currentPage) {
        li.classList.add('active');
      }
      else {
        li.addEventListener("click", function(){ getPage(i); } );
      }
      ul.appendChild(li);
    }
  }
  else  // ... Au delà de 5 pages, on affiche la première page, la dernière, la page courante avec la précédente et la suivante
        // et '...' après le 1 si page courante est supérieure à 3 et '...' avant la dernière page si page courante est inférieure à dernière page - 2
  {
    // première page
    let li = document.createElement('li');
    li.innerText = "1";
    if(currentPage == 1) {
      li.classList.add('active');
    }
    else {
      li.addEventListener("click", function(){ getPage(1); } );
    }
    ul.appendChild(li);    

    content = currentPage - 1;
    // Si page précedente à la courante > 1, on affiche les ...
    if(content > 2) {
      li = document.createElement('li');
      li.innerText = '...';
      ul.appendChild(li);         
    }

    // Page précedente
    if(currentPage > 2) {
      li = document.createElement('li');
      li.addEventListener("click", function(){ getPage(content); } );
      li.innerText = content;
      ul.appendChild(li);     
    }

    // Page courante
    if(currentPage > 1) {
      li = document.createElement('li');
      li.innerText = currentPage;
      li.classList.add('active');
      ul.appendChild(li); 
    }

    // page suivante
    content2 = currentPage + 1;
    if(content2 < numPage) {
      li = document.createElement('li');
      li.addEventListener("click", function(){ getPage(content2); } );
      li.innerText = content2;
      ul.appendChild(li);   
    }

    // Si page suivante < dernière page, on affiche les ...
    if(content2 < numPage - 1) {
      li = document.createElement('li');
      li.innerText = '...';
      ul.appendChild(li);   
    }

    // dernière page
    if(numPage > 4 && currentPage != numPage){
      li = document.createElement('li');
      li.innerText = numPage;
      li.addEventListener("click", function(){ getPage(numPage); } );
      ul.appendChild(li);   
    } 
  }

}*/

// rafrîchit la grille des idées
/*function refreshGrid() {

  getFilters();

  getIdeas(apiUrl + domainParams + userParams + extraParams + limitParams).then(
    createPagination
  );

}*/

// Récupère une page spécifique
/*function getPage(pageNumber) {

  currentPage = pageNumber;
  limitParams = "&limit=" + (pageNumber - 1) * parseInt(ideasPerPage) + ';' + ideasPerPage;

  getIdeas(apiUrl + domainParams + userParams + extraParams + limitParams).then(
    createPagination
  );

}*/

// Fonction qui met la première lettre en majuscule
/*function capitalizeFirstLetter(string) {
  return string.charAt(0).toUpperCase() + string.slice(1);
}*/
