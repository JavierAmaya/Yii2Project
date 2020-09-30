<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
            echo $saluda;
        ?>
        <p> 
            <?php
              foreach ($array as $key => $value) {
                echo $array[$value];
              }
            ?>
        </p>    
        <?php foreach ($array as $value): ?>
            <p><strong><?=$value?></strong></p>
        <?php endforeach?>     
        <h1><?=$get?></h1>      
    </body>
</html>
