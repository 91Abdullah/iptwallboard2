

$(document).ready(function() {

    $('#queue-status').load('queue.php', function() {
        serviceLvl.value = $('#serviceLevelVal').html().slice(0, -1);
        answeredLevelGauge.value = totalAnsweredPercent;
        abandonedLevelGauge.value = totalUnAnsweredPercent;
    });

    var refresh = setInterval(function() {
        $('#queue-status').load('queue.php', function() {
            serviceLvl.value = $('#serviceLevelVal').html().slice(0, -1);
            answeredLevelGauge.value = totalAnsweredPercent;
            abandonedLevelGauge.value = totalUnAnsweredPercent;
        });
    }, 2000)

    var serviceLvl = new RadialGauge({
        renderTo: 'serviceLevel',
        width: 300,
        height: 300,
        units: "Percentage",
        title: "Service Level",
        minValue: 0,
        maxValue: 100,
        majorTicks: [
            0,
            10,
            20,
            30,
            40,
            50,
            60,
            70,
            80,
            90,
            100
        ],
        minorTicks: 2,
        strokeTicks: true,
        highlights: [
            {
                "from": 0,
                "to": 50,
                "color": "rgba(255, 0, 0, .3)"
            },
            {
                "from": 50,
                "to": 100,
                "color": "rgba(0,255, 0, .3)"
            }
        ],
        ticksAngle: 225,
        startAngle: 67.5,
        colorMajorTicks: "#ddd",
        colorMinorTicks: "#ddd",
        colorTitle: "#eee",
        colorUnits: "#ccc",
        colorNumbers: "#eee",
        colorPlate: "#222",
        borderShadowWidth: 0,
        borders: true,
        needleType: "arrow",
        needleWidth: 2,
        needleCircleSize: 7,
        needleCircleOuter: true,
        needleCircleInner: false,
        animationDuration: 1500,
        animationRule: "linear",
        colorBorderOuter: "#333",
        colorBorderOuterEnd: "#111",
        colorBorderMiddle: "#222",
        colorBorderMiddleEnd: "#111",
        colorBorderInner: "#111",
        colorBorderInnerEnd: "#333",
        colorNeedleShadowDown: "#333",
        colorNeedleCircleOuter: "#333",
        colorNeedleCircleOuterEnd: "#111",
        colorNeedleCircleInner: "#111",
        colorNeedleCircleInnerEnd: "#222",
        valueBoxBorderRadius: 0,
        colorValueBoxRect: "#222",
        colorValueBoxRectEnd: "#333"
    }).draw();

    var answeredLevelGauge = new RadialGauge({
        renderTo: 'answeredLevel',
        width: 300,
        height: 300,
        units: "Percentage",
        title: "Answered",
        minValue: 0,
        maxValue: 100,
        majorTicks: [
            0,
            10,
            20,
            30,
            40,
            50,
            60,
            70,
            80,
            90,
            100
        ],
        minorTicks: 2,
        strokeTicks: true,
        highlights: [
            {
                "from": 0,
                "to": 50,
                "color": "rgba(255, 0, 0, .3)"
            },
            {
                "from": 50,
                "to": 100,
                "color": "rgba(0,255, 0, .3)"
            }
        ],
        ticksAngle: 225,
        startAngle: 67.5,
        colorMajorTicks: "#000",
        colorMinorTicks: "#000",
        colorTitle: "#000",
        colorUnits: "#000",
        colorNumbers: "#000",
        colorPlate: "#ddd",
        borderShadowWidth: 0,
        borders: true,
        needleType: "arrow",
        needleWidth: 2,
        needleCircleSize: 7,
        needleCircleOuter: true,
        needleCircleInner: false,
        animationDuration: 1500,
        animationRule: "linear",
        colorBorderOuter: "#333",
        colorBorderOuterEnd: "#111",
        colorBorderMiddle: "#222",
        colorBorderMiddleEnd: "#111",
        colorBorderInner: "#111",
        colorBorderInnerEnd: "#333",
        colorNeedleShadowDown: "#333",
        colorNeedleCircleOuter: "#333",
        colorNeedleCircleOuterEnd: "#111",
        colorNeedleCircleInner: "#111",
        colorNeedleCircleInnerEnd: "#222",
        valueBoxBorderRadius: 0,
        colorValueBoxRect: "#222",
        colorValueBoxRectEnd: "#333"
    }).draw();

    var abandonedLevelGauge = new RadialGauge({
        renderTo: 'abandonedLevel',
        width: 300,
        height: 300,
        units: "Percentage",
        title: "Abandoned",
        minValue: 0,
        maxValue: 100,
        majorTicks: [
            0,
            10,
            20,
            30,
            40,
            50,
            60,
            70,
            80,
            90,
            100
        ],
        minorTicks: 2,
        strokeTicks: true,
        highlights: [
            {
                "from": 0,
                "to": 50,
                "color": "rgba(0,255, 0, .8)"
            },
            {
                "from": 50,
                "to": 100,
                "color": "rgba(255, 0, 0, .8)"
            }
        ],
        ticksAngle: 225,
        startAngle: 67.5,
        colorMajorTicks: "#ddd",
        colorMinorTicks: "#ddd",
        colorTitle: "#eee",
        colorUnits: "#ccc",
        colorNumbers: "#eee",
        colorPlate: "#555",
        borderShadowWidth: 0,
        borders: true,
        needleType: "arrow",
        needleWidth: 2,
        needleCircleSize: 7,
        needleCircleOuter: true,
        needleCircleInner: false,
        animationDuration: 1500,
        animationRule: "linear",
        colorBorderOuter: "#333",
        colorBorderOuterEnd: "#111",
        colorBorderMiddle: "#222",
        colorBorderMiddleEnd: "#111",
        colorBorderInner: "#111",
        colorBorderInnerEnd: "#333",
        colorNeedleShadowDown: "#333",
        colorNeedleCircleOuter: "#333",
        colorNeedleCircleOuterEnd: "#111",
        colorNeedleCircleInner: "#111",
        colorNeedleCircleInnerEnd: "#222",
        valueBoxBorderRadius: 0,
        colorValueBoxRect: "#222",
        colorValueBoxRectEnd: "#333"
    }).draw();
});