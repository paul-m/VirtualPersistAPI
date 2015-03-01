// traffic stats report using jqplot.
"use strict";

$('.content').remove('.traffic-table');

//window.regionName = $('#traffic-graph').data('regionname');

// extract data from extra divs.
window.plotData = new Array();
$(".traffic-data").map(
  function(index, el) {
    window.plotData.push(
      new Array(
        $(el).data('timestamp'),
        $(el).data('count')
      )
    );
  }
);

$.jqplot('traffic-graph', new Array(window.plotData),
{axes:{xaxis:{renderer:$.jqplot.DateAxisRenderer}}}
);

