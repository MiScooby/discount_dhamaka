<?php  include('admin/ajax/config.php')?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
print_r($_POST['code']);
echo "<br>";
echo "<br>";
$plantok = '1234567890';
$plantoktoken = substr(str_shuffle($plantok), 0, 6);    
echo $orderId = "DD" . $plantoktoken;

echo "<br>";
echo "<br>";

print_r($_POST['code'].' - ');
print_r($_POST['transactionId']);
print_r($_POST['providerReferenceId'].' - ');
echo "<br>";
echo "<br>";
print_r($_POST);
    ?>
</body>
</html>