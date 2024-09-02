(function ($) {
  "use strict";

  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4) {
      if (this.status == 200) {
        if (this.responseText) {
          try {
            // Extracting the data from SQL database
            var data = JSON.parse(this.responseText);

            // Perform actions based on the selected value
            // Ensures that the stored data is refreshed every option selected
            let counts = [];
            let labels = [];
            let bg = [];

            function getData(data, counts, labels) {
              var dataCounts = Object.entries(
                data.reduce((counts, resident) => {
                  const { educational } = resident;
                  counts[educational] = (counts[educational] || 0) + 1;
                  return counts;
                }, {})
              )
                .sort((a, b) => a[0].localeCompare(b[0])) // Sort based on zone names
                .reduce((acc, [educational, count]) => {
                  acc[educational] = count;
                  return acc;
                }, {});

              for (const data in dataCounts) {
                counts.push(dataCounts[data]);
              }
              for (const data in dataCounts) {
                labels.push(data);
              }
            }

            function bgColor(labels, bg) {
              let color = 0.9;
              let b = 255;

              for (let i = 0; i < labels.length; i++) {
                bg.push(`rgba(0, 123, ${b},${color})`);
                color -= 0.07;
                b -= 10;
              }
            }

            getData(data, counts, labels);
            bgColor(labels, bg);

            // Calculate percentages
            const total = counts.reduce((acc, count) => acc + count, 0);
            const percentages = counts.map(count => ((count / total) * 100).toFixed(2) + "%");

            // Update labels to include count and percentage
            const legendLabels = labels.map((label, index) => `${label}: ${counts[index]} (${percentages[index]})`);

            // single bar chart
            var ctx = document.getElementById("singleBarChart");
            myChart = new Chart(ctx, {
              type: "bar",
              data: {
                labels: labels,
                datasets: [
                  {
                    label: "Residents Count",
                    data: counts,
                    borderColor: "rgba(0, 123, 255, 0.9)",
                    borderWidth: "0",
                    backgroundColor: "rgba(0, 123, 255, 0.5)",
                  },
                ],
              },
              options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                  display: true,
                  labels: {
                    generateLabels: function (chart) {
                      const originalLabels = Chart.defaults.global.legend.labels.generateLabels(chart);
                      return originalLabels.map((label, index) => {
                        label.text = legendLabels[index];
                        return label;
                      });
                    },
                  },
                },
                tooltips: {
                  callbacks: {
                    label: function (tooltipItem, data) {
                      const dataset = data.datasets[tooltipItem.datasetIndex];
                      const label = data.labels[tooltipItem.index];
                      const count = dataset.data[tooltipItem.index];
                      const percentage = ((count / total) * 100).toFixed(2) + "%";
                      return `${label}: ${count} (${percentage})`;
                    },
                  },
                },
                scales: {
                  x: {
                    ticks: {
                      callback: function (value, index) {
                        // Display count and percentage on x-axis labels
                        const label = labels[index];
                        const count = counts[index];
                        const percentage = percentages[index];
                        return `${label}: ${count} (${percentage})`;
                      },
                    },
                  },
                },
              },
            });
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
