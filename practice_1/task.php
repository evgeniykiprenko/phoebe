<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
</head>
<body>
<div class="card-panel teal lighten-2">
<?php
    $arr = array();
    for ($i = 0; $i < 5; $i++) {
        $temp = array_fill(0, 9, rand(1, 1488));
        array_push($arr, $temp);
    }

    echo '<table>';
        for ($i = 0; $i < count($arr); $i++) {
            echo '<tr>';
                for ($j = 0; $j < count($arr[$i]); $j++) {
                    echo '<td>'.$arr[$i][$j].'</td>';
                }    
            echo '</tr>';
        }
    echo '</table>';
?>    
</div>
</body>
</html>

