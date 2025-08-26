var fileobj;
var hiddenImgSrc = document.querySelector("#hiddenImgSrc");
if(hiddenImgSrc != null) {
  if(hiddenImgSrc.value != "") {
    drop_file_zone = document.querySelector('#drop_file_zone');
    drop_file_zone.style.backgroundSize = "contain";
    drop_file_zone.style.backgroundImage = "url('../img/"+ hiddenImgSrc.value +"')";
  }
}
var hiddenImgSrc2 = document.querySelector("#hiddenImgSrc2");
if(hiddenImgSrc2 != null) {
  if(hiddenImgSrc2.value != "") {
    drop_file_zone2 = document.querySelector('#drop_file_zone2');
    drop_file_zone2.style.backgroundSize = "contain";
    drop_file_zone2.style.backgroundImage = "url('../img/"+ hiddenImgSrc2.value +"')";
  }
}

const passInput= document.querySelector('#password');
const passInput2= document.querySelector('#password2');
const soumission = document.querySelector('#soumission');
if(passInput != null && passInput2 != null && soumission != null) {
  soumission.addEventListener('click', checkPassword);
}

function checkPassword(e) {

  errorString = "";
  error = false;

  password = passInput.value;
  password2 = passInput2.value;

  // Vérification de la taille du mot de passe
  if(password.length < 8) {
    errorString = "Erreur : Le mot de passe doit faire au moins 8 caractères";
    error = true;
  }

  // Vérification de la présence d'une minuscule
  if(!/[a-z]/.test(password)) {
    if(errorString == "")
      errorString = "Erreur : Le mot de passe doit contenir une minuscule";
      else 
        errorString += ", doit contenirune minuscule";
    error = true;
  }

  // Vérification de la présence d'une majuscule
  if(!/[A-Z]/.test(password)) {
    if(errorString == "")
      errorString = "Erreur : Le mot de passe doit contenir une majuscule";
    else 
      errorString += ", doit contenir une majuscule";
    error = true;
  }

  // Vérification de la présence d'un chiffre
  if(!/[0-9]/.test(password)) {
    if(errorString == "")
      errorString = "Erreur : Le mot de passe doit contenir un chiffre";
    else 
      errorString += ", doit contenir un chiffre";
    error = true;
  }

  // Vérification de la présence d'un caractère spécial
  if(!/[@$!%*#&]/.test(password)) {
    if(errorString == "")
      errorString = "Erreur : Le mot de passe doit contenir un caractère spécial";
    else 
      errorString += ", doit contenir un caractère spécial";
    error = true;
  }

  // Si mot de passe et confirmation de mot de passe sont différents
  if(password != password2){
    if(errorString == "")
      errorString = "Erreur : Le mot de passe et sa confirmation doivent être identiques";
    else 
      errorString += ", le mot de passe et sa confirmation doivent être identiques";
  }

  if(error){
    e.preventDefault
    alert(errorString);
    passInput.focus();
  }
}

function upload_file(e, drop_file_zone, hiddenImg) {    
  console.log('function upload_file');
  console.log('drop_file_zone : ' + drop_file_zone);
  console.log('hiddenImg : ' + hiddenImg);
    e.preventDefault();
    fileobj = e.dataTransfer.files[0];
    ajax_file_upload(fileobj, drop_file_zone, hiddenImg);
  }
  
function file_explorer(selectfile, drop_file_zone, hiddenImg) {
  console.log('function file_explorer');
  console.log('selectfile : ' + selectfile);
  console.log('drop_file_zone : ' + drop_file_zone);
  console.log('hiddenImg : ' + hiddenImg);
  document.getElementById(selectfile).click();
  document.getElementById(selectfile).onchange = function() {
      fileobj = document.getElementById(selectfile).files[0];
      ajax_file_upload(fileobj, drop_file_zone, hiddenImg);
  };
}

function ajax_file_upload(file_obj, drop_file_zone, hiddenImg) {
    console.log('function ajax_file_upload');
    console.log('drop_file_zone : ' + drop_file_zone);
    console.log('hiddenImg : ' + hiddenImg);
    if(file_obj != undefined) {
        var form_data = new FormData();                  
        form_data.append('file', file_obj);
        var xhttp = new XMLHttpRequest();
        xhttp.open("POST", "../api/upload.php", true);
        xhttp.onload = function(event) {
            oOutput = document.querySelector(drop_file_zone);
            if (xhttp.status == 200) {
              if(this.responseText.indexOf("#error") == -1) {
                oOutput.style.backgroundSize = "contain";
                oOutput.style.backgroundImage = "url('public/img/"+ this.responseText +"')";
                hiddenImgSrc = document.querySelector(hiddenImg);
                hiddenImgSrc.value = this.responseText.replace("img/", "");
              }
              else {
                alert(this.responseText.replace("#error", ""));
              }
            } else {
                //oOutput.innerHTML = "Error " + xhttp.status + " occurred when trying to upload your file.";
                oOutput.innerHTML = "";
                alert("Erreur " + xhttp.status);
            }
        }
  
        xhttp.send(form_data);
    }
  }
  