<!-- 4.3 -->
<!-- File : processData_form.html -->
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Register</title>
<style>
body { font-family: Arial, sans-serif; }
.field { margin: 6px 0; }
.field label { display: inline-block; width: 120px; text-align: right; margin-right: 8px; }
</style>
</head>
<body>
<h1>Register</h1>
<!-- Form pendaftaran data pribadi -->
<fieldset>
<legend>Person Details</legend>
<form name="myForm" action="processData.php" method="POST">
<div class="field">
<label for="surname">Surname</label>
<input type="text" name="surname" size="31"/>
</div>
<div class="field">
<label for="email">Email address</label>
<input type="text" name="email" size="31"/>
</div>
<div class="field">
<label for="passwd">Password</label>
<input type="password" name="passwd" size="31"/>
</div>
<div class="field">
<label for="address">Street Address</label>
<textarea name="address" rows="3" cols="22"></textarea>
</div>
<div class="field">
<label for="state">State</label>
<select name="state">
<option value="-1" selected>[choose your state]</option>
<option value="1">Australian Capital Territory</option>
<option value="2">Queensland</option>
<option value="3">Victoria</option>
<option value="4">New South Wales</option>
<option value="5">Tasmania</option>
<option value="6">South Australia</option>
<option value="7">Western Australia</option>
<option value="8">Northern Territory</option>
</select>
</div>
<div class="field">
<input type="hidden" name="country" value="Australia"/>
</div>
<div class="field">
<label for="sex">Gender</label>
<input type="radio" name="sex" value="male"/>Male
<input type="radio" name="sex" value="female"/>Female
</div>
<div class="field">
<label for="vegetarian">Vegetarian?</label>
<input type="checkbox" name="vegetarian"/>
</div>
<div class="field">
<label>&nbsp;</label>
<input type="submit" value="Submit" name="submit"/><input type="reset" value="Reset" name="reset"/>
</div>
</form>
</fieldset>
</body>
</html>


<?php
//File : processData.php
// processData.php : menampilkan isian form (array asosiatif $_POST)
echo "<h1>Data yang dikirimkan</h1>";
echo "<table border='1' cellpadding='4' cellspacing='0'>";
echo "<tr><th>Field</th><th>Value</th></tr>";
// perulangan FOREACH untuk memproses array asosiatif
foreach ($_POST as $field => $value)
    echo "<tr><td>" . htmlspecialchars($field) . "</td><td>" . htmlspecialchars($value) . "</td></tr>";
echo "</table>";
// Untuk uji method GET: ubah method form menjadi "GET" dan ganti $_POST dengan $_GET
?>




<!-- 4.3.1 -->
<!-- Langkah 1-3 -->
<!-- File : processData_form.html -->
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Register</title>
<style>
body { font-family: Arial, sans-serif; }
.field { margin: 6px 0; }
.field label { display: inline-block; width: 120px; text-align: right; margin-right: 8px; }
</style>
</head>
<body>
<h1>Register</h1>
<!-- Form pendaftaran data pribadi -->
<fieldset>
<legend>Person Details</legend>
<form name="myForm" action="processData.php" method="POST">
<div class="field">
<label for="surname">Surname</label>
<input type="text" name="surname" size="31"/>
</div>
<div class="field">
<label for="email">Email address</label>
<input type="text" name="email" size="31"/>
</div>
<div class="field">
<label for="passwd">Password</label>
<input type="password" name="passwd" size="31"/>
</div>
<div class="field">
<label for="address">Street Address</label>
<textarea name="address" rows="3" cols="22"></textarea>
</div>
<div class="field">
<label for="state">State</label>
<select name="state">
<option value="-1" selected>[choose your state]</option>
<option value="1">Australian Capital Territory</option>
<option value="2">Queensland</option>
<option value="3">Victoria</option>
<option value="4">New South Wales</option>
<option value="5">Tasmania</option>
<option value="6">South Australia</option>
<option value="7">Western Australia</option>
<option value="8">Northern Territory</option>
</select>
</div>
<div class="field">
<input type="hidden" name="country" value="Australia"/>
</div>
<div class="field">
<label for="sex">Gender</label>
<input type="radio" name="sex" value="male"/>Male
<input type="radio" name="sex" value="female"/>Female
</div>
<div class="field">
<label for="vegetarian">Vegetarian?</label>
<input type="checkbox" name="vegetarian"/>
</div>
<div class="field">
<label>&nbsp;</label>
<input type="submit" value="Submit" name="submit"/><input type="reset" value="Reset" name="reset"/>
</div>
</form>
</fieldset>
</body>
</html>


<?php
//File : processData.php
require 'validate.inc';
if (validateName($_POST, 'surname'))
    echo 'Data OK!';
else
    echo 'Data invalid!';
?>


<?php
//File : Validate.inc
function validateName($field_list, $field_name)
{
    if (!isset($field_list[$field_name]))
        return false;
    $pattern = "/^[a-zA-Z'-]+$/"; // format nama (alfabet)
    if (!preg_match($pattern, $field_list[$field_name]))
        return false;
    return true;
}
?>


<!-- Langkah 4-6 -->
<!-- File : processData_form.html -->
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Register</title>
<style>
body { font-family: Arial, sans-serif; }
.field { margin: 6px 0; }
.field label { display: inline-block; width: 120px; text-align: right; margin-right: 8px; }
</style>
</head>
<body>
<h1>Register</h1>
<!-- Form pendaftaran data pribadi -->
<fieldset>
<legend>Person Details</legend>
<form name="myForm" action="processData.php" method="POST">
<div class="field">
<label for="surname">Surname</label>
<input type="text" name="surname" size="31"/>
</div>
<div class="field">
<label for="email">Email address</label>
<input type="text" name="email" size="31"/>
</div>
<div class="field">
<label for="passwd">Password</label>
<input type="password" name="passwd" size="31"/>
</div>
<div class="field">
<label for="address">Street Address</label>
<textarea name="address" rows="3" cols="22"></textarea>
</div>
<div class="field">
<label for="state">State</label>
<select name="state">
<option value="-1" selected>[choose your state]</option>
<option value="1">Australian Capital Territory</option>
<option value="2">Queensland</option>
<option value="3">Victoria</option>
<option value="4">New South Wales</option>
<option value="5">Tasmania</option>
<option value="6">South Australia</option>
<option value="7">Western Australia</option>
<option value="8">Northern Territory</option>
</select>
</div>
<div class="field">
<input type="hidden" name="country" value="Australia"/>
</div>
<div class="field">
<label for="sex">Gender</label>
<input type="radio" name="sex" value="male"/>Male
<input type="radio" name="sex" value="female"/>Female
</div>
<div class="field">
<label for="vegetarian">Vegetarian?</label>
<input type="checkbox" name="vegetarian"/>
</div>
<div class="field">
<label>&nbsp;</label>
<input type="submit" value="Submit" name="submit"/><input type="reset" value="Reset" name="reset"/>
</div>
</form>
</fieldset>
</body>
</html>


<?php
//File : processData.php
require 'validate.inc';
$errors = array();
validateName($errors, $_POST, 'surname');
if ($errors)
{
    echo 'Errors:<br/>';
    foreach ($errors as $field => $error)
        echo "$field $error</br>";
}
else
    echo 'Data OK!';
?>


<?php
//File : Validate.inc
function validateName(&$errors, $field_list, $field_name)
{
    $pattern = "/^[a-zA-Z'-]+$/"; // format surname (alfabet)
    if (!isset($field_list[$field_name]) || empty($field_list[$field_name]))
        $errors[$field_name] = 'required';
    else if (!preg_match($pattern, $field_list[$field_name]))
        $errors[$field_name] = 'invalid';
}
?>




<!-- 4.3.2 -->
<!-- Langkah 1-6 -->
<!-- File : process_Data_form.php -->
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Register</title>
<style>
body { font-family: Arial, sans-serif; }
.field { margin: 6px 0; }
.field label { display: inline-block; width: 120px; text-align: right; margin-right: 8px; }
</style>
</head>
<body>
<h1>Register</h1>
<?php
$errors = array();
if (isset($_POST['surname']))
{
    require 'validate.inc';
    validateName($errors, $_POST, 'surname');
    if ($errors)
    {
        echo '<h1>Invalid, correct the following errors:</h1>';
        foreach ($errors as $field => $error)
            echo "$field $error</br>";
        // tampilkan kembali form (kosong)
        include 'form.inc';
    }
    else {
        echo 'Form submitted successfully with no errors';
    }
}
else
    // tampilkan form kosong
    include 'form.inc';
?>
</body>
</html>


<!-- File : form.inc -->
<fieldset>
<legend>Person Details</legend>
<form name="myForm" action="processData_form.php" method="POST">
<div class="field">
<label for="surname">Surname</label>
<input type="text" name="surname" size="31"/>
</div>
<div class="field">
<label for="email">Email address</label>
<input type="text" name="email" size="31"/>
</div>
<div class="field">
<label for="passwd">Password</label>
<input type="password" name="passwd" size="31"/>
</div>
<div class="field">
<label for="address">Street Address</label>
<textarea name="address" rows="3" cols="22"></textarea>
</div>
<div class="field">
<label for="state">State</label>
<select name="state">
<option value="-1" selected>[choose your state]</option>
<option value="1">Australian Capital Territory</option>
<option value="2">Queensland</option>
<option value="3">Victoria</option>
<option value="4">New South Wales</option>
<option value="5">Tasmania</option>
<option value="6">South Australia</option>
<option value="7">Western Australia</option>
<option value="8">Northern Territory</option>
</select>
</div>
<div class="field">
<input type="hidden" name="country" value="Australia"/>
</div>
<div class="field">
<label for="sex">Gender</label>
<input type="radio" name="sex" value="male"/>Male
<input type="radio" name="sex" value="female"/>Female
</div>
<div class="field">
<label for="vegetarian">Vegetarian?</label>
<input type="checkbox" name="vegetarian"/>
</div>
<div class="field">
<label>&nbsp;</label>
<input type="submit" value="Submit" name="submit"/><input type="reset" value="Reset" name="reset"/>
</div>
</form>
</fieldset>


<?php
//File : Validate.inc
function validateName(&$errors, $field_list, $field_name)
{
    $pattern = "/^[a-zA-Z'-]+$/"; // format surname (alfabet)
    if (!isset($field_list[$field_name]) || empty($field_list[$field_name]))
        $errors[$field_name] = 'required';
    else if (!preg_match($pattern, $field_list[$field_name]))
        $errors[$field_name] = 'invalid';
}
?>


<!-- Langkah 7-9 -->
<!-- File : process_Data_form.php -->
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Register</title>
<style>
body { font-family: Arial, sans-serif; }
.field { margin: 6px 0; }
.field label { display: inline-block; width: 120px; text-align: right; margin-right: 8px; }
.error { color: #c00; font-size: 90%; margin-left: 6px; }
</style>
</head>
<body>
<h1>Register</h1>
<?php
$errors = array();
if (isset($_POST['surname']))
{
    require 'validate.inc';
    validateName($errors, $_POST, 'surname');
    validateEmail($errors, $_POST, 'email');
    validatePassword($errors, $_POST, 'passwd');
    validateAddress($errors, $_POST, 'address');
    validateState($errors, $_POST, 'state');
    validateGender($errors, $_POST, 'sex');
    if ($errors)
    {
        echo '<h2>Invalid, correct the following errors:</h2>';
        foreach ($errors as $field => $error)
            echo htmlspecialchars("$field $error") . "<br/>";
        // tampilkan kembali form dengan isian data sebelumnya
        include 'form.inc';
    }
    else {
        echo 'Form submitted successfully with no errors';
    }
}
else
    // tampilkan form kosong
    include 'form.inc';
?>
</body>
</html>


<!-- File : form.inc -->
<?php
// Nilai lama (sticky form) + pesan error per field
$v = function ($k) { return isset($_POST[$k]) ? htmlspecialchars($_POST[$k]) : ''; };
$e = function ($k) use ($errors) {
    return isset($errors[$k]) ? '<span class="error">' . htmlspecialchars($errors[$k]) . '</span>' : '';
};
?>
<fieldset>
<legend>Person Details</legend>
<form name="myForm" action="processData_form.php" method="POST">
<div class="field">
<label for="surname">Surname</label>
<input type="text" name="surname" size="31" value="<?php echo $v('surname'); ?>"/>
<?php echo $e('surname'); ?>
</div>
<div class="field">
<label for="email">Email address</label>
<input type="text" name="email" size="31" value="<?php echo $v('email'); ?>"/>
<?php echo $e('email'); ?>
</div>
<div class="field">
<label for="passwd">Password</label>
<input type="password" name="passwd" size="31"/>
<?php echo $e('passwd'); ?>
</div>
<div class="field">
<label for="address">Street Address</label>
<textarea name="address" rows="3" cols="22"><?php echo $v('address'); ?></textarea>
<?php echo $e('address'); ?>
</div>
<div class="field">
<label for="state">State</label>
<select name="state">
<?php
$states = array(
    '-1' => '[choose your state]',
    '1' => 'Australian Capital Territory',
    '2' => 'Queensland',
    '3' => 'Victoria',
    '4' => 'New South Wales',
    '5' => 'Tasmania',
    '6' => 'South Australia',
    '7' => 'Western Australia',
    '8' => 'Northern Territory'
);
$selected = isset($_POST['state']) ? $_POST['state'] : '-1';
foreach ($states as $val => $label) {
    $sel = ((string)$val === (string)$selected) ? ' selected' : '';
    echo "<option value=\"$val\"$sel>$label</option>\n";
}
?>
</select>
<?php echo $e('state'); ?>
</div>
<div class="field">
<input type="hidden" name="country" value="Australia"/>
</div>
<div class="field">
<label for="sex">Gender</label>
<input type="radio" name="sex" value="male" <?php if (isset($_POST['sex']) && $_POST['sex'] === 'male') echo 'checked'; ?>/>Male
<input type="radio" name="sex" value="female" <?php if (isset($_POST['sex']) && $_POST['sex'] === 'female') echo 'checked'; ?>/>Female
<?php echo $e('sex'); ?>
</div>
<div class="field">
<label for="vegetarian">Vegetarian?</label>
<input type="checkbox" name="vegetarian" <?php if (isset($_POST['vegetarian'])) echo 'checked'; ?>/>
</div>
<div class="field">
<label>&nbsp;</label>
<input type="submit" value="Submit" name="submit"/><input type="reset" value="Reset" name="reset"/>
</div>
</form>
</fieldset>

  
 <?php
//File : Validate.inc
// Semua fungsi menyimpan pesan error ke array $errors (by reference)
function validateName(&$errors, $field_list, $field_name)
{
    $pattern = "/^[a-zA-Z'-]+$/"; // format surname (alfabet)
    if (!isset($field_list[$field_name]) || empty($field_list[$field_name]))
        $errors[$field_name] = 'required';
    else if (!preg_match($pattern, $field_list[$field_name]))
        $errors[$field_name] = 'invalid (hanya huruf, apostrof, dan tanda minus)';
}

function validateEmail(&$errors, $field_list, $field_name)
{
    if (!isset($field_list[$field_name]) || trim($field_list[$field_name]) === '')
        $errors[$field_name] = 'required';
    else if (!filter_var($field_list[$field_name], FILTER_VALIDATE_EMAIL))
        $errors[$field_name] = 'invalid (format email salah)';
}

function validatePassword(&$errors, $field_list, $field_name)
{
    if (!isset($field_list[$field_name]) || $field_list[$field_name] === '')
        $errors[$field_name] = 'required';
    else if (strlen($field_list[$field_name]) < 6)
        $errors[$field_name] = 'invalid (minimal 6 karakter)';
}

function validateAddress(&$errors, $field_list, $field_name)
{
    if (!isset($field_list[$field_name]) || trim($field_list[$field_name]) === '')
        $errors[$field_name] = 'required';
}

function validateState(&$errors, $field_list, $field_name)
{
    if (!isset($field_list[$field_name]) || $field_list[$field_name] === '-1')
        $errors[$field_name] = 'required (pilih salah satu state)';
    else if (!preg_match('/^[1-8]$/', $field_list[$field_name]))
        $errors[$field_name] = 'invalid';
}

function validateGender(&$errors, $field_list, $field_name)
{
    if (!isset($field_list[$field_name]))
        $errors[$field_name] = 'required';
    else if ($field_list[$field_name] !== 'male' && $field_list[$field_name] !== 'female')
        $errors[$field_name] = 'invalid';
}
?>
