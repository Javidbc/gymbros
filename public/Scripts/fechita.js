window.addEventListener("DOMContentLoaded",principal);


function principal(){
    document.getElementById("btnMagia").addEventListener("click",cambiar);
}

function cambiar(e){
    var mifecha=document.getElementById("InFecha").value;
    var miUsuario=document.getElementById("idUsuario").textContent;


    location.assign("http://127.0.0.1:8000/series/verSeries/"+miUsuario+"/"+mifecha);


}