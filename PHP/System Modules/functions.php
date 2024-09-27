<?php
function clean_input($input) {
    $input = htmlspecialchars(strip_tags(trim($input)), ENT_QUOTES, 'UTF-8'); 
    //Purpose of this is nested functions to sanitize user input

    return $input; //return the now sanitize input
}

function extractUsername($email) {
    // Use explode to split the email at the '@' character
    $parts = explode('@', $email);

    // Take the first part of the split email, which is the username
    $username = $parts[0];

    // Capitalize the username
    $capitalizedUsername = strtoupper($username);

    // Return the capitalized username
    return $capitalizedUsername;
}

function modifiedPasswordHashing($password, $salt) {
    $pepper = 'SaltnPaperGoesWell';
    $options = [
        'cost' => 15    //this set the computational expense
    ];

    $encrypted = hash('sha256', $password . $salt . $pepper);
    $encrypted = password_hash($encrypted, PASSWORD_DEFAULT, $options);
    
    return $encrypted;
}