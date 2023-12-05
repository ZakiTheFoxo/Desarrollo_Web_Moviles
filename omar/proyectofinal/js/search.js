document.addEventListener("DOMContentLoaded", function(event) {
	function searchUser(search) {
		fetch(`php/search.php?name=${search}`, {
			method: "GET"
		}).then(res => {
			if (res.status != 200){ throw new Error("Bad Server Response"); }
			return res.json();
		}).then(res =>{
			if(res.status==200){
				document.getElementById("cv").style.display = 'flex';
				Object.entries(res).every(([key, value]) => {
					if(value != 200) {
						// Insert img
						const img = document.getElementById("img");
							img.innerHTML = "";
						let html_img = document.createElement("img");
							html_img.src = "img/"+value.img;

						img.appendChild(html_img);

						// Insert info
						const info = document.getElementById("info");
							info.innerHTML = "";
						let html_info = `
							<h1>
								${value.name}
							</h1>
							<p>
								<b>Age: </b>${value.age}
							</p>
							<p>
								<b>Job: </b>${value.job}
							</p>
							<p>
								<b>Marital Stauts: </b>${value.marital}
							</p>
							<p>
								<b>City: </b>${value.city}
							</p>`; 

						info.innerHTML = html_info;

						// Insert quote
						const quote = document.getElementById("quote");
							quote.innerHTML = "";
						let html_quote = value.quote;

						quote.innerHTML = html_quote;

						// Insert about
						const about = document.getElementById("about");
							about.innerHTML = "";
						let html_about = value.about;

						about.innerHTML = html_about;

						// Insert objectives
						const objectives = document.getElementById("objectives");
							objectives.innerHTML = "";
						let html_objectives = "";

						Object.entries(value.objectives).forEach(([key, objective]) => {
							html_objectives += `<li>${objective.objective}</li>`;
						});

						objectives.innerHTML = html_objectives;

						// Insert needs
						const needs = document.getElementById("needs");
							needs.innerHTML = "";
						let html_needs = "";

						Object.entries(value.needs).forEach(([key, need]) => {
							html_needs += `<li>${need.need}</li>`;
						});

						needs.innerHTML = html_needs;

						// Personal Features
						const feature1 = document.getElementById("feature1");
							feature1.value = value.features.scale1;
						const feature2 = document.getElementById("feature2");
							feature2.value = value.features.scale2;
						const feature3 = document.getElementById("feature3");
							feature3.value = value.features.scale3;
						const feature4 = document.getElementById("feature4");
							feature4.value = value.features.scale4;

						// Competency
						const competency1 = document.getElementById("competency1");
							competency1.value = value.competency.scale1;
						const competency2 = document.getElementById("competency2");
							competency2.value = value.competency.scale2;
						const competency3 = document.getElementById("competency3");
							competency3.value = value.competency.scale3;
						const competency4 = document.getElementById("competency4");
							competency4.value = value.competency.scale4;

						// Social 
						const social = document.getElementById("social");
							social.innerHTML = "";
						let html_social = "";

						Object.entries(value.social).forEach(([key, social]) => {
							html_social += `<a href="${social.url}"><i class="${social.icon}"></i></a>`;
						});

						social.innerHTML = html_social;

					}
					return false;
				});
			} else {
				alert("No se encontraron resultados.");
			}
		}).catch(err => console.error(err));
	}

    var search = window.location.search; 
        search = search.substring(search.indexOf("=")+1);

        console.log('search :>> ', search);

    searchUser(search);
});