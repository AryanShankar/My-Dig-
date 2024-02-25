<?php

// Custom exception class
class CustomException extends Exception {
    public function errorMessage() {
        // Custom error message
        $errorMsg = 'Error on line '.$this->getLine().' in '.$this->getFile()
        .': <b>'.$this->getMessage().'</b> is not a valid email address';
        return $errorMsg;
    }
}

// Function to validate email
function validateEmail($email) {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Throw custom exception if email is invalid
        throw new CustomException($email);
    } else {
        echo "Email is valid: $email";
    }
}

// Function to simulate division by zero error
function divide($dividend, $divisor) {
    if ($divisor == 0) {
        // Throw built-in DivisionByZeroError
        throw new DivisionByZeroError("Cannot divide by zero. hii");
    } else {
        return $dividend / $divisor;
    }
}

try {
    // Try to validate an email
    validateEmail("a@b");
} catch (CustomException $e) {
    // Catch custom exception
    echo $e->errorMessage();
} catch (Exception $e) {
    // Catch any other exceptions
    echo "Caught exception: " . $e->getMessage();
} finally {
    // Finally block, executes regardless of whether an exception is thrown or not
    echo "<br>Finally block executed.";
}

echo "<br>";

try {
    // Try to perform a division
    echo divide(10, 0);
} catch (DivisionByZeroError $e) {
    // Catch built-in DivisionByZeroError
    echo "Caught division by zero error: " . $e->getMessage();
} catch (Exception $e) {
    // Catch any other exceptions
    echo "Caught exception: " . $e->getMessage();
} finally {
    // Finally block, executes regardless of whether an exception is thrown or not
    echo "<br>Finally block executed.";
}

?>
