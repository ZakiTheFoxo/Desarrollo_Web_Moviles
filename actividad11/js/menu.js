
document.addEventListener("DOMContentLoaded", function(event) {
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
    
    loadHeader();
});