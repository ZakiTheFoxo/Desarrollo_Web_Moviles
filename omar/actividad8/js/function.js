document.addEventListener("DOMContentLoaded", function(event) {
	function loadBanner() {
		var parent = document.getElementById("carrousel");

		fetch("php/", {
			method: "GET"
		}).then(res => {
			if (res.status != 200){ 
				throw new Error("Bad Server Response"); 
			}
			return res.json();
		}).then(res =>{
			if(res.status==200){
				for (let i = 0; i < Object.keys(res).length - 1; i++) {
					const form_check = document.createElement("div");
						if (i == 0) {
							form_check.className = "carousel-item active";
						} else {
							form_check.className = "carousel-item";
						}
	
					var input = document.createElement("img");
						input.className = "d-block w-100";
						input.src = res[i].url;
						input.alt = res[i].title;
	
					form_check.appendChild(input);
					parent.appendChild(form_check);
				}
			}
		}).catch(err => console.error(err));
		return false;
	}

	function loadBanner2() {
		fetch("php/banner.php", {
			method: "GET"
		}).then(res => {
			if (res.status != 200){ 
				throw new Error("Bad Server Response"); 
			}
			return res.json();
		}).then(res =>{
			if(res.status==200){
				const elem = document.getElementById("carrousel2");
				elem.innerHTML = res.html;
			}else{
				alert("Error al recuperar datos");
			}
		}).catch(err => console.error(err));
		return false;	
	}

	loadBanner();
	loadBanner2();
});