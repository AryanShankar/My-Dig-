<?php
    $cars = ['hyundai', "tata", "BMW"];
    $cars[] = 'swift'; // appends a assosiative array at end ['swift']
    var_dump($cars);
    echo "<br>";
    print_r($cars);

    $i = 0;
    foreach($cars as $x){ // &$x 
        $x = "Mercedes";
        echo "<br>" . $x . ' ' . $cars[$i];
        $i++;
    }
    unset($x);

    echo "<br>";
    $vehicles = array('multi' => 'sedan', 'small' => 'hatchback', 'single' => 'bike');
    print_r($vehicles);


    echo "<br><br>";
    $assocArray = array(
        'key1' => 'value1',
        'key2' => 'value2'
    );
    
    array_push($assocArray, ['key3' => 'value3']);
    print_r($assocArray);


    $z = true;
?>

<?php if ($z == true): ?>
        <pre style="text-align:center; ">    
            This will show if the expression is true.
            This is cooll
            soooo coolllll
        </pre>
      <?php else: ?>
        Otherwise this will show.
      <?php endif; ?>