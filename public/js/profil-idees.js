/*var profil = document.querySelector('.profil');
var page = "profil";
var ideasPerPage = "3";
var statut = "3";


utilisateur = document.querySelector('#utilisateur');

const apiUrl = "api/idees?";
var userParams = "";
var domainParams = "";
var extraParams = "&statut=";
var limitParams = "&limit=" + ideasPerPage;

var userParams = "&utilisateur=" + utilisateur.value;



document.addEventListener('DOMContentLoaded', () => {

  // url = apiUrl + domainParams + userParams + extraParams + statut + limitParams + userParams;

  // getIdeas(url).then(
  //   createPagination
  // );

  init();

});


async function init() {
  pagination = document.querySelector('#pagination');
  ideasContainer = document.querySelector('.ideas-container');
  statut = "3";
  url = apiUrl + domainParams + userParams + extraParams + statut + limitParams + userParams;
  result = await getIdeas(url);
  createPagination(1);

  pagination = document.querySelector('#pagination2');
  if(pagination != null){
    ideasContainer = document.querySelector('.ideas-container2');
    statut = "1";
    url = apiUrl + domainParams + userParams + extraParams + statut + limitParams + userParams;

    result = await getIdeas(url);

    createPagination(2);

    pagination = document.querySelector('#pagination3');
    ideasContainer = document.querySelector('.ideas-container3');
    statut = "2";
    url = apiUrl + domainParams + userParams + extraParams + statut + limitParams + userParams;

    result = await getIdeas(url);

    createPagination(3);
  }

 }

async function createPagination(numContainer) {

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
        li.addEventListener("click", function(){ getPage(i, numContainer); } );
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
      li.addEventListener("click", function(){ getPage(1, numContainer); } );
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
      li.addEventListener("click", function(){ getPage(content, numContainer); } );
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
      li.addEventListener("click", function(){ getPage(content2, numContainer); } );
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
      li.addEventListener("click", function(){ getPage(numPage, numContainer); } );
      ul.appendChild(li);   
    } 
  }

  await console.log('waiting...');
}

async function getPage(pageNumber, numContainer) {

  switch(numContainer) {
    case 1:
      pagination = document.querySelector('#pagination');
      ideasContainer = document.querySelector('.ideas-container');
      statut = "3";
      break;

    case 2:
      pagination = document.querySelector('#pagination2');
      ideasContainer = document.querySelector('.ideas-container2');
      statut = "1";
      break;

    case 3:
      pagination = document.querySelector('#pagination3');
      ideasContainer = document.querySelector('.ideas-container3');
      statut = "2";
      break;
  }

  currentPage = pageNumber;
  limitParams = "&limit=" + (pageNumber - 1) * parseInt(ideasPerPage) + ';' + ideasPerPage;
  
  result = await getIdeas(apiUrl + domainParams + userParams + extraParams + statut + limitParams);
  createPagination(numContainer);
  
}*/