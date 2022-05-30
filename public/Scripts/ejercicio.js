window.addEventListener("DOMContentLoaded",principal);


function principal(){
    document.getElementById("miselect").addEventListener("change",cambiar);
}

function cambiar(e){
    var eleccion=e.target.value;
    var gruposMusculares = document.getElementsByClassName("carta_grupoMuscular");
    for (let i=0; i<=gruposMusculares.length;i++) {
        if(eleccion==="Mostrar todos"){
            gruposMusculares[i].parentElement.style.display="block"
        }
        else{
            if(gruposMusculares[i].textContent.indexOf(eleccion)===-1){
                gruposMusculares[i].parentElement.style.display="none"
            }
            else{
                gruposMusculares[i].parentElement.style.display="block"
            }
        }

    }


}