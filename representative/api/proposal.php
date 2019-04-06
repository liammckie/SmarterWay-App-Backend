<?php
// Saving data from form in text file in JSON format
// From: https://coursesweb.net/php-mysql/

// check if all form data are submited, else output error message
    $category = array(
      'Category'=> $_POST['Category'],
      );
    $subCategories = array(
      'SubCategories' => $_POST['SubCategories'],
      'status' => $_POST['status']
    );
    
    /*$formdata['Category'] = []; 
    foreach($subCategories as $subCategorie){ 
        array_push($formdata['Category'], $subCategorie); 
    }*/
    // adds form data into an array
    $formdata = array(
      'ClientName'=> $_POST['ClientName'],
      'ClientPhone'=> $_POST['ClientPhone'],
      'ClientEmail'=> $_POST['ClientEmail'],
      'ClientAddress'=> $_POST['ClientAddress'],
      'ClientSuburb'=> $_POST['ClientSuburb'],
      'StateFull'=> $_POST['StateFull'],
      'PostCode'=> $_POST['PostCode']
    );
    //$category['SuperSubCategories'] = [];
    $formdata['Category'] = [];
    //array_push($category['SuperSubCategories'], $subCategories);
    array_push($formdata['Category'], $subCategories);
    // encodes the array into a string in JSON format (JSON_PRETTY_PRINT - uses whitespace in json-string, for human readable)
    $jsondata = json_encode($formdata, JSON_PRETTY_PRINT);

    // saves the json string in "formdata.txt" (in "dirdata" folder)
    // outputs error message if data cannot be saved
    echo $jsondata;

?>

<!DOCTYPE html>
<?php /*
setcookie("test_cookie", "test", time() + 3600, '/');
?>
<?php
$cookie_name = "User";
//echo $user = $_POST['ClientName'];
$cookie_value = "Akash";
setcookie('User', $cookie_value, time() + (86400 * 30), "/");
?>

<html>
<body>

<?php

if(count($_COOKIE) > 0) {
    echo "Cookies are enabled.";
    echo $_COOKIE['test_cookie'];
} else {
    echo "Cookies are disabled.";
}
?>



<?php
echo $_COOKIE['User'];
if(!isset($_COOKIE[$cookie_name])) {
    echo "Cookie named '" . $cookie_name . "' is not set!";
} else {
    echo "Cookie '" . $cookie_name . "' is set!<br>";
    echo "Value is: " . $_COOKIE[$cookie_name];
}
print_r($_COOKIE);
?>

</body>
</html>