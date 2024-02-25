<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php

    $person = [
        [
            'fname' => 'Aryan',
            'lname' => 'Shankar',
            'age' => 21,
            'pan' => 'XXXBPG56U',//must be unique
        ],
        [
            'fname' => 'Tony',
            'lname' => 'Stark',
            'age' => 48,
            'pan' => 'TONYS2235A',
        ],
        [
            'fname' => 'Lewis',
            'lname' => 'Hamilton',
            'age' => 38,
            'pan' => 'LEWIS2344H'
        ],
        [
            'fname' => 'Harry',
            'lname' => 'Styles',
            'age' => 21,
            'pan' => 'HARRY4546K'
        ],
        [
            'fname' => 'Robert',
            'lname' => 'Pattinson',
            'age' => 24,
            'pan' => 'ROBPT3434R'
        ],
    ];

    // Display original array
    echo "<h2>Original Array</h2>";
    echo "<pre>";
    print_r($person);
    echo "</pre>";

    // Extract 'pan' values as keys and remove 'pan' key from the inner arrays
    $panValues = array_column($person, null, 'pan');

    // Update the original array with the new structure
    $person = $panValues;

    echo "<h2>Change Made:</h2>";
    echo "<p>The array structure has been updated to use 'pan' values as keys.</p>";

    // Display updated array
    echo "<h2>Updated Array</h2>";
    echo "<pre>";
    print_r($person);
    echo "</pre>";
    
    // using looping to achieve this
    // Initialize an empty array for the transformed structure
    // $newArr = [];

    // // Loop through the original array to transform its structure
    // foreach ($arr1 as $person) {
    //     // Extract PAN value
    //     $pan = $person['pan'];
        
    //     // Remove the 'pan' key from the person array
    //     unset($person['pan']);
        
    //     // Assign the person array to the new structure with the PAN as the key
    //     $newArr[$pan] = $person;
    // }

    // // Update the original array with the new structure
    // $arr1 = $newArr;

    // print_r($arr1);





    // Define a callback function to add the full_name key
    function addFullName(&$person) {
        $person['full_name'] = $person['fname'] . ' ' . $person['lname'];
    }

    // Apply the callback function to each element of the array
    array_walk($person, 'addFullName');


    // done by looping 
    // Add 'full_name' key by combining 'fname' and 'lname'
    // foreach ($person as &$p) {
    //     $p['full_name'] = $p['fname'] . ' ' . $p['lname'];
    // }
    // unset($p); // unset reference variable

    // Display the array with 'full_name' key added
    echo "<h2>Updated Array with full_name Key</h2>";
    echo "<pre>";
    print_r($person);
    echo "</pre>";

    

    




    // Initialize an empty array to store PAN numbers as keys and full names as values
    $panFullNameArray = [];

    // Loop through the original array to construct the new array
    foreach ($person as $p) {
        // Combine first name and last name
        $fullName = $p['fname'] . ' ' . $p['lname'];
        
        // Assign the full name to the PAN number as the key
        $panFullNameArray[$p['pan']] = $fullName;
    }

    // achieve this using using predefined function
    // Use array_reduce to create the new array
    // $panFullNameArray = array_reduce($person, function ($result, $p) {
    //     // Combine first name and last name
    //     $fullName = $p['fname'] . ' ' . $p['lname'];
        
    //     // Assign the full name to the PAN number as the key
    //     $result[$p['pan']] = $fullName;
        
    //     return $result;
    // }, []);

    echo "<h2>New Array with PAN as Key and Full Name as Value</h2>";
    echo "<pre>";
    print_r($panFullNameArray);
    echo "</pre>";






    // Extract ages as keys and full names as values
    $ages = array_column($person, 'age');
    $fullNames = array_column($person, 'full_name');

    // Combine ages and full names into a new array
    $peopleByAge = array_combine($ages, array_fill(0, count($ages), []));

    // Group full names by age
    foreach ($person as $p) {
        $peopleByAge[$p['age']][] = $p['full_name'];
    }


    // done by looping
    // Initialize an empty array to store people grouped by age
    // $peopleByAge = [];

    // // Loop through the original array to group people by age
    // foreach ($person as $p) {
    //     // Extract age and full name
    //     $age = $p['age'];
    //     $fullName = $p['full_name'];
        
    //     // Check if the age key exists in the new array
    //     if (array_key_exists($age, $peopleByAge)) {
    //         // If the age key exists, append the full name to the existing age group
    //         $peopleByAge[$age][] = $fullName;
    //     } else {
    //         // If the age key does not exist, create a new age group with the full name
    //         $peopleByAge[$age] = [$fullName];
    //     }
    // }

    echo "<h2>New Array with People Grouped by Age</h2>";
    echo "<pre>";
    print_r($peopleByAge);
    echo "</pre>";



    

    echo "<h2>Check whether an age of people available or not.</h2>";
    
    $ageToCheck = 30;

    // Extract ages from the original array
    $ages = array_column($person, 'age');

    // Check if the age exists in the array of ages
    if (in_array($ageToCheck, $ages)) {
        echo "The age $ageToCheck is available among the people.";
    } else {
        echo "The age $ageToCheck is not available among the people.";
    }


    // Done by looping
    // Assume the age you want to check
    // $ageToCheck = 30;

    // // Initialize a flag to indicate if the age is found
    // $ageFound = false;

    // // Loop through the original array to check if the age is available
    // foreach ($person as $p) {
    //     if ($p['age'] === $ageToCheck) {
    //         // If the age is found, set the flag to true and break the loop
    //         $ageFound = true;
    //         break;
    //     }
    // }

    // if ($ageFound) {
    //     echo "The age $ageToCheck is available among the people.";
    // } else {
    //     echo "The age $ageToCheck is not available among the people.";
    // }










    echo "<h2>Printing no of records with specific age</h2>";
    
    $ageToCount = 21;

    // Extract ages from the original array
    $ages = array_column($person, 'age');

    // Count the occurrences of each age
    $ageCounts = array_count_values($ages);

    // Check if the specific age exists in the counts
    if (isset($ageCounts[$ageToCount])) {
        echo "Number of records with age $ageToCount: " . $ageCounts[$ageToCount];
    } else {
        echo "No records found with age $ageToCount.";
    }


    // done by looping
    // $ageToCount = 25;

    // // Initialize a counter for the number of records with the specific age
    // $numberOfRecords = 0;

    // // Loop through the original array to count the occurrences of the specific age
    // foreach ($person as $p) {
    //     if ($p['age'] === $ageToCount) {
    //         $numberOfRecords++;
    //     }
    // }

    // echo "Number of records with age $ageToCount: $numberOfRecords";







    echo "<h2>Adding a new people of specific age.</h2>";
    
    $newPerson = [
        'fname' => 'John',
        'lname' => 'Doe',
        'age' => 25,
        'pan' => 'JOHND1234A' 
    ];

    // Add the new person to the original array using array_push()
    array_push($person, $newPerson); // $person[] = $newPerson; This adds the new person to the original array

    // Display the updated array
    echo "<h2>Updated Array with New Person</h2>";
    echo "<pre>";
    print_r($person);
    echo "</pre>";









    echo "<h2>Consider a new array with same structure and combine old array and this together.</h2>";
    // Define the new array with the same structure
    $newPeople = [
        [
            'fname' => 'Emma',
            'lname' => 'Watson',
            'age' => 30,
            'pan' => 'EMMAW1234B' 
        ],
        [
            'fname' => 'Tom',
            'lname' => 'Holland',
            'age' => 26,
            'pan' => 'TOMH3210C'
        ]
    ];

    // Combine the old array with the new array using array_merge()
    $combinedArray = array_merge($person, $newPeople);

    echo "<h2>Combined Array</h2>";
    echo "<pre>";
    print_r($combinedArray);
    echo "</pre>";








    echo "<h2>Checking what happens when combining 2 array with same key.</h2>";
    $array1 = [
        'fname' => 'John',
        'lname' => 'Doe',
        'age' => 30
    ];
    
    $array2 = [
        'fname' => 'Jane',
        'age' => 25,
        'city' => 'New York'
    ];
    
    $combinedArray = array_merge($array1, $array2);
    
    print_r($combinedArray);



    ?>
</body>
</html>
