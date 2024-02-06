console.log(age[1]);
Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#292b2c';

var age_67=0;
var age_89=0;
var age_1011=0;
var age_1213=0;
var age_1415=0;
var age_more15=0;

age.forEach(element => {

  if(element == 6 || element ==7 )
    age_67++;
  else if(element == 8 || element ==9)
    age_89++;
  else if(element == 10 || element ==11)
    age_1011++;
  else if(element == 12 || element ==13)
    age_1213++;
  else if(element == 14 || element ==15)
    age_1415++;
  else if(element>15)
    age_more15++;
});
console.log(age_67);

// Bar Chart Example
var ctx = document.getElementById("myBarChart");
var myLineChart = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: ["6-7", "8-9", "10-11", "12-13", "14-15","+15"],
    datasets: [{
      label: "count",
      backgroundColor: "rgba(2,117,216,1)",
      borderColor: "rgba(2,117,216,1)",
      data: [age_67, age_89, age_1011, age_1213, age_1415,age_more15],
    }],
  },
  options: {
    scales: {
      xAxes: [{
        time: {
          unit: 'age'
        },
        gridLines: {
          display: false
        },
        ticks: {
          maxTicksLimit: 6
        }
      }],
      yAxes: [{
        ticks: {
          min: 0,
          max: 15,
          maxTicksLimit: 5
        },
        gridLines: {
          display: true
        }
      }],
    },
    legend: {
      display: false
    }
  }
});