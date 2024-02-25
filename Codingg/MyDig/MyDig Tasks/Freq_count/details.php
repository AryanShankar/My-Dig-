<?php
$person_details = array();

$send = "Hey I am Aryan";

$person_details['Name'] = 'John Doe';
$person_details['Phone number'] = '123-456-7890';
$person_details['Address'] = '123 Main Street, City, Country';
$person_details['Age'] = '30';

function getAdditionalInfo() {
    return 'Some additional information here';
}

return $send;
?>
