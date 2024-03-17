<?php

use function Livewire\Volt\{state};

//

?>

<div>
    <style>
        #chartdiv {
            width: 100%;
            height: 500px
        }
    </style>
    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/map.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/usaLow.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
    <script>
        am5.ready(function() {

// Create root
            var root = am5.Root.new("chartdiv");

// Set themes
            root.setThemes([
                am5themes_Animated.new(root)
            ]);

// Create chart
            var chart = root.container.children.push(am5map.MapChart.new(root, {
                panX: "rotateX",
                panY: "none",
                projection: am5map.geoAlbersUsa(),
                layout: root.horizontalLayout
            }));

// Create polygon series
            var polygonSeries = chart.series.push(am5map.MapPolygonSeries.new(root, {
                geoJSON: am5geodata_usaLow,
                valueField: "value",
                calculateAggregates: true
            }));

            polygonSeries.mapPolygons.template.setAll({
                tooltipText: "{name}: {value}"
            });

            polygonSeries.set("heatRules", [{
                target: polygonSeries.mapPolygons.template,
                dataField: "value",
                min: am5.color(0xff621f),
                max: am5.color(0x661f00),
                key: "fill"
            }]);

            polygonSeries.mapPolygons.template.events.on("pointerover", function(ev) {
                heatLegend.showValue(ev.target.dataItem.get("value"));
            });

            polygonSeries.data.setAll([
                { id: "US-FL", value: 15982378 },
                { id: "US-GA", value: 8186453 },
                { id: "US-LA", value: 4468976 },
                { id: "US-SC", value: 4012012 },
                { id: "US-TX", value: 20851820 },
            ]);

            var heatLegend = chart.children.push(am5.HeatLegend.new(root, {
                orientation: "vertical",
                startColor: am5.color(0xff621f),
                endColor: am5.color(0x661f00),
                startText: "Lowest",
                endText: "Highest",
                stepCount: 5
            }));

            heatLegend.startLabel.setAll({
                fontSize: 12,
                fill: heatLegend.get("startColor")
            });

            heatLegend.endLabel.setAll({
                fontSize: 12,
                fill: heatLegend.get("endColor")
            });

// change this to template when possible
            polygonSeries.events.on("datavalidated", function () {
                heatLegend.set("startValue", polygonSeries.getPrivate("valueLow"));
                heatLegend.set("endValue", polygonSeries.getPrivate("valueHigh"));
            });

        }); // end am5.ready()
    </script>

    <div id="chartdiv"></div>
</div>
