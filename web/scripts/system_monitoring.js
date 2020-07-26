let status = document.getElementById("system_status");

function loop() {
    fetch(location.href + "/json")
        .then(function (response) {
            return response.json();
        })
        .then(function (myJson) {
            let output = "";
            output += "<table class='table'><tr><th>CPU Name</th><th>Uname</th><th>Disk</th></tr><tr>";

            output += "<td>"+myJson['cpu']+"</td>";

            output += "<td><b>Node Name:</b> "+myJson['uname']['node_name']+"<br />";
            output += "<b>Kernel Release:</b> "+myJson['uname']['kernel_release']+"<br />";
            output += "<b>Arch:</b> "+myJson['uname']['arch']+"</td>";

            output += "<td><b>Disk Name:</b> "+myJson['disk']['name']+"<br />";
            output += "<b>Mountpoint:</b> "+myJson['disk']['mountpoint']+"<br />";
            output += "<b>Disk Size:</b> "+myJson['disk']['size']+"<br />";
            output += "<b>Disk Used:</b> "+myJson['disk']['used']+"<br />";
            output += "<b>Free Space:</b> "+myJson['disk']['free']+"<br />";
            output += "<b>Precentage:</b> "+myJson['disk']['precentage']+"</td>";

            output += "</tr></table>";
            status.innerHTML = "";
            status.innerHTML += output;
            console.log(myJson);
        })
        .catch(function (error) {
            console.log("Error: " + error);
        });
    setTimeout(loop, 10000);
}
loop();