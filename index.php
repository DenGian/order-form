<?php

// This file is your starting point (= since it's the index)
// It will contain most of the logic, to prevent making a messy mix in the html

// This line makes PHP behave in a more strict way
declare(strict_types=1);

// We are going to use session variables so we need to enable sessions
session_start();

// Use this function when you need to need an overview of these variables
function whatIsHappening()
{
    echo '<h2>$_GET</h2>';
    var_dump($_GET);
    echo '<h2>$_POST</h2>';
    var_dump($_POST);
    echo '<h2>$_COOKIE</h2>';
    var_dump($_COOKIE);
    echo '<h2>$_SESSION</h2>';
    var_dump($_SESSION);
}

// TODO: provide some products (you may overwrite the example)
$breakfast = [
    ['name' => 'Ham & Eggs', 'price' => 6.69],
    ['name' => 'Pork Chops', 'price' => 8.49],
    ['name' => 'Omelettes Ham & Cheese', 'price' => 6.99],
    ['name' => 'Omelettes Plain Cheese', 'price' => 6.69],
];
$burgers = [
    ['name' => 'Hamburger', 'price' => 2.99],
    ['name' => 'Cheeseburger', 'price' => 3.49],
    ['name' => 'Double Cheeseburger', 'price' => 4.99],
    ['name' => 'Patty Melt', 'price' => 4.39],
    ['name' => 'Chili Cheese Burger', 'price' => 3.99],
];
$sandwiches = [
    ['name' => 'Rib Eye Steak', 'price' => 6.99],
    ['name' => 'Philly Cheese Steak', 'price' => 6.99],
    ['name' => 'Pastrami', 'price' => 6.99],
    ['name' => 'Fish Sandwich', 'price' => 4.19],
];
$totalValue = 0;

function handleForm($food)
{
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    // TODO: form related tasks (step 1)

    // Validation (step 2)
    $invalidFields = validate();
    if (!empty($invalidFields)) {
        // TODO: handle errors
        echo '<div class="alert alert-danger" role="alert">';
        echo $error;
        echo '</div>';
    } else {
        // TODO: handle successful submission
        echo '<div class="alert alert-success" role="alert">';
        echo 'The order was made successfully!' . '<br>';
        echo 'confirmation E-mail has been send to: ';
        echo $email . '<br>';
        echo 'The address for the order is:' . '<br>';
        echo getData() . '<br>';
        echo 'you ordered the following products:' . '<br>';
        echo getOrder($food);
        echo '</div>';
    }
}

function validate()
{
    // TODO: This function will send a list of invalid fields back
    $error = [];
    $errorEmail = 'Please be sure to write a valid Email';
    $errorStreet_City = 'Field is required, Please check if field is correctly filled in! Can only include letters!';
    $errorStreetNumber ='Street number field is required, Please check if field is correctly filled in!';
    $errorZipCode =   'Zipcode field is required, Please check if field is correctly filled in! Can only include numbers!';
    $errorProducts = 'You need to choose one of our products!';

    if (empty(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))) {
        array_push($error,  $errorEmail);
    }
    //validate street
    if (empty($_POST['street'])) {
        array_push($error, 'street' . $errorStreet_City);
    }
    //validate streetnumber
    if (empty($_POST['streetnumber'])) {
        array_push($error, $errorStreetNumber);
    }

    //validate city
    if (!ctype_alpha($_POST['city'])) {
        array_push($error, 'city' . $errorStreet_City);
    }
    //validate zipcode
    if (empty($_POST['zipcode'])) {
        array_push($error, $errorZipCode);
    } else if (!ctype_digit($_POST['zipcode'])) {
        array_push($error, $errorZipCode);
    }
    //validate products
    if (empty($_POST['products'])) {
        array_push($error, $errorProducts);
    }
    return $error;
}

function getData (){
    $street = $_POST['street'];
    $streetNumber = $_POST['streetnumber'];
    $city = $_POST['city'];
    $zipcode = $_POST['zipcode'];
    $data = $street . ' ' . $streetNumber . '<br>' . $zipcode . ' ' . $city . '<br>';
    return $data;
}
function getOrder ($products)
{
    $order = '';
    foreach ($_POST['products'] as $key=> $product) {
        $order .= $products[$key]['name'] . '<br>';
    }
    return $order;
}

// TODO: replace this if by an actual check
$formSubmitted = false;
$food = [...$breakfast, ...$burgers, ...$sandwiches];
if (isset($_POST['submit'])) {
    $formSubmitted = true;
}
if ($formSubmitted) {
    handleForm($food);
    // whatIsHappening();
//}
//if ($formSubmitted) {
//    handleForm($burgers);
//}
//if ($formSubmitted) {
//    handleForm($sandwiches);
}
//$_SESSION($_POST['street']);

require 'form-view.php';
