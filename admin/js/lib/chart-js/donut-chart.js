(function ($) {
  "use strict";
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4) {
      if (this.status == 200) {
        if (this.responseText) {
          try {
            // Extracting the data from SQL database
            var data = JSON.parse(this.responseText); // Parse the JSON response // Access the data from the PHP file

            const handleDonutSelect = () => {
              const donutSelect = document.getElementById("donutSelect");
              const title = document.getElementById("donutTitle");

              const updateTitle = () => {
                const selectedValue = donutSelect.value;
                const label =
                  donutSelect.options[donutSelect.selectedIndex].parentNode
                    .label;
                title.innerHTML = `<h4>${label} Chart (by ${selectedValue})<h4>`;
                processSelectedValue(selectedValue, label);
              };

              if (!donutSelect.onchange) {
                updateTitle();
              }

              donutSelect.addEventListener("change", updateTitle);
            };

            handleDonutSelect();

            var myChart;

            function processSelectedValue(value, label) {
              // Perform actions based on the selected value
              // Ensures that the stored data is refreshed every option selected
              let counts = [];
              let labels = [];
              let bg = [];
              let hovBg = [];

              function getData(data, value, counts, labels) {
                var dataCounts = Object.entries(
                  data.reduce((counts, resident) => {
                    const { [value]: resValue } = resident;
                    if (label === "PWD" && resident["pwd_status"] === "Yes") {
                      counts[resValue] = (counts[resValue] || 0) + 1;
                    } else if (
                      label === "4Ps Beneficiary" &&
                      resident["four_p"] === "Yes"
                    ) {
                      counts[resValue] = (counts[resValue] || 0) + 1;
                    }
                    return counts;
                  }, {})
                )
                  .sort((a, b) => a[0].localeCompare(b[0])) // Sort based on zone names
                  .reduce((acc, [resValue, count]) => {
                    acc[resValue] = count;
                    return acc;
                  }, {});

                for (const data in dataCounts) {
                  counts.push(dataCounts[data]);
                }
                for (const data in dataCounts) {
                  labels.push(data);
                }
              }

              function bgColor(labels, bg, hovBg) {
                const bgColors = [
                  "rgba(15, 181, 174, 0.9)",
                  "rgba(64, 70, 202, 0.9)",
                  "rgba(246, 133, 17, 0.9)",
                  "rgba(222, 61, 130, 0.9)",
                  "rgba(126, 132, 250, 0.9)",
                  "rgba(114, 224, 106, 0.9)",
                  "rgba(20, 122, 243, 0.9)",
                  "rgba(115, 38, 211, 0.9)",
                  "rgba(232, 198, 0, 0.9)",
                  "rgba(203, 93, 0, 0.9)",
                  "rgba(0, 143, 93, 0.9)",
                  "rgba(188, 233, 49, 0.9)",
                ];

                const hovColors = [
                  "rgba(15, 181, 174, 0.7)",
                  "rgba(64, 70, 202, 0.7)",
                  "rgba(246, 133, 17, 0.7)",
                  "rgba(222, 61, 130, 0.7)",
                  "rgba(126, 132, 250, 0.7)",
                  "rgba(114, 224, 106, 0.7)",
                  "rgba(20, 122, 243, 0.7)",
                  "rgba(115, 38, 211, 0.7)",
                  "rgba(232, 198, 0, 0.7)",
                  "rgba(203, 93, 0, 0.7)",
                  "rgba(0, 143, 93, 0.7)",
                  "rgba(188, 233, 49, 0.7)",
                ];

                for (let i = 0; i < labels.length; i++) {
                  bg.push(bgColors[i]);
                  hovBg.push(hovColors[i]);
                }
              }

              const percentages = [];
              getData(data, value, counts, labels);
              bgColor(labels, bg, hovBg);
              addPercentageToLabels(labels, counts, percentages);

              // doughnut chart
              var ctx = document.getElementById("doughnutChart");
              ctx.height = 50;
              if (myChart) {
                myChart.destroy();
              }
              myChart = new Chart(ctx, {
                type: "doughnut",
                data: {
                  datasets: [
                    {
                      data: counts,
                      backgroundColor: bg,
                      hoverBackgroundColor: hovBg,
                    },
                  ],
                  labels: labels,
                },
                options: {
                  responsive: true,
                  tooltips: {
                    callbacks: {
                      label: function (tooltipItem, data) {
                        const label = data.labels[tooltipItem.index];
                        const count = data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];
                        const percentage = percentages[tooltipItem.index];
                        return `${label}: ${count} (${percentage})`;
                      },
                    },
                  },
                },
              });
            }

            function addPercentageToLabels(labels, counts, percentages) {
              const total = counts.reduce((sum, count) => sum + count, 0);

              for (let i = 0; i < labels.length; i++) {
                const percentage = ((counts[i] / total) * 100).toFixed(2) + "%";
                labels[i] = `${labels[i]} (${percentage})`;
                percentages.push(percentage);
              }
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
