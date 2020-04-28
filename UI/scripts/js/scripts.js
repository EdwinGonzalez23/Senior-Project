var xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        if (this.responseText == 0) {
            window.open("index.html", "_self");
        }
        var data = JSON.parse(this.responseText);
        //document.getElementById("timer").innerHTML = "add timer";
        //document.getElementById("pid").innerHTML = data[0].id;
        document.getElementById("ename").innerHTML = data[0].name;
        console.log("JSON Data:\n");
        //Check the Console Log (Hit F12)
        console.log(data);
        console.log(data[0].id);
        console.log(data[0].name);
    } else {
        console.log("error");
    }
};
xmlhttp.open("GET", "scripts/php/host.php", true);
xmlhttp.send();

function logout() {
    alert("Logging out!");
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            window.open(this.responseText, "_self");
        } else {
            console.log("error");
        }
    };
    xmlhttp.open("GET", "scripts/php/logout.php", true);
    xmlhttp.send();
}