//Grab table-assin.json and populate a table based on that
var xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        data = JSON.parse(this.responseText);
        console.log("FROM host-scripts.js. This is the json output from adding a new customer.")
        console.log(data);
        populateTables(data);
    } else {
        console.log("error");
    }
};
xmlhttp.open("GET", "json/table-assign.json", true);
xmlhttp.send();

//Populate Using Javascript and JSON
function populateTables(data) {
    console.log("In Pop");
    var tableBody = document.getElementById("js-table-body");
    
    
    for (var key in data.Party) {
        console.log(data.Party[key].name);  
        var row = tableBody.insertRow();
        var td1 = row.insertCell(0);
        var td2 = row.insertCell(1);
        var td3 = row.insertCell(2);
        var td4 = row.insertCell(3);
        var td5 = row.insertCell(4);

        td1.innerHTML = data.Party[key]['party order'];
        td2.innerHTML = data.Party[key].name;
        td3.innerHTML = data.Party[key]['number guests'];
        td4.innerHTML = data.Party[key].server;  
        td5.innerHTML = "time needs to be done later";  
    }
}