window.addEventListener("DOMContentLoaded",principal);


function principal(){
    document.getElementById("btnMagia").addEventListener("click",cambiar);
}

function cambiar(e){
    var miUsuario=document.getElementById("idUsuario").textContent;
    var mifecha=document.getElementById("InFecha").value;
    let fechaActual = new Date();

    if(mifecha){
        if(mifecha>fechaActual.toISOString().split('T')[0]){
            document.getElementById("msgValidacion").textContent="Selecciona una fecha menor a la de hoy"
        }
        else{
        location.assign("http://127.0.0.1:8000/series/verSeries/"+miUsuario+"/"+mifecha);
        }
    }
    else{
        document.getElementById("msgValidacion").textContent="Por favor elija una fecha"
    }




}