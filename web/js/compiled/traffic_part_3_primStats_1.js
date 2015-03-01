// traffic stats report using jqplot.
"use strict";

$('.content').remove('.primuse-table');

window.plotData = new Array();

$(".primuse-data").map(
  function(index, el) {
    var data = JSON.parse($(el).data('data'));
    window.plotData[data.uuid].push(
      new Array(
        $(el).data('timestamp'),
        data.count;
//        $(el).data('count')
      )
    );
  }
);

$.jqplot('traffic-graph', new Array(window.plotData),
{axes:{xaxis:{renderer:$.jqplot.DateAxisRenderer}}}
);

