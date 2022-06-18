window.addEventListener("DOMContentLoaded",principal);


function principal(){
    document.getElementById("btnMagia").addEventListener("click",cambiar);
}

function cambiar(e){
    var mifecha=document.getElementById("InFecha").value;
    var horario=document.getElementById("miselect").value;


    location.assign("http://127.0.0.1:8000/reservar/maquinas/"+mifecha+"/"+horario);


}