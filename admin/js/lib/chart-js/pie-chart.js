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
            const handlePieSelect = () => {
              const pieSelect = document.getElementById("pieSelect");
              const title = document.getElementById("pieTitle");

              const updateTitle = () => {
                const selectedValue = pieSelect.value;
                const label =
                  pieSelect.options[pieSelect.selectedIndex].parentNode.label;
                title.innerHTML = `<h4>Population Chart (by ${selectedValue})<h4>`;
                processSelectedValue(selectedValue, label);
              };

              if (!pieSelect.onchange) {
                updateTitle();
              }

              pieSelect.addEventListener("change", updateTitle);
            };

            handlePieSelect();
            var myChart;
            function processSelectedValue(value) {
              let counts = [];
              let labels = [];
              let bg = [];
              let hovBg = [];

              function getData(data, value, counts, labels) {
                var dataCounts = Object.entries(
                  data.reduce((counts, resident) => {
                    const { [value]: resValue } = resident;
                    counts[resValue] = (counts[resValue] || 0) + 1;
                    return counts;
                  }, {})
                )
                  .sort((a, b) => a[0].localeCompare(b[0]))
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
              function age_group(data, counts, labels) {
                var today = new Date();
                let groups = {
                  "0-11 Months": data.filter(
                    (person) => calculateAge(person.bday) < 1
                  ).length,
                  "1-5": data.filter(
                    (person) =>
                      calculateAge(person.bday) >= 1 &&
                      calculateAge(person.bday) <= 5
                  ).length,
                  "6-12": data.filter(
                    (person) =>
                      calculateAge(person.bday) > 5 &&
                      calculateAge(person.bday) <= 12
                  ).length,
                  "13-19": data.filter(
                    (person) =>
                      calculateAge(person.bday) > 12 &&
                      calculateAge(person.bday) <= 19
                  ).length,
                  "20-29": data.filter(
                    (person) =>
                      calculateAge(person.bday) > 19 &&
                      calculateAge(person.bday) <= 29
                  ).length,
                  "30-39": data.filter(
                    (person) =>
                      calculateAge(person.bday) > 29 &&
                      calculateAge(person.bday) <= 39
                  ).length,
                  "40-49": data.filter(
                    (person) =>
                      calculateAge(person.bday) > 39 &&
                      calculateAge(person.bday) <= 49
                  ).length,
                  "50-59": data.filter(
                    (person) =>
                      calculateAge(person.bday) > 49 &&
                      calculateAge(person.bday) <= 59
                  ).length,
                  "60-69": data.filter(
                    (person) =>
                      calculateAge(person.bday) > 59 &&
                      calculateAge(person.bday) <= 69
                  ).length,
                  "70-79": data.filter(
                    (person) =>
                      calculateAge(person.bday) > 69 &&
                      calculateAge(person.bday) <= 79
                  ).length,
                  "80+": data.filter((person) => calculateAge(person.bday) > 79)
                    .length,
                };
                Object.entries(groups).forEach(([key, value]) => {
                  labels.push(key);
                  counts.push(value);
                });
                function calculateAge(birthday) {
                  var birthDate = new Date(birthday);
                  var ageDate = new Date(today - birthDate);
                  return Math.abs(ageDate.getUTCFullYear() - 1970);
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

              if (value != "age group") {
                getData(data, value, counts, labels);
              } else {
                age_group(data, counts, labels);
              }

              const percentages = [];
              addPercentageToLabels(labels, counts, percentages);
              bgColor(labels, bg, hovBg);

              var ctx = document.getElementById("pieChart");
              ctx.height = 50;

              if (myChart) {
                myChart.destroy();
              }

              myChart = new Chart(ctx, {
                type: "pie",
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

            function calculatePercentage(count, total) {
                return ((count / total) * 100).toFixed(2) + "%";
            }

            function addPercentageToLabels(labels, counts, percentages) {
                const total = counts.reduce((sum, count) => sum + count, 0);

                for (let i = 0; i < labels.length; i++) {
                    const percentage = calculatePercentage(counts[i], total);
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

  xhttp.open("GET", "extract.php", true);
  xhttp.send();
})(jQuery);
