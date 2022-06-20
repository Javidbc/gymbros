window.addEventListener("DOMContentLoaded",principal);


function principal(){
    document.getElementById("btnMagia").addEventListener("click",cambiar);
    document.getElementById("btnMagia2").addEventListener("click",cambiar2);
}

function cambiar(e){
    var mifecha=document.getElementById("InFecha").value;
    var horario=document.getElementById("miselect").value;
    let fechaActual = new Date();
    if(mifecha){
        if(mifecha<fechaActual.toISOString().split('T')[0]){
            document.getElementById("msgValidacion").textContent="Selecciona una fecha mayor a la de hoy"
        }
        else{
            location.assign("http://127.0.0.1:8000/reservar/maquinas/"+mifecha+"/"+horario);
        }
    }
    else{
        document.getElementById("msgValidacion").textContent="Por favor elija una fecha"
    }



}
function cambiar2(e){
    var mifecha=document.getElementById("InFecha2").value;
    var horario=document.getElementById("miselect2").value;
    var aparato=document.getElementById("miselect3").value;
    let fechaActual = new Date();
    if(mifecha){
        if(mifecha<fechaActual.toISOString().split('T')[0]){
            document.getElementById("msgValidacion2").textContent="Selecciona una fecha mayor a la de hoy"
        }
        else{
            location.assign("http://127.0.0.1:8000/reservar/maquinas/"+mifecha+"/"+horario+"/"+aparato);
        }
    }
    else{
        document.getElementById("msgValidacion2").textContent="Por favor elija una fecha"
    }



}