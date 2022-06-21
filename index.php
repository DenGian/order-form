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

function handleForm($sandwiches)
{
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    // TODO: form related tasks (step 1)

    // Validation (step 2)
    $invalidFields = validate();
    if (!empty($invalidFields)) {
        // TODO: handle errors
        echo '<div class="alert alert-danger" role="alert">';

        echo '</div>';
    } else {
        // TODO: handle successful submission
        echo '<div class="alert alert-success" role="alert">';
        echo 'The order was made successfully!' . '<br>';
        echo 'confirmation E-mail has been send to: ';
        echo $email . '<br>';
        echo 'The address for the order is:' . '<br>';
        echo getData() . '<br>';
        echo '</div>';
        echo getOrder($sandwiches);
    }
}

function validate()
{
    // TODO: This function will send a list of invalid fields back
    return [];
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
    foreach ($_POST['products'] as $value=> $product) {
        $order .= $products[$value]['name'];
    }
    return $order;
}
// $food = [$breakfast, $burgers, $sandwiches];
// TODO: replace this if by an actual check
$formSubmitted = false;
if (isset($_POST['submit'])) {
    $formSubmitted = true;
}
if ($formSubmitted) {
    handleForm($sandwiches);
}
require 'form-view.php';