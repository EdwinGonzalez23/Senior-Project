// HTTP to server.php for JSON
var tableData;
var serverName; var currentView = "sever";
var xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        tableData = JSON.parse(this.responseText);
        console.log(tableData);
        populateServerTables();
    } else {
        console.log("server php error");
    }
};
xmlhttp.open("GET", "scripts/php/server.php", true);
xmlhttp.send();


function populateServerTables() {  
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            serverName = this.responseText;
            document.getElementById("server-name").innerHTML = serverName;
            var tableBody = document.getElementById("js-table2");
            for (var key in tableData.Party) {
                var row = tableBody.insertRow();
                var td1 = row.insertCell(0);
                var td2 = row.insertCell(1);
                var td3 = row.insertCell(2);
                var td4 = row.insertCell(3);
                var td5 = row.insertCell(4);
        
                td1.innerHTML = tableData.Party[key]['party order'];
                td2.innerHTML = tableData.Party[key].name;
                td3.innerHTML = tableData.Party[key]['number guests'];
                td4.innerHTML = tableData.Party[key].server;  
                td5.innerHTML = "time needs to be done later";   
            }  

                //Now populate just server
            var tableBody = document.getElementById("js-table3");
            for (var key in tableData.Party) {
                if (tableData.Party[key].server == serverName) {
                    var row = tableBody.insertRow();
                    var td1 = row.insertCell(0);
                    var td2 = row.insertCell(1);
                    var td3 = row.insertCell(2);
                    var td4 = row.insertCell(3);
                    var td5 = row.insertCell(4);
            
                    td1.innerHTML = tableData.Party[key]['party order'];
                    td2.innerHTML = tableData.Party[key].name;
                    td3.innerHTML = tableData.Party[key]['number guests'];
                    td4.innerHTML = tableData.Party[key].server;  
                    td5.innerHTML = "time needs to be done later";   
                }
            }
            
        } else {
            console.log("error");
        }
    };
    xmlhttp.open("GET", "scripts/php/sessionvar.php", true);
    xmlhttp.send();    
}

function displayAll() {
    document.getElementById("js-table2").style.display = "";
    document.getElementById("js-table3").style.display = "none";
    document.getElementById("table-type").innerHTML = "All Tables";

}

function displayServer() {
    document.getElementById("js-table2").style.display = "none";
    document.getElementById("js-table3").style.display = "";
    document.getElementById("table-type").innerHTML = "Your tables";
}

