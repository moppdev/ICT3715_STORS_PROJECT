/// This script handles the creation of MIS Reports for Admins on their homepage

// If page is fully loaded
document.addEventListener("DOMContentLoaded", () => {
    createRouteAmtMIS();
    createParentMIS();
    createWaitingMIS();
    createOverviewMIS();

});

// function that will create the chart that will show the number of passengers per route/point
function createRouteAmtMIS()
{
    // Get the canvas where the chart will be displayed
    const chart = document.getElementById("route_chart");

    // Arrays to hold route names and passengers
    let routeArray = [];
    let numArray = [];

    // Get the needed MIS query information
    fetch("../index.php?action=mis_info&query=route")
    .then(response => response.json())
    .then(data => {
        data["result"].forEach((elem) => {
            routeArray.push(elem["route"]);
            numArray.push(elem["learners_amt"]);
        });

          // Create the MIS Report
        new Chart(chart, {
          type: 'bar',
          data: {
              labels: routeArray,
              datasets: [{
                  label: 'Number of Passengers per Route',
                  data: numArray,
                  borderWidth: 1
              }]
          },
          options: {
              scales: {
                  y: {
                      beginAtZero: true
                  }
              }
          }
      });
    })
    .catch(error => console.error(error));
}

// function that will create the table that will show learners and their parents' details
function createParentMIS() {   
    // Arrays where distinct parents and the data retrieved will be saved
    let parentArray = [];
    let dataArray = [];

    // Get the needed MIS query information
    fetch("../index.php?action=mis_info&query=parent")
    .then(response => response.json())
    .then(data => {
        dataArray = data["result"];
        dataArray.forEach((elem) => {
            parentArray.push(elem["parent"]);
        });
        parentArray = parentArray.filter((parent, parentIndex) => parentArray.indexOf(parent) === parentIndex);

        // Create the MIS Report
        const table_target = document.getElementById("parent_target");
        let table_array = [];

        // Loop through parentArray to build table rows
        parentArray.forEach((parent) => {
            // Add the parent's details as a table row
            let parentRow = `<tr>
                                <th colspan="2" class="table-secondary">
                                    Parent: ${parent} | Email: ${findParentDetail(parent, dataArray, 'email')} | Cell: ${findParentDetail(parent, dataArray, 'cell_num')}
                                </th>
                             </tr>`;
            table_array.push(parentRow);

            // Search for parents
            dataArray.forEach((record) => {
                if (record["parent"] == parent) {
                    let learnerRow = `<tr>
                                        <td>${record["learner"]}</td>
                                        <td>${record["grade"]}</td>
                                      </tr>`;
                    table_array.push(learnerRow);
                }
            });
        });

        // Add all rows to the table
        table_target.innerHTML = table_array.join('');
    })
    .catch(error => console.error(error));
}

// function that will create the table that will show the current waiting list
function createWaitingMIS()
{
    // Get the needed MIS query information
    fetch("../index.php?action=mis_info&query=wait")
    .then(response => response.json())
    .then(data => {
        const table_target = document.getElementById("wait_target");

        data["result"].forEach((elem) => {
            addToWaitTable(table_target, elem);
        });
    })
    .catch(error => console.error(error));
}

// Function that adds a row to the waiting list
function addToWaitTable(target, record)
{
    const tr = document.createElement("tr");
    let row = `<td>${record["full_name"]}</td><td>
                        ${record["grade"]}</td><td>${record["pickup_id"]}</td><td>${record["dropoff_id"]}</td><td>${record["cell_num"]}</td>
                        <td>${record["date_added"]}</td>`;
    tr.innerHTML = row;
    target.appendChild(tr);
}

// function that will create the table that will show the passenger list info based on the time of day
function createOverviewMIS()
{
        // Get the needed MIS query information
        fetch("../index.php?action=mis_info&query=overview")
        .then(response => response.json())
        .then(data => {
            const table_target = document.getElementById("overview_target");
            
            // Get the data needed and create the table
            data["result"].forEach((elem) => {
                console.log(elem);
                addToOverviewTable(table_target, elem);
            });
        })
        .catch(error => console.error(error));
}

// Function that adds a row to the waiting list
function addToOverviewTable(target, record)
{
    const tr = document.createElement("tr");
    let row = `<td>${record["name"]}</td><td>
                        ${record["route_name"]}</td><td>${record["point_name"]}</td><td>${record["point_num"]}</td><td>${record["time"]}</td>`;
    tr.innerHTML = row;
    target.appendChild(tr);
}

// Function to find specific parent details
function findParentDetail(parent, dataArray, detailKey) {
    for (let i = 0; i < dataArray.length; i++) {
        if (dataArray[i]["parent"] === parent) {
            return dataArray[i][detailKey];
        }
    }
}