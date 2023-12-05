document.addEventListener("DOMContentLoaded", function(event) {
    function loadTable() {
        const container = document.getElementById("tbody");
        
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
                    if(value != 200) {
                        var html = document.createElement("tr");
                            html.innerHTML = `
                            <td id="num_${value.id}">${value.num}</td>
                            <td id="name_${value.id}">${value.name}</td>
                            <td><img src="img/${value.img}" id="img_${value.id}" alt="${value.img}"></td>
                            <td>
                                <button class="btn btn-warning" id="edit_${value.id}" value="${value.id}"><i class="fa-solid fa-pencil"></i></button>
                                <button class="btn btn-danger" id="del_${value.id}" data-id="${value.id}"><i class="fa-solid fa-trash"></i></button>
                            </td>
                            `;
                        container.appendChild(html);
                        var edit = document.getElementById(`edit_${value.id}`);
                            edit.addEventListener('click', modifyUserModal);
                            edit.value = value.id;

                        var del = document.getElementById(`del_${value.id}`);
                            del.addEventListener('click', deleteUserModal);
                            del.value = value.id;
                    }
                });

            }
            else {
                console.log('Error :>> ', res.description);
            }
        }).catch(err => console.error(err));
        return false;	
    }

    function modifyUserModal(event) {
        let id = event.currentTarget.value;

        document.getElementById('modify_img').innerHTML = document.getElementById(`img_${id}`).alt;
        document.getElementById('hidden_img').value = document.getElementById(`img_${id}`).alt;
        document.getElementById('modify_num').value = document.getElementById(`num_${id}`).innerHTML;
        document.getElementById('modify_name').value = document.getElementById(`name_${id}`).innerHTML;
        document.getElementById('card_id').value = id;
		modal_form.show();
	}

	function deleteUserModal(event) {
        let id = event.currentTarget.value;
        document.getElementById('delete_id').value = id;
		modal_delete.show();
	}

    function searchLottery() {
        let search = document.getElementById("search").value;
			search = search.replace(/ /g,"+");
			search = new URLSearchParams(`search=${search}`);

        const container = document.getElementById("result");

		fetch(`php/searchlottery.php?${search}`, {
			method: "GET"
		}).then(res => {
			if (res.status != 200){ 
				throw new Error("Bad Server Response"); 
			}
			return res.json();
		}).then(res =>{
			if(res.status == 200) {
                container.innerHTML = "";
                Object.entries(res).forEach(([key, value]) => {
                    if(value != 200){
                        var div = document.createElement("div");
                            div.className = "result_container";
                            
                        var title = document.createElement("h5");
                        title.innerHTML = `No. ${value.num}: `+value.name;
                        
                        var img = document.createElement("img");
                        img.className = "search_img";
                        img.src = `img/${value.img}`;
                        
                        div.appendChild(title);
                        div.appendChild(img);
    
                        container.appendChild(div);
                    }
                });
			} else {
				alert("No se encontraron resultados");
			}
		}).catch(err => console.error(err));
		return false;	
    }

    function addLottery(event) {
        event.preventDefault();
        var data = new FormData(document.getElementById("create_form"));
        fetch("php/addlottery.php", {
            method: "POST",
            body: data
        }).then(res => {
            if (res.status != 200){ 
                throw new Error("Bad Server Response"); 
            }
            return res.json();
        }).then(res =>{
            if(res.status == 200) {
                alert("Tarjeta agregada correctamente");
                document.getElementById("tbody").innerHTML = "";
                loadTable();
            }
            else {
                console.log('res :>> ', res.description);
            }
        }).catch(err => console.error(err));
        return false;	
    }

    function modifyLottery(event) {
        event.preventDefault();
        var data = new FormData(document.getElementById("modify_form"));

        fetch("php/modifylottery.php", {
            method: "POST",
            body: data
        }).then(res => {
            if (res.status != 200){ 
                throw new Error("Bad Server Response"); 
            }
            return res.json();
        }).then(res =>{
            if(res.status == 200) {
                alert("Tarjeta modificada correctamente");
                document.getElementById("tbody").innerHTML = "";
                modal_form.hide();
                loadTable();
            }
            else {
                console.log('res :>> ', res.description);
            }
        }).catch(err => console.error(err));
        return false;
    }

    function deleteLottery() {
        let search = document.getElementById("delete_id").value;
			search = new URLSearchParams(`id=${search}`);

		fetch(`php/deletelottery.php?${search}`, {
			method: "DELETE"
		}).then(res => {
			if (res.status != 200){ 
				throw new Error("Bad Server Response"); 
			}
			return res.json();
		}).then(res =>{
			if(res.status == 200) {
				alert("Tarjeta eliminada correctamente");
                document.getElementById("tbody").innerHTML = "";
                modal_delete.hide();
                loadTable();
			} else {
				console.log('res.description :>> ', res.description);
			}

		}).catch(err => console.error(err));
		return false;
    }

    loadTable();

    const add_form = document.getElementById("create_form");
    add_form.addEventListener("submit", addLottery);

    const modify_form = document.getElementById("modify_form");
    modify_form.addEventListener("submit", modifyLottery); 
    
    document.getElementById('btn_del_user').addEventListener('click', deleteLottery);
    document.getElementById('btn_search').addEventListener('click', searchLottery);

    const modal_form = new bootstrap.Modal('#modal_form');
	const modal_delete = new bootstrap.Modal('#modal_delete');
});