console.log(gender[1]);

// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#292b2c';

var male =0;
var female=0;

gender.forEach(myAge => {
    
    if(myAge=="Male")
    male++;
    else if(myAge=="Female")
    female++;
});

// Pie Chart Example
var ctx = document.getElementById("myPieChart");
var myPieChart = new Chart(ctx, {
  type: 'pie',
  data: {
    labels: ["Male", "Female"],
    datasets: [{
      data: [male, female],
      backgroundColor: ['#007bff', '#FF69B4'],
    }],
  },
});