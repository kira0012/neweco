'use strict';
$(function () {
  barChart();
  lineChart();
  pieChart();

});
//Charts

function barChart() {

  // Themes begin
  am4core.useTheme(am4themes_animated);
  // Themes end

  // Create chart instance
  var chart = am4core.create("barChart", am4charts.XYChart);
  chart.scrollbarX = new am4core.Scrollbar();


  var date = new Date();
  var year = date.getFullYear();
  
      fetch('/dashboard/year-sale/'+year)
      .then((res) => res.json())
          .then((records)=>{
           chart.data = records;

     
            console.log(records);
  
  // Create axes
  var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
  categoryAxis.dataFields.category = "Month";
  categoryAxis.renderer.grid.template.location = 0;
  categoryAxis.renderer.minGridDistance = 30;
  categoryAxis.renderer.labels.template.horizontalCenter = "right";
  categoryAxis.renderer.labels.template.verticalCenter = "middle";
  categoryAxis.renderer.labels.template.rotation = 270;
  categoryAxis.tooltip.disabled = true;
  categoryAxis.renderer.minHeight = 110;
  categoryAxis.renderer.labels.template.fill = am4core.color("#9aa0ac");

  var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
  valueAxis.renderer.minWidth = 50;
  valueAxis.renderer.labels.template.fill = am4core.color("#9aa0ac");

  // Create series
  var series = chart.series.push(new am4charts.ColumnSeries());
  series.sequencedInterpolation = true;
  series.dataFields.valueY = "Sales";
  series.dataFields.categoryX = "Month";
  series.tooltipText = "[{categoryX}: bold]{valueY}[/]";
  series.columns.template.strokeWidth = 0;

  series.tooltip.pointerOrientation = "vertical";

  series.columns.template.column.cornerRadiusTopLeft = 10;
  series.columns.template.column.cornerRadiusTopRight = 10;
  series.columns.template.column.fillOpacity = 0.8;

  // on hover, make corner radiuses bigger
  let hoverState = series.columns.template.column.states.create("hover");
  hoverState.properties.cornerRadiusTopLeft = 0;
  hoverState.properties.cornerRadiusTopRight = 0;
  hoverState.properties.fillOpacity = 1;

  series.columns.template.adapter.add("fill", (fill, target) => {
    return chart.colors.getIndex(target.dataItem.index);
  });

  // Cursor
  chart.cursor = new am4charts.XYCursor();

}).catch((error)=>{
  console.log(error);
})

}

function lineChart() {
  am4core.useTheme(am4themes_animated);

  // Create chart instance
  var chart = am4core.create("amchartLineDashboard", am4charts.XYChart);

  fetch('/dashboard/monthly-income')
  .then((res) => res.json())
      .then((records)=>{
       chart.data = records;

        console.log('line');
        console.log(records);


  // Create axes
  var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
  dateAxis.renderer.grid.template.location = 0;
  dateAxis.renderer.labels.template.fill = am4core.color("#9aa0ac");
  dateAxis.renderer.minGridDistance = 30;

  var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
  valueAxis.renderer.labels.template.fill = am4core.color("#9aa0ac");

  // Create series
  function createSeries(field, name, date) {
    var series = chart.series.push(new am4charts.LineSeries());
    series.dataFields.valueY = field;
    series.dataFields.dateX = "date";
    series.tooltipText = name+ " : [{categoryX}: bold]{valueY}[/]";
    series.name = name;
    series.strokeWidth = 2;

    var bullet = series.bullets.push(new am4charts.CircleBullet());
    bullet.circle.stroke = am4core.color("#fff");
    bullet.circle.strokeWidth = 2;
  }

  createSeries("income", "Gross Sale", "date");
  createSeries("net_income", "Net Income", "date");


  chart.legend = new am4charts.Legend();
  chart.cursor = new am4charts.XYCursor();

}).catch((error)=>{
  console.log(error);
})

}




function pieChart() {
  // Themes begin
  am4core.useTheme(am4themes_animated);
  // Themes end

  // Create chart instance
  var chart = am4core.create("SalesExpensesChart", am4charts.PieChart);
  var salechart = am4core.create("saleschart", am4charts.PieChart);

    fetch('/dashboard/net-income')
      .then((res) => res.json())
      .then((records)=>{

         console.log(records);

        var selected;
        chart.data = generateChartData();

  // Add and configure Series
  var pieSeries = chart.series.push(new am4charts.PieSeries());
  pieSeries.dataFields.value = "Amount";
  pieSeries.dataFields.category = "Category";

  pieSeries.slices.template.stroke = am4core.color("#fff");
  pieSeries.slices.template.strokeWidth = 2;
  pieSeries.slices.template.strokeOpacity = 1;
  pieSeries.labels.template.fill = am4core.color("#9aa0ac");
  pieSeries.slices.template.propertyFields.isActive = "pulled";

  // This creates initial animation
  pieSeries.hiddenState.properties.opacity = 1;
  pieSeries.hiddenState.properties.endAngle = -90;
  pieSeries.hiddenState.properties.startAngle = -90;

 fetch('/dashboard/today/sale')
          .then((res) => res.json())
              .then((response) => {


        salechart.data = response;


  var saleSeries = salechart.series.push(new am4charts.PieSeries());

  // salechart.width = am4core.percent(50);
  // salechart.hieght = am4core.percent(50);
  saleSeries.dataFields.value = "Amount";
  saleSeries.dataFields.category = "Category";

  saleSeries.slices.template.stroke = am4core.color("#fff");
  saleSeries.slices.template.strokeWidth = 2;
  saleSeries.slices.template.strokeOpacity = 1;
  saleSeries.labels.template.fill = am4core.color("#9aa0ac");
  //saleSeries.slices.template.propertyFields.isActive = "pulled";
  // This creates initial animation
  saleSeries.hiddenState.properties.opacity = 1;
  saleSeries.hiddenState.properties.endAngle = -90;
  saleSeries.hiddenState.properties.startAngle = -90;
});

  function generateChartData() {
    var chartData = [];
    console.log(chartData);
    for (var i = 0; i < records.length; i++) {
      if (i == selected) {
        console.log(i);
        for (var x = 0; x < records[i].sub.length; x++) {
          chartData.push({
            Category: records[i].sub[x].Category,
            Amount: records[i].sub[x].Amount,
            pulled: true
          });
        }
      } else {
        chartData.push({
          Category: records[i].Category,
          Amount: records[i].Amount,
          id: i
        });
      }
    }
    return chartData;
  }

  pieSeries.slices.template.events.on("hit", function(event) {
      console.log(event);
    if (event.target.dataItem.dataContext.id != undefined) {
      selected = event.target.dataItem.dataContext.id;
    } else {
      selected = undefined;
    }
    // console.log(selected);
    chart.data = generateChartData();
  });


}).catch((error)=>{
  console.log(error);
})
}