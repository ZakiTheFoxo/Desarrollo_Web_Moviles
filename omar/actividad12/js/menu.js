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

    function loadHeader(event) {
        fetch("php/menu.php", {
            method: "GET"
        }).then(res => {
            if (res.status != 200){ 
                throw new Error("Bad Server Response"); 
            }
            return res.json();
        }).then(res =>{
            html = '';
            if(res.status == 200) {
    
                Object.entries(res).forEach(([key, value]) => {
                    if(value != 200) {
                        html += '<li>';
                        html += '	<a href="' + value.url + '" class="nav-link text-white">';
                        html += '		<fa class="' + value.icono + '" height="24"><use xlink:href="' + value.url + '"/></fa>';
                        html += '			' + value.nombre + '';
                        html += '	</a>';
                        html += '</li>';
                    }
                });
    
                const container = document.getElementById("home");
                container.innerHTML = html;
            }
        }).catch(err => console.error(err));
        return false;	
    }

    function deleteRow() {
        alert("bark");
        console.log("bark");
    }

    function loadTable(event) {
        fetch("php/table.php", {
            method: "GET"
        }).then(res => {
            if (res.status != 200){ 
                throw new Error("Bad Server Response"); 
            }
            return res.json();
        }).then(res =>{
            html = '';
            if(res.status == 200) {
                Object.entries(res).forEach(([key, value]) => {
                    if(value != 200) {
                        
                        html += '<tr>';
                        html += '   <td>' + value.id + '</td>';
                        html += '   <td>' + value.nombre + '</td>';
                        html += '   <td>' + value.nacimiento + '</td>';
                        html += '   <td>' + value.nombre_puesto + '</td>';
                        html += '   <td>';
                        html += '        <button class="btn btn-warning"><i class="fa-solid fa-pencil"></i></button>';
                        html += '        <button class="btn btn-danger" onclick=""><i class="fa-solid fa-trash"></i></button>';
                        html += '   </td>';
                        html += '</tr>';
                    }
                });

                const container = document.getElementById("tbody");
                container.innerHTML = html;
                new DataTable('#tabla');
            }
        }).catch(err => console.error(err));
        return false;	
    }
    
    jwt();
    loadHeader();
    loadTable();
});