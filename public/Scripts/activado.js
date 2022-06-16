window.addEventListener("DOMContentLoaded",principal);


function principal(){
    setTimeout(function(){
        location.assign("http://127.0.0.1:8000/logout");
    },4000);
}
