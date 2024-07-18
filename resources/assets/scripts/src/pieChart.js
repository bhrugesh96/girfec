import 'amcharts3/amcharts/amcharts';
import 'amcharts3/amcharts/pie';
import 'amcharts3/amcharts/plugins/responsive/responsive';

const pieChart = () => {
  const $charts = $('.content-layout-item.pie_chart');

  $charts.each((index, container) => {
    const $chart = $('.chart-wrap .chart-div', container);
    const $chartItems = $('.chart-items .chart-item', container);
    const chartID = $chart.attr('id');
    const chartDataProvider = [];
    const chartColors = [];

    $chartItems.each((itemIndex, item) => {

      chartDataProvider.push({
        "title": $(item).data('title'),
        "value": 1,
        "pulledOut": ($chartItems.length === (itemIndex + 1)),
      });

      chartColors.push($(item).data('color'));
    });

    const actChart = window.AmCharts.makeChart(chartID, {
      "type": "pie",
      "balloonText": "",
      "labelRadius": -65,
      "labelText": "[[title]]",
      "addClassNames": true,
      "accessible": true,
      "accessibleLabel": "[[title]]",
      "pullOutRadius": 10,
      "startRadius": 400,
      "colors": chartColors,
      "pullOutDuration": 0.5,
      "pullOutEffect": "easeOutSine",
      "pullOutOnlyOne": true,
      "startDuration": 0,
      "titleField": "title",
      "valueField": "value",
      "pulledField": "pulledOut",
      "color": "#FFFFFF",
      "fontFamily": "Usual",
      "fontSize": 16,
      "allLabels": [],
      "balloon": {},
      "titles": [],
      "hoverAlpha": 0.85,
      "marginBottom": 0,
      "marginTop": 0,
      "marginLeft": 0,
      "marginRight": 0,
      "dataProvider": chartDataProvider,
      "responsive": {
        "enabled": true,
        "addDefaultRules": false,
        "rules": [
          {
            "maxWidth": 400,
            "overrides": {
              "fontSize": 14,
              "labelRadius": -55,
            },
          },
          {
            "maxWidth": 360,
            "overrides": {
              "fontSize": 12,
              "labelRadius": -45,
            },
          },
          {
            "maxWidth": 320,
            "overrides": {
              "fontSize": 11,
              "labelRadius": -40,
            },
          },
          {
            "maxWidth": 100,
            "overrides": {
              "allLabels": {
                "enabled": true,
              },
            },
          },
        ],
      },
      "listeners": [
        {
          "event": "pullOutSlice",
          "method": function (e) {
            $chartItems.removeClass('active');
            $('.chart-items .chart-item-' + e.dataItem.index, container).addClass('active');
          },
        },
        {
          "event": "rollOverSlice",
          "method": function (e) {
            if ($('body').hasClass('is-mobile') && ! e.dataItem.pulled && (typeof(e.event) === 'object')) {
              actChart.clickSlice(e.dataItem.index);
            }
          },
        },
      ],
    });
  });
};

export default pieChart;
