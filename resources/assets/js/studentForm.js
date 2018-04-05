function changeColor(x) {
    
    if(x.style.backgroundColor == ""){
      
      x.style.backgroundColor = "#E439A1";
    }else{
    x.style.backgroundColor = "";  
    }

//console.log(x);
    
}

function submit(){
document.getElementById("form").innerHTML='<h1 align="center">Thanks!</h1>';
}