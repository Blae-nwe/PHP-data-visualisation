// jQuery functions to manipulate the main page and handle communication with
// the theData web service via Ajax.
//
// Note that there is very little error handling in this file.  In particular, there
// is no validation in the handling of form data.  This is to avoid obscuring the 
// core concepts that the demo is supposed to show.
$.getScript("loader.js", function() {
    alert("Script loaded but not necessarily executed.");
 });


function getAllData()
{
    $.ajax({
        url: '/data',
        type: 'GET',
        cache: false,
        dataType: 'json',
        success: function (data) {
            createDataTable(data);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert(jqXHR + '\n' + textStatus + '\n' + errorThrown);
        }
    });
}
function createDataTable(Data)
{
    var strResult = '<div class="col-md-12">' + 
                    '<table class="table table-bordered table-hover">' +
                    '<thead>' +
                    '<tr>' +
                    '<th>Type of Force</th>' +
                    '<th>Tactic</th>' +
                    '<th>Total</th>' +
                    '</tr>' +
                    '</thead>' +
                    '<tbody>';
    $.each(Data, function (index, theData)
    {          
        console.log(theData.TypeOfForce);              
        strResult += "<tr><td>" + theData.TypeOfForce + "</td><td> " + theData.Tactic + "</td><td>" + theData.Total + "</td></tr>";
    });
    strResult += "</tbody></table>";
    $("#allData").html(strResult);
}

function getDataForPie()
{
    $.ajax({
        url: '/data',
        type: 'GET',
        cache: false,
        dataType: 'json',
        success: function (data) {
            createPieChart(data);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert(jqXHR + '\n' + textStatus + '\n' + errorThrown);
        }
    });
}
function createPieChart(Data){
    var tacticTotal = [['Tactic','Total']];
    
    var strResult = '<div class="col-md-12">' + 
                    '<div id="piechart">'+
                    '</div>'+
                    '</div>'
    $.each(Data, function(index, theData){
        tactic = theData.Tactic;
        total = theData.Total;
        if(theData.TypeOfForce=="Restraint" && theData.Tactic!="Handcuffing, of which"){
            tacticTotal.push([tactic,parseInt(total)]);
        }

    })
    console.log(tacticTotal);
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart(){
        var data = google.visualization.arrayToDataTable(
            tacticTotal
        );
        var options = {'title':'Restraint','width':550,'height':400};
        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        chart.draw(data,options);
    }
    
    $("#allData").html(strResult);
}
