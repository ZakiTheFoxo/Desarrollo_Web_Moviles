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

	function logSubmit(event) {
		event.preventDefault();
		var toastElList = [].slice.call(document.querySelectorAll('.toast'));
		var toastList = toastElList.map(function(toastEl) {
			return new bootstrap.Toast(toastEl,{animation: true, delay: 1000});
		});
		var data = new FormData(document.getElementById("form"));

		fetch("php/", {
			method: "POST",
			body: data
		}).then(res => {
			if (res.status != 200){ 
				throw new Error("Bad Server Response"); 
			}
			return res.json();
		}).then(res =>{
			if(res.status == 200) {
				document.location.href = "home.html";
			} 
			else {
				html=res.description;
				const elem = document.getElementById("message");
				elem.innerHTML = html;
				toastList.forEach(toast => toast.show());
			}
		}).catch(err => console.error(err));
		return false;	
	}

	jwt();

	const form = document.getElementById("form");
	form.addEventListener("submit", logSubmit);	
});