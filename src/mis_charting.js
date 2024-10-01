/// This script handles the creation of MIS Reports for Admins on their homepage

// If page is fully loaded
document.addEventListener("DOMContentLoaded", () => {
    createRouteAmtMIS();
});

// function that will create the chart that will show the number of passengers per route/point
function createRouteAmtMIS()
{
    // Get the div where the chart will be displayed
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
                  label: 'Number of Passengers per Point',
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