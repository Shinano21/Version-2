(function ($) {
  ("use strict");

  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4) {
      if (this.status == 200) {
        if (this.responseText) {
          try {
            // Extracting the data from SQL database
            var data = JSON.parse(this.responseText); // Parse the JSON response // Access the data from the PHP file
            var title = document.getElementById("dbarTitle");
            function handleBarSelectChange() {
              var selectedValue = this.value;
              var selectedOptgroup =
                this.options[this.selectedIndex].parentNode;
              var groupValue = selectedOptgroup.getAttribute("data-value");
              var groupLabel = selectedOptgroup.getAttribute("label");
              console.log(selectedOptgroup);
              title.innerHTML = `<h4>${groupLabel} Chart<h4>`;
              // Pass the selected value to a function or perform actions based on the value
              processSelectedValue(selectedValue, groupValue);
            }

            var barSelect = document.getElementById("barSelect");
            if (barSelect) {
              barSelect.addEventListener("change", handleBarSelectChange);
              handleBarSelectChange.call(barSelect);
              // Invoke immediately to cover the initial state
            }

            var myChart;
            function ageGroupData(bday) {
              var today = new Date();

              function calculateAge(birthday) {
                var birthDate = new Date(birthday);
                var ageDate = new Date(today - birthDate);
                return Math.abs(ageDate.getUTCFullYear() - 1970);
              }

              let resAge = calculateAge(bday);
              let ageGroup;

              switch (true) {
                case resAge >= 0 && resAge < 1:
                  ageGroup = "0-11 Months";
                  break;
                case resAge >= 1 && resAge <= 5:
                  ageGroup = "1-5";
                  break;
                case resAge >= 6 && resAge <= 12:
                  ageGroup = "6-12";
                  break;
                case resAge >= 13 && resAge <= 19:
                  ageGroup = "13-19";
                  break;
                case resAge >= 20 && resAge <= 29:
                  ageGroup = "20-29";
                  break;
                case resAge >= 30 && resAge <= 39:
                  ageGroup = "30-39";
                  break;
                case resAge >= 40 && resAge <= 49:
                  ageGroup = "40-49";
                  break;
                case resAge >= 50 && resAge <= 59:
                  ageGroup = "50-59";
                  break;
                case resAge >= 60 && resAge <= 69:
                  ageGroup = "60-69";
                  break;
                case resAge >= 70 && resAge <= 79:
                  ageGroup = "70-79";
                  break;
                default:
                  ageGroup = "80+";
                  break;
              }
              return ageGroup;
            }

            function processSelectedValue(value, groupValue) {
              // Perform actions based on the selected value
              // Ensures that the stored data is refresh every option selected
              let labels2 = new Set();
              let labels = [];
              var dataCounts = {};

              function hasNestedObjects(obj) {
                for (const key in obj) {
                  if (typeof obj[key] === "object" && obj[key] !== null) {
                    return true; // Found a nested object
                  }
                }
                return false; // No nested objects found
              }

              function getData(data, value, groupValue, labels, labels2) {
                console.log("-------------------------------");
                function counter(counts, res, resVal, groupVal, labels2) {
                  var { [groupVal]: gValue } = res;
                  if (groupVal == "bday") {
                    gValue = ageGroupData(gValue);
                  }
                  if (!counts[resVal]) {
                    counts[resVal] = {}; // Initialize an object if it doesn't exist
                  }
                  counts[resVal][gValue] = (counts[resVal][gValue] || 0) + 1;

                  labels2.add(gValue);

                  return counts, labels2;
                }
                dataCounts = Object.entries(
                  data.reduce((counts, resident) => {
                    if (groupValue == "bday") {
                      let { [value]: resValue } = resident;
                      if (groupValue == value) {
                        let ageGroup = ageGroupData(resValue);
                        counts[ageGroup] = (counts[ageGroup] || 0) + 1;
                      } else {
                        counter(
                          counts,
                          resident,
                          resValue,
                          groupValue,
                          labels2
                        );
                      }
                    } else {
                      const { [value]: resValue } = resident; // Gets the data of the resident based on the option chosen
                      if (groupValue == value) {
                        counts[resValue] = (counts[resValue] || 0) + 1;
                      } else {
                        counter(
                          counts,
                          resident,
                          resValue,
                          groupValue,
                          labels2
                        );
                      }
                    }
                    return counts;
                  }, {})
                )
                  .sort((a, b) => a[0].localeCompare(b[0]))
                  .reduce((acc, [resValue, count]) => {
                    acc[resValue] = count;
                    return acc;
                  }, {});

                for (const data in dataCounts) {
                  labels.push(data);
                }
              }

              getData(data, value, groupValue, labels, labels2);
              function generateChartData(dataCounts, labels2) {
                var chartData = [];

                function data(labels2, chartData) {
                  let color = 0.9;
                  let b = 255;
                  let label = "";
                  let data = [];
                  let borderColor = "";
                  let borderWidth = "0";
                  let backgroundColor = "";
                  if (!hasNestedObjects(dataCounts)) {
                    label = "Resident Count";
                    for (let dataset in dataCounts) {
                      data.push(dataCounts[dataset]);
                    }
                    chartData.push({
                      label: label,
                      data: data,
                      borderColor: "rgba(0, 123, 255, 0.9)",
                      borderWidth: borderWidth,
                      backgroundColor: getRandomColor(),
                    });
                  } else {
                    for (let dataLabel of labels2.values()) {
                      data = [];
                      label = dataLabel;
                      console.log(dataLabel);
                      console.log(dataCounts);
                      for (let dataset in dataCounts) {
                        if (
                          dataCounts[dataset] &&
                          dataCounts[dataset].hasOwnProperty(dataLabel) // Checks if there is a property inside the dataset
                        ) {
                          // console.log(dataCounts);
                          data.push(dataCounts[dataset][label]);
                        } else {
                          data.push(0); // If there is no property, always return 0 to retain the stacked bar data format
                        }
                      }
                      borderColor = `rgba(255, 255, 255, 1)`;
                      backgroundColor = `rgba(0, 123, ${b}, ${color - 0.2})`;
                      color -= 0.05;
                      b -= 30;

                      chartData.push({
                        label: label,
                        data: data,
                        borderColor: borderColor,
                        borderWidth: 2,
                        backgroundColor: getRandomColor(),
                      });
                    }
                  }
                }
                data(labels2, chartData);
                console.log(chartData);
                return chartData;
              }

              function getRandomColor() {
                // Function to generate a random HEX color code
                var letters = "0123456789ABCDEF";
                var color = "#";
                for (var i = 0; i < 6; i++) {
                  color += letters[Math.floor(Math.random() * 16)];
                }
                return color;
              }
              //bar chart
              var ctx = document.getElementById("barChart");
              ctx.height = 200;
              if (myChart) {
                myChart.destroy();
              }
              myChart = new Chart(ctx, {
                type: "bar",
                data: {
                  labels: labels,
                  datasets: generateChartData(dataCounts, labels2),
                },
                options: {
                  responsive: true,
                  maintainAspectRatio: false,
                  scales: {
                    x: { stacked: true },
                    y: { stacked: true },
                  },
                  plugins: {
                    tooltip: {
                      callbacks: {
                        label: function (context) {
                          var datasetLabel = context.dataset.label || "";
                          var value = context.parsed.y;
                          var total = context.dataset.data.reduce(function (acc, curr) {
                            return acc + curr;
                          }, 0);
                          var percentage = ((value / total) * 100).toFixed(2) + "%";
                          return datasetLabel + ": " + value + " (" + percentage + ")";
                        },
                      },
                    },
                  },
                },
              });
            }
          } catch (error) {
            console.error("Error parsing JSON: " + error);
          }
        } else {
          console.error("Empty response");
        }
      } else {
        console.error("Request failed with status: " + this.status);
      }
    }
  };
  xhttp.open("GET", "extract.php", true); // Request to extract.php
  xhttp.send();
})(jQuery);
