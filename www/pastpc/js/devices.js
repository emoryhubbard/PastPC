'use strict' //"the 'use strict' directive tells the JavaScript parser to follow all rules strictly."

const classificationList = document.querySelector("#classificationList");
classificationList.addEventListener("change", function () {
    const classificationId = classificationList.value;
    console.log(`classificationId is: ${classificationId}`);
    const classIdURL = "/pastpc/devices/index.php?action=getInventoryItems&classificationId=" + classificationId;
    fetch(classIdURL)
    .then(function (response) {
        if (response.ok) {
            return response.json();
        }
        throw Error("Network response was not OK");
    })
    .then(function (data) {
        console.log(data);
        buildInventoryList(data);
    })
    /*.catch(function (error) {
        console.log('There was a problem: ', error.message);
    })*/
});

function buildInventoryList(data) {
    const devicesDisplay = document.querySelector("#devicesDisplay");
    let dt = '<colgroup><col class="col1" span="1"><col class="col2" span="1"></colgroup>';
    dt += '<thead>'; // dt is dataTable
    dt += '<tr><th class="table-name">Device Name</th><td>&nbsp;</td><td>&nbsp;</td></tr>';
    dt += '</thead>';
    dt += '<tbody>';
    data.forEach(function (el) { // el is element
        console.log(el.deviceId + ", " + el.deviceModel);
        dt += `<tr><td>${el.deviceBrand} ${el.deviceModel}</td>`;
        dt += `<td class="modify"><a href='/pastpc/devices?action=mod&deviceId=${el.deviceId}' title='Click to modify'>Modify</a></td>`;
        dt += `<td class="delete"><a href='/pastpc/devices?action=del&deviceId=${el.deviceId}' title=CLick to delete'>Delete</a></td></tr>`;
    });
    dt += '</tbody>';
    devicesDisplay.innerHTML = dt;
}