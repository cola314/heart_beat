<?php
    $user_name = $_COOKIE["user_id"];

    $host = 'localhost';
    $username = 'root'; # MySQL 계정 아이디
    $password = '1234'; # MySQL 계정 패스워드
    $dbname = 'heart_beat_db';  # DATABASE 이름

    $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');

    try {
        $con = new PDO("mysql:host={$host};dbname={$dbname};charset=utf8",$username, $password);
    } catch(PDOException $e) {
        die("Failed to connect to the database: " . $e->getMessage());
    }
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $con->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    $query = "select id from user where name=\"$user_name\"";
    $result = $con->query($query);

    $user_code = $result->fetch()['id'];


    #데이터 가져오기
    $query = "Select * from data where id=$user_code order by time asc";
    $result = $con->query($query);

    #그래프 그리기
    $data = array(
    	array('원소', '심박값'),
        array('날짜', 0)
    );

    while($row = $result->fetch())
    {
        array_push($data, array($row['time'], $row['value']));
    }

    $options = array(
    	'title' =>  $user_name . ' 심박 정보',
    	'width' => '100%', 'height' => 500
    );
?>
<script src="//www.google.com/jsapi"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.min.js"></script>

<script>
var chart_data = <?= json_encode($data) ?>;
var options = <?= json_encode($options) ?>;
var chart;
google.load('visualization', '1.0', {'packages':['corechart']});
google.setOnLoadCallback(function() {
  chart = new google.visualization.LineChart(document.querySelector('#chart_div'));
  chart.draw(google.visualization.arrayToDataTable(chart_data), options);
});



function my_Data() {
    var sendData = {name:"<?= $user_name ?>", id:<?= $user_code ?>, time:chart_data[chart_data.length-1][0]};
    console.log(sendData);

    return sendData;
}

function refresh(method) {
    $.ajax({
        type: method,
        url : "json_server.php?mode=" + method,
        data: my_Data(),
        dataType:"json",
        success : function(data, status, xhr) {
            console.log(data);
            chart_data_set(data);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log(jqXHR.responseText);
        }
    });
}

function chart_data_set(data) {
    for(var i = 0; i < data.length; i++){
        chart_data.push([JSON.parse(data[i])['time'], JSON.parse(data[i])['val']]);
    }
    chart.draw(google.visualization.arrayToDataTable(chart_data), options);
}
setInterval(function(){
    refresh('GET');


}, 1000);





</script>
<div id="chart_div"></div>



<script type="text/javascript">
//<![CDATA[

</script>
