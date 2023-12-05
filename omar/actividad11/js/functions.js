document.addEventListener("DOMContentLoaded", function(event) {
	function logSubmit(event) {
		event.preventDefault();
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
			} else if(res.status == 400) {
				var toast = new bootstrap.Toast(document.getElementById("email-error"));
				toast.show();
			} else {
				var toast = new bootstrap.Toast(document.getElementById("email_pass-error"));
				toast.show();
			}
		}).catch(err => console.error(err));
		return false;	
	}

	const form = document.getElementById("form");
	form.addEventListener("submit", logSubmit);	
});