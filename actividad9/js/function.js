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
			html = '';

			if(res.status==200){
				Object.entries(res).forEach(([key, value]) => {
					if (value != 200) {
						html += '<div class="card" style="width: 18rem;">';
						html += 	'<img class="card-img-top" src="'+ value.url +'" alt="'+ value.title +'">';
						html += 	'<div class="card-body">';
						html += 		'<h5 class="card-title">'+ value.title +'</h5>';
						html += 		'<p class="card-text">'+value.description +'</p>';
						html += 		'<a href="#" class="btn btn-primary">Ver más</a>';
						html += 	'</div>';
						html += '</div>';
					}
				});

				const container = document.getElementById("container");
				container.innerHTML = html;
			}
		}).catch(err => console.error(err));
		return false;
	}

	loadBanner();
});