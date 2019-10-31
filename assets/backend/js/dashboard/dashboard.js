

window.onload = function () {
    var chart = new CanvasJS.Chart("chartContainer", {
        animationEnabled: true,
        axisY: {
            title: "Number of Users",
        },
        axisX: {
            title: "User registered in",
        },
        data: [{
            type: "splineArea",
            color: "rgba(197, 159, 209,.7)",
            yValueFormatString: "########## Users",
            dataPoints:_dataPoints
        }]
    });
    chart.render();
        
    var chart1 = new CanvasJS.Chart("chartContainer1", {
        animationEnabled: true,
        axisY: {
            title: "Marks"
        },
        axisX: {
            title: "Subjects"
        },
        legend: {
            cursor:"pointer",
        },
        toolTip: {
            shared: true,
        },
        data: [{
            type: "doughnut",
            showInLegend: true,
            name: "Users",
            color: "#c59fd1",
            yValueFormatString: "########## Users",
            dataPoints: [
                { y: _adminCreatedUser, name: "Users", color: "#c59fd1" },
                { y: _systemUser, name: "Users", color: "#250330" }
            ]
        }]
    });
    chart1.render();
}