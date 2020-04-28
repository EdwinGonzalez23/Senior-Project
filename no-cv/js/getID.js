$(document).ready(function () {
    var employees = {};
    var xhttp = new XMLHttpRequest()
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            var data = JSON.parse(this.responseText)
            console.log(data[0][0])
            if (data[0]) {
                $('#defaultForm-pass1').val(data[0][1] + " " + data[0][2]);
                $('#hidden-id1').val(data[0][4]);
                $('#hidden-ids1').val(data[0][0]);
                employees[data[0][1]] = {
                    id: data[0][0]
                }
            } else $('#defaultForm-pass1').hide();
            if (data[1]) {
                $('#defaultForm-pass2').val(data[1][1] + " " + data[1][2]);
                $('#hidden-id2').val(data[1][4]);
                $('#hidden-ids2').val(data[1][0]);
                employees[data[1][1]] = {
                    id: data[1][0]
                }
            } else $('#defaultForm-pass2').hide();
            if (data[2]) {
                $('#defaultForm-pass3').val(data[2][1] + " " + data[2][2]);
                $('#hidden-id3').val(data[2][4]);
                $('#hidden-ids3').val(data[2][0]);
                employees[data[2][1]] = {
                    id: data[2][0]
                }
            } else $('#defaultForm-pass3').hide();

            $('#modalLoginForm').modal('show');
        }
    };
    xhttp.open("GET", "db_scripts/get_users.php", true);
    xhttp.send();
});