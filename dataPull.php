<?php

# this file will repopulate form after submit is hit to show previous data entry, if previous data entry exists

session_start();

$hasErrors = false;

if (isset($_SESSION['results'])) {
    $results = $_SESSION['results'];
    $firstName = $results['firstName'];
    $lastName = $results['lastName'];
    $position = $results['position'];
    $department = $results['department'];
    $workAddress = $results['workAddress'];
    $workPhone = $results['workPhone'];
    $cellPhone = $results['cellPhone'];
    $workEmail = $results['workEmail'];
    $departmentEmail = $results['departmentEmail'];
    $errors = $results['errors'];
    $hasErrors = $results['hasErrors'];
    $omitCell = $results['omitCell'];
    $omitDepartment = $results['omitDepartment'];
}

session_unset();