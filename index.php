<?php
require 'dataPull.php';
?>

<!DOCTYPE html>
<html lang='en'>
<head>
    <title>Harvard Campus Services Business Card Creator</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<div id='wrapperForm'>
    <h2>Harvard Campus Services - Business Card Generator</h2>
    <img src='images/harvard_shield.png' alt='harvard logo' id='formLogo'>
    <form method='get' action='process.php'>

        <!-- first name -->
        <label>
            First name:<br>
            <input type='text' name='firstName' value='<?php if (isset($firstName)) {
                echo $firstName;
            } ?>'>
        </label>
        <br>

        <!-- last name -->
        <p>
            <label>
                Last name:<br>
                <input type='text' name='lastName' value='<?php if (isset($lastName)) {
                    echo $lastName;
                } ?>'>
            </label>
        </p>

        <!-- position -->
        <p>
            <label>
                Position:<br>
                <input type='text' name='position' value='<?php if (isset($position)) {
                    echo $position;
                } ?>'>
            </label>
        </p>

        <!-- department -->
        <p>
            <label>
                Department:<br>
                <select name='department' id='list'>
                    <option value='<?php if (isset($department)) {
                        echo $department;
                    } ?>'>
                        <?php if (isset($department)) {
                            echo $department;
                        } else {
                            echo '';
                        } ?>
                    </option>
                    <option value='Dining'>Dining</option>
                    <option value='Event Management'>Event Management</option>
                    <option value='Harvard Faculty Club'>Harvard Faculty Club</option>
                    <option value='Harvard Real Estate'>Harvard Real Estate</option>
                    <option value='Office for Sustainability'>Office for Sustainability</option>
                    <option value='Energy and Facilities'>Energy and Facilities</option>
                    <option value='Global Support Services'>Global Support Services</option>
                    <option value='Harvard International Office'>Harvard International Office</option>
                    <option value='Harvard University Housing'>Harvard University Housing</option>
                    <option value='Transportation'>Transportation</option>
                </select>
            </label>
        </p>

        <!-- work address -->
        <label>
            Work address:<br>
            <input type='text' name='workAddress' value='<?php if (isset($workAddress)) {
                echo $workAddress;
            } ?>'>
        </label>
        <br>

        <!-- work phone -->
        <p>
            <label>
                Work phone:<br>
                <input type='tel' name='workPhone' value='<?php if (isset($workPhone)) {
                    echo $workPhone;
                } ?>'>
                <br>
            </label>
        </p>

        <!-- cell phone -->
        <p>
            <label>
                Cell phone:<br>
                <input type='tel' name='cellPhone' value='<?php if (isset($cellPhone)) {
                    echo $cellPhone;
                } ?>'>
            </label><br>
            <label>
                <input type='checkbox'
                       class='omitField'
                       name='omitCell' <?php if (isset($omitCell) && $omitCell == 'on') {
                    echo 'checked';
                } ?>><em>Check to omit personal cell phone</em>
            </label>
        </p>

        <!-- work email -->
        <p>
            <label>
                Work email:<br>
                <input type='email' name='workEmail' value='<?php if (isset($workEmail)) {
                    echo $workEmail;
                } ?>'>
            </label>
        </p>

        <!-- department email -->
        <p><label>
                Department email:<br>
                <input type='email' name='departmentEmail' value='<?php if (isset($departmentEmail)) {
                    echo $departmentEmail;
                } ?>'></label><br>
            <label>
                <input type='checkbox'
                       class='omitField'
                       name='omitDepartment' <?php if (isset($omitDepartment) && $omitDepartment == 'on') {
                    echo 'checked';
                } ?>><em>Check to omit department email</em>
            </label>
        </p>

        <input type='submit' value='SUBMIT'>

    </form>

    <div id='wrapperErrors'>
        <?php if (isset($results)) : ?>
            <?php if ($hasErrors || is_null($omitDepartment) || is_null($omitCell)): #$hasErrors does not account for checkbox changes, so they need to be checked separately ?>
                <ul>
                    <?php foreach ($errors as $error): ?>

                        <li><?= $error ?></li>
                    <?php endforeach ?>
                </ul>
            <?php endif ?>
        <?php endif ?>
    </div>

</div>

<!-- business card output - uses spans to handle "sloppy" formatting necessary for complexity - this was based on an actual Campus Services business card-->
<?php if (isset($results) && empty($errors)) : # the card will only be displayed if there are no errors ?>
    <p id='wrapperCard'>
        <span id='cardHeader1'>HARVARD</span><br>
        <span id='cardHeader2'>CAMPUS SERVICES</span><br>
        <img src='images/harvard_shield.png' id='miniShield' alt='harvard logo'><br>
        <!-- This is where variables are tested for accessibility -->

        <span id='cardName'>
            <?= $firstName ?>
            <?= $lastName ?>
        </span><br>
        <span id='cardPosition'><?= $position ?></span><br>
        <?= $department ?><br>
        <?= $workAddress ?><br>
        <?= 'T ' . $workPhone ?>

        <?php if (is_null($omitCell)): ?>
            &emsp;<?= 'C ' . $cellPhone ?><br>
        <?php else : ?>
            <br>
        <?php endif ?>
        <?= $workEmail ?>
        <?php if (is_null($omitDepartment)): ?>
            &emsp;<?= $departmentEmail ?>
        <?php endif ?>
    </p>
<?php endif ?>


</body>
</html>