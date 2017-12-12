var graficosEnvios = function(labels,values,container) {
    var chartData = {
        labels: labels||['Envio'],
        datasets: [{
            backgroundColor: mUtil.getColor('success'),
            data: values||[1]
        }]
    };
    var chartContainer = $('#'+container);
    if (chartContainer.length == 0) {
        return;
    }
    var chart = new Chart(chartContainer, {
        type: 'bar',
        data: chartData||[1],
        options: {
            title: {
                display: false,
            },
            tooltips: {
                intersect: false,
                mode: 'nearest',
                xPadding: 10,
                yPadding: 10,
                caretPadding: 10
            },
            legend: {
                display: false
            },
            responsive: true,
            maintainAspectRatio: false,
            barRadius: 4,
            scales: {
                xAxes: [{
                    display: false,
                    gridLines: false,
                    stacked: true
                }],
                yAxes: [{
                    display: false,
                    stacked: true,
                    gridLines: false
                }]
            },
            layout: {
                padding: {
                    left: 0,
                    right: 0,
                    top: 0,
                    bottom: 0
                }
            }
        }
    });
}


//** Based on Chartist plugin - https://gionkunz.github.io/chartist-js/index.html
var graficosLecturas = function(data, container) {
    if ($('#'+container).length == 0) {
        return;
    }
    if(!data || data.length==0){
        var data = [0,0,0,0];
    }
    $('#plat_total').html(data[0]);
    $('#plat_sent').html(data[1]+'% Recibidos');
    $('#plat_opened').html(data[2]+'% Abiertos');
    $('#plat_bounced').html(data[3]+'% Rechazados');

    var chart = new Chartist.Pie('#'+container, {
        series: [{
                value: data[1],//sent
                className: 'custom',
                meta: {
                    color: mUtil.getColor('success')
                }
            },
            {
                value: data[2],//opened
                className: 'custom',
                meta: {
                    color: mUtil.getColor('warning')
                }
            },
            {
                value: data[3],//bounced
                className: 'custom',
                meta: {
                    color: mUtil.getColor('danger')
                }
            }
        ],
        labels: [1, 2, 3]
    }, {
        donut: true,
        donutWidth: 17,
        showLabel: false
    });

    chart.on('draw', function(data) {
        if (data.type === 'slice') {
            // Get the total path length in order to use for dash array animation
            var pathLength = data.element._node.getTotalLength();

            // Set a dasharray that matches the path length as prerequisite to animate dashoffset
            data.element.attr({
                'stroke-dasharray': pathLength + 'px ' + pathLength + 'px'
            });

            // Create animation definition while also assigning an ID to the animation for later sync usage
            var animationDefinition = {
                'stroke-dashoffset': {
                    id: 'anim' + data.index,
                    dur: 1000,
                    from: -pathLength + 'px',
                    to: '0px',
                    easing: Chartist.Svg.Easing.easeOutQuint,
                    // We need to use `fill: 'freeze'` otherwise our animation will fall back to initial (not visible)
                    fill: 'freeze',
                    'stroke': data.meta.color
                }
            };

            // If this was not the first slice, we need to time the animation so that it uses the end sync event of the previous animation
            if (data.index !== 0) {
                animationDefinition['stroke-dashoffset'].begin = 'anim' + (data.index - 1) + '.end';
            }

            // We need to set an initial value before the animation starts as we are not in guided mode which would do that for us

            data.element.attr({
                'stroke-dashoffset': -pathLength + 'px',
                'stroke': data.meta.color
            });

            // We can't use guided mode as the animations need to rely on setting begin manually
            // See http://gionkunz.github.io/chartist-js/api-documentation.html#chartistsvg-function-animate
            data.element.animate(animationDefinition, false);
        }
    });

    // For the sake of the example we update the chart every time it's created with a delay of 8 seconds
    // chart.on('created', function() {
    //     if (window.__anim21278907124) {
    //         clearTimeout(window.__anim21278907124);
    //         window.__anim21278907124 = null;
    //     }
    //     window.__anim21278907124 = setTimeout(chart.update.bind(chart), 15000);
    // });
}
