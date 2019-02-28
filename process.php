<?php
session_start();

require 'Form.php';

use DWA\Form;

$form = new Form($_GET);

$firstName = strtoupper($form->get('firstName')); # first name needs to be upper case for card formatting
$lastName = strtoupper($form->get('lastName')); # last name needs to be upper case for card formatting
$position = $form->get('position');
$department = $form->get('department');
$workAddress = $form->get('workAddress');
$workPhone = $form->get('workPhone');
$cellPhone = $form->get('cellPhone');
$workEmail = $form->get('workEmail');
$departmentEmail = $form->get('departmentEmail');
$omitCell = $form->get('omitCell');
$omitDepartment = $form->get('omitDepartment');

$errors = [];
$errors = $form->validate([
    'firstName' => 'required',
    'lastName' => 'required',
    'position' => 'required',
    'department' => 'required',
    'workAddress' => 'required',
    'workPhone' => 'required|numeric|equalLength:10', # equalLength is custom function in Form object
    'workEmail' => 'required|email'
]);

if ($omitCell != 'on') {
    $errors = array_merge($errors, $form->validate(['cellPhone' => 'required|numeric|equalLength:10'])); # if omitCell is not checked, add new validation results to $errors array
}

if ($omitDepartment != 'on') {
    $errors = array_merge($errors, $form->validate(['departmentEmail' => 'required|email'])); # if omitDepartment is not checked, add new validation results to $errors array
}

$_SESSION['results'] = [
    'errors' => $errors,
    'hasErrors' => $form->hasErrors,
    'firstName' => $firstName,
    'lastName' => $lastName,
    'position' => $position,
    'department' => $department,
    'workAddress' => $workAddress,
    'workPhone' => $workPhone,
    'cellPhone' => $cellPhone,
    'workEmail' => $workEmail,
    'departmentEmail' => $departmentEmail,
    'omitCell' => $omitCell,
    'omitDepartment' => $omitDepartment
];

header('Location: index.php');