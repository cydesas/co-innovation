
var timeout;

document.addEventListener('DOMContentLoaded', () => {
    timeout = setTimeout(goHome, 3000);
});

function goHome() {
    clearTimeout(timeout);
    window.location.replace('index.php');
}