$(document).ready(function () {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            // if (this.responseText == 0) {
            //     window.open("index.html", "_self");
            // }
            var data = JSON.parse(this.responseText);
            console.log("JSON Data:\n");
            //Check the Console Log (Hit F12)
            console.log(data);
            console.log(data[0].id);
            console.log(data[0].name);
    
            $('#modalLoginForm').modal('show');
            $('#defaultForm-pass1').val(data[0].name);
            $('#defaultForm-pass2').val(data[1].name);
            $('#defaultForm-pass3').val(data[2].name);
    
            $('#modalLoginForm').modal('show');
        } else {
            console.log("Could not get Face Data: error");
        }
    };
    xmlhttp.open("GET", "../php/socket.php", true);
    xmlhttp.send();    
});

