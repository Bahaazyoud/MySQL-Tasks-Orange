    let button = document.getElementsByClassName("seemore")
    let less = document.querySelectorAll('.product-description') 
    let more = document.querySelectorAll('.full_description') 
    for (let index = 0; index < button.length; index++) {
        button[index].onclick = function fullDescription(){
                if(this.innerHTML == 'See more'){
                this.innerHTML = "See less"
                less[index].style.display = "none";
                more[index].style.display = "block";
                // this[index].style.display ="none"
            }else{
                this.innerHTML = "See more"
                less[index].style.display = "block";
                more[index].style.display = "none";
            }
        }
    }