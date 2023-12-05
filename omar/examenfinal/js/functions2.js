document.addEventListener("DOMContentLoaded", function(event) {
    function loadCards() { 
        fetch("php/", {
            method: "GET"
        }).then(res => {
            if (res.status != 200){ 
                throw new Error("Bad Server Response"); 
            }
            return res.json();
        }).then(res =>{
            if(res.status == 200) {
                const container = document.getElementById("carrousel");
                var flag = true;

                var shuffled = shuffle(Object.keys(res));

                Object.entries(shuffled).forEach(([key, value]) => {
                    if(res[value] != 200){
                        const form_check = document.createElement("div");

                        if (flag) {
                            form_check.className = "carousel-item active";
                            flag = false;
                        } else {
                            form_check.className = "carousel-item";
                        }

                        var input = document.createElement("img");
                            input.className = "d-block";
                            input.src = "img/"+res[value].img;
                            input.alt = res[value].name;

                        form_check.appendChild(input);
                        container.appendChild(form_check);
                    }
                });
            }
            else {
                console.log('Error :>> ', res.description);
            }
        }).catch(err => console.error(err));
        return false;
    }

    function shuffle(array) {
        let currentIndex = array.length,  randomIndex;
      
        // While there remain elements to shuffle.
        while (currentIndex > 0) {
      
          // Pick a remaining element.
          randomIndex = Math.floor(Math.random() * currentIndex);
          currentIndex--;
      
          // And swap it with the current element.
          [array[currentIndex], array[randomIndex]] = [
            array[randomIndex], array[currentIndex]];
        }
      
        return array;
    }
      

    function generateBoard() { 
        fetch("php/", {
            method: "GET"
        }).then(res => {
            if (res.status != 200){ 
                throw new Error("Bad Server Response"); 
            }
            return res.json();
        }).then(res =>{
            if(res.status == 200) {
                const container = document.getElementById("grid");
                    container.innerHTML = "";
                var i = 1;

                var shuffled = shuffle(Object.keys(res));

                Object.entries(shuffled).forEach(([key, value]) => {
                    if(res[value] != 200){
                        const form_check = document.createElement("div");
                            form_check.className = `grid_${i}`;

                        var input = document.createElement("img");
                            input.src = "img/"+res[value].img;
                            input.alt = res[value].name;

                        form_check.appendChild(input);
                        container.appendChild(form_check);

                        i++;

                        if(i > 16) {
                            throw false;
                        }
                    }
                });
            }
            else {
                console.log('Error :>> ', res.description);
            }
        }).catch(err => console.error(err));
        return false;
    }
    
    loadCards();

    generateBoard();

    document.getElementById('btn_generate').addEventListener('click', generateBoard);
});