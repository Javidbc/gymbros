window.addEventListener("DOMContentLoaded",principal);



function principal(){
    var btnMenu=document.getElementById("menu");
    console.log("hola");
    if(btnMenu){
        btnMenu.addEventListener("click",cambio);
    }

}

function cambio(){
    console.log("cambiio")
    document.getElementById("miMenu").classList.toggle("oculto");
}


