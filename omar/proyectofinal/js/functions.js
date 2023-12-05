document.addEventListener("DOMContentLoaded", function(event) {
	function jwt(){
		const formData  = new FormData();
		formData.append("jwt", true);
		fetch("php/jwt/", {
			method: "POST",
			body: formData
		}).then(res => {
			if (res.status != 200){ throw new Error("Bad Server Response"); }
			return res.json();
		}).then(res =>{
			if(res.status==200){
				document.getElementById('jwt').value = res.jwt;
			}
		}).catch(err => console.error(err));
	}

	function getUserList() {
		const userlist = document.getElementById("select_names");
			userlist.innerHTML = "";

		fetch("php/", {
			method: "GET"
		}).then(res => {
			if (res.status != 200){ 
				throw new Error("Bad Server Response"); 
			}
			return res.json();
		}).then(res =>{
			if(res.status == 200) {
				Object.entries(res).forEach(([key, value]) => {
					if (value != 200) {
						var option = document.createElement("option");
							option.innerHTML = value.name;
						userlist.appendChild(option);
					}
				});
			}
		}).catch(err => console.error(err));
		return false;	
	}

	function getIconList() {
		const iconlist = document.getElementById("social_list");

		fetch("php/iconlist.php", {
			method: "GET"
		}).then(res => {
			if (res.status != 200){ 
				throw new Error("Bad Server Response"); 
			}
			return res.json();
		}).then(res =>{
			if(res.status == 200) {
				Object.entries(res).forEach(([key, value]) => {
					if (value != 200) {
						var div = document.createElement("div");
							div.className  = "form-check social_check";
							div.innerHTML = `<input class="form-check-input" type="checkbox" name="social[]" value="${value.id_icon}" id="${value.id_icon}"> <label for="${value.id_icon}"><i class="${value.icon}"></i></label> <input class="form-control" name="url_${value.id_icon}" id="input_${value.id_icon}" disabled required>`;
							iconlist.appendChild(div);
						document.getElementById(`${value.id_icon}`).addEventListener("click", toggleInput);
					}
				});
			}
		}).catch(err => console.error(err));
		return false;
	}

	function toggleInput(check) {
		var checkbox = document.getElementById(check.currentTarget.value)
		
		if(checkbox.checked == true){
			document.getElementById(`input_${checkbox.value}`).disabled = false;
		} else {
			document.getElementById(`input_${checkbox.value}`).disabled = true;
			document.getElementById(`input_${checkbox.value}`).value = "";
		}
	}

	function searchUser() {
		let search = document.getElementById("select_names").value;
		search = search.replace(/ /g,"+");
		search = new URLSearchParams(`name=${search}`);

		fetch(`php/search.php?${search}`, {
			method: "GET"
		}).then(res => {
			if (res.status != 200){ throw new Error("Bad Server Response"); }
			return res.json();
		}).then(res =>{
			if(res.status==200){
				if(res.isLoggedIn) {
					document.getElementById("btn_modify").removeEventListener("click", waiting);
					document.getElementById("btn_delete").removeEventListener("click", waiting);
					document.getElementById("btn_modify").addEventListener("click", modifyUserModal);
					document.getElementById("btn_modify").value = search;
					document.getElementById("btn_delete").addEventListener("click", deleteUserModal);
				}
				document.getElementById("cv").style.display = 'flex';
				Object.entries(res).every(([key, value]) => {
					if(value != 200) {
						// Insert link
						const link = document.getElementById("link");
							link.href = `search.html?${search}`;
							link.target = `_blank`;
							link.setAttribute("onclick", "");

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
							html_social += `<a href="${social.url}" target="_blank"><i class="${social.icon}"></i></a>`;
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

	function validate(){
		const formData  = new FormData();
		fetch("php/validate.php", {
			method: "POST",
			body: formData
		}).then(res => {
			if (res.status != 200){ throw new Error("Bad Server Response"); }
			return res.json();
		}).then(res =>{
			if(res.status==200){
				// Log in/out
				document.getElementById("btn_login").style.display = 'none';
				document.getElementById("btn_logout").style.display = 'block';

				// Admin buttons
				let buttons = document.getElementById("buttons");

				let btn = document.createElement("button");
					btn.className = "btn btn-success btn_admin";
					btn.id = "btn_add";
					btn.innerHTML = "<i class='fa-solid fa-plus'>";

				buttons.appendChild(btn);

					btn = document.createElement("button");
					btn.className = "btn btn-warning btn_admin";
					btn.id = "btn_modify";
					btn.innerHTML = "<i class='fa-solid fa-pen'>";

				buttons.appendChild(btn);

					btn = document.createElement("button");
					btn.className = "btn btn-danger btn_admin";
					btn.id = "btn_delete";
					btn.innerHTML = "<i class='fa-solid fa-trash'>";

				buttons.appendChild(btn);

				document.getElementById("btn_add").addEventListener("click", addUserModal);
				document.getElementById("btn_modify").addEventListener("click", waiting);
				document.getElementById("btn_delete").addEventListener("click", waiting);
			}
		}).catch(err => console.error(err));
	}

	function waiting() {
		alert("A user hasn't been loaded yet");
	}

	function logOut(){
		const formData = new FormData();
		formData.append("salir", true);
		fetch("php/close.php", {
			method: "POST",
			body: formData
		}).then(res => {
			if (res.status != 200){ throw new Error("Bad Server Response"); }
			return res.json();
		}).then(res =>{
			if(res.status==200){
				alert("Log Out Successful");
				window.location.reload();
			}else{
				alert("Error");
			}
		}).catch(err => console.error(err));		
	}

	function clearModal() {
		document.getElementById("img_form_container").innerHTML = "";
		var img = document.createElement("input");
			img.type = "file";
			img.name = "img";
			img.id = "img";
			img.className = "form-control";
			img.accept = "image/*";
		document.getElementById("img_form_container").appendChild(img);
		document.getElementById("name").value = "";
		document.getElementById("age").value = "";
		document.getElementById("job").value = "";
		document.getElementById("status").value = "";
		document.getElementById("city").value = "";
		document.getElementById("input_quote").value = "";
		document.getElementById("input_about").value = "";
		document.getElementById("objective_list").innerHTML = "";
		document.getElementById("need_list").innerHTML = "";
		for(i = 1; i <= 4; i++) {
			document.getElementById("input_feature" + i).value = "";
			document.getElementById("input_competency" + i).value = "";
		}
		document.getElementById("social_list").innerHTML = "";

		form.removeEventListener("submit", addUser);
		form.removeEventListener("submit", modifyUser);
	}

	function addUserModal() {
		let title = document.getElementById("title");
			title.innerHTML = "Add a New User";
		let button = document.getElementById("btn_submit");
			button.innerHTML = "Add User";

		getIconList();

		form.addEventListener("submit", addUser);
		modal_form.show();
	}

	function modifyUserModal(data) {
		let title = document.getElementById("title");
			title.innerHTML = "Modify an Existing User";
		let button = document.getElementById("btn_submit");
			button.innerHTML = "Modify User";

		getIconList();

		var search = data.currentTarget.value;

		fetch(`php/search.php?${search}`, {
			method: "GET"
		}).then(res => {
			if (res.status != 200){ throw new Error("Bad Server Response"); }
			return res.json();
		}).then(res =>{
			if(res.status==200){
				Object.entries(res).every(([key, value]) => {
					if(value != 200) {
						document.getElementById('hidden_id').value = value.id_user;
						document.getElementById('hidden_img').value = value.img;
						document.getElementById('name').value = value.name;
						document.getElementById('age').value = value.age;
						document.getElementById('job').value = value.job;
						document.getElementById('status').value = value.marital;
						document.getElementById('city').value = value.city;
						document.getElementById('input_quote').value = value.quote;
						document.getElementById('input_about').value = value.about;
						var obj_list = document.getElementById('objective_list');
						Object.entries(value.objectives).forEach(([key, objective]) => {
							var obj = document.createElement("li");
								obj.innerHTML = `<input type="text" name="objectives[]" class="form-control" value="${objective.objective}" required>`;

							obj_list.appendChild(obj);
						});
						var need_list = document.getElementById('need_list');
						Object.entries(value.needs).forEach(([key, need]) => {
							var nee = document.createElement("li");
								nee.innerHTML = `<input type="text" name="needs[]" class="form-control" value="${need.need}" required>`;

							need_list.appendChild(nee);
						});
						document.getElementById('input_feature1').value = value.features.scale1;
						document.getElementById('input_feature2').value = value.features.scale2;
						document.getElementById('input_feature3').value = value.features.scale3;
						document.getElementById('input_feature4').value = value.features.scale4;
						document.getElementById('input_competency1').value = value.competency.scale1;
						document.getElementById('input_competency2').value = value.competency.scale2;
						document.getElementById('input_competency3').value = value.competency.scale3;
						document.getElementById('input_competency4').value = value.competency.scale4;
						Object.entries(value.social).forEach(([key, social]) => {
							var scl = document.getElementById(`${social.id_icon}`);
								scl.checked = true;
							document.getElementById('input_'+social.id_icon).disabled = false;
							document.getElementById('input_'+social.id_icon).value = social.url;
						});
					}
					return false;
				});
			} else {
				alert("No se encontraron resultados.");
			}
		}).catch(err => console.error(err));


		form.addEventListener("submit", modifyUser);
		modal_form.show();
	}

	function deleteUserModal() {
		modal_delete.show();
	}

	function addUser(event) {
		event.preventDefault();
		var data = new FormData(document.getElementById("form"));

		fetch("php/adduser.php", {
			method: "POST",
			body: data
		}).then(res => {
			if (res.status != 200){ 
				throw new Error("Bad Server Response"); 
			}
			return res.json();
		}).then(res =>{
			if(res.status == 200) {
				alert("User added successfully");
			} else {
				alert("Failed to add new user information: " + res.description);
			}

			modal_form.hide();
			form.removeEventListener("submit", addUser);
			clearModal();
			getUserList();
		}).catch(err => console.error(err));
		return false;	
	}

	function modifyUser(event) {
		event.preventDefault();
		var data = new FormData(document.getElementById("form"));

		fetch("php/modifyuser.php", {
			method: "POST",
			body: data
		}).then(res => {
			if (res.status != 200){ 
				throw new Error("Bad Server Response"); 
			}
			return res.json();
		}).then(res =>{
			if(res.status == 200) {
				alert("User updated successfully");
			} else {
				alert("Failed to update user information: " + res.description);
			}

			modal_form.hide();
			form.removeEventListener("submit", modifyUser);
			clearModal();
			getUserList();
		}).catch(err => console.error(err));
		return false;
	}

	function deleteUser() {
		let search = document.getElementById("select_names").value;
			search = search.replace(/ /g,"+");
			search = new URLSearchParams(`name=${search}`);

		fetch(`php/deleteuser.php?${search}`, {
			method: "DELETE"
		}).then(res => {
			if (res.status != 200){ 
				throw new Error("Bad Server Response"); 
			}
			return res.json();
		}).then(res =>{
			if(res.status == 200) {
				alert("User deleted successfully");
			} else {
				alert("Failed to delete user: " + res.description);
			}

			modal_delete.hide();
			getUserList();
		}).catch(err => console.error(err));
		return false;	
	}

	function addObjective() {
		let objective_list = document.getElementById("objective_list");
			
		let objective = document.createElement("li");
			objective.innerHTML = '<input type="text" name="objectives[]" class="form-control" required>';

		objective_list.appendChild(objective);
	}

	function addNeed() {
		let need_list = document.getElementById("need_list");
			
		let need = document.createElement("li");
			need.innerHTML = '<input type="text" name="needs[]" class="form-control" required>';

		need_list.appendChild(need);
	}

	validate();
	jwt();
	getUserList();

	document.getElementById('btn_search').addEventListener('click', searchUser, false);
	document.getElementById('btn_logout').addEventListener('click', logOut, false);

	document.getElementById('btn_cancel').addEventListener('click', clearModal, false);
	document.getElementById('btn_del_user').addEventListener('click', deleteUser, false);

	document.getElementById('btn_objective').addEventListener('click', addObjective, false)
	document.getElementById('btn_need').addEventListener('click', addNeed, false)

	const modal_form = new bootstrap.Modal('#modal_form');
	const modal_delete = new bootstrap.Modal('#modal_delete');
	const form = document.getElementById("form");
});