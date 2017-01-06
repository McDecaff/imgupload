<?php

$page_title = "Uploading Image";
require_once("header.php");

?>


<?php
//Variables storing form data
$pic=$_FILES["imageUpload"]["name"];
$author=$_POST['author'];
$title=$_POST['title'];
$medium=$_POST['medium'];
$description=$_POST['description'];
$mail = $_POST["email"];
$date = date('Y-m-d H:i:s');

//Checks for whether the data can be properly processed
$ok = true;
//Variables for halding saving images
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["imageUpload"]["name"]);
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

//Form validation before saving
if(empty($author)){
    echo 'Author is required<br /> ';
    $ok = false;
}
if(empty($title)){
    echo 'Title is required<br /> ';
    $ok = false;
}
//Checks whether file is actually an image
$check = getimagesize($_FILES["imageUpload"]["tmp_name"]);
    if($check !== false) {
    } else {
        echo "File is not an image.";
        $ok=false;
    }

// Check if a file with the same name already exists on the server
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $ok=false;
}
// Check file size and cancels upload if too large
if ($_FILES["imageUpload"]["size"] > 1000000) {
    echo "Sorry, your file is too large.";
    $ok=false;
}
//Only allow jpg, gif, or png
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
    echo "Invalid file extension. Only .jpg, .png, and .gif images are allowed.";
    $ok=false;
}


//save only if the form is complete and valid
if($ok) {

//connect to the database
    $conn = new PDO('mysql:host=sql.computerstudi.es;dbname=gc200321780', 'gc200321780', 'Aqwx2BAW');

//SQL command for saving image info
    $sql = "INSERT INTO pictures(imageName, authorName, imageMedium, userDesc, imageTitle, uploaded) VALUES (:image, :author, :medium, :desc, :title, :datetime)";

//set up a command object
    $cmd = $conn->prepare($sql);
//placeholder variables
    $cmd->bindParam(':image', $pic, PDO::PARAM_STR, 50);
    $cmd->bindParam(':author', $author, PDO::PARAM_STR, 50);
    $cmd->bindParam(':medium', $medium, PDO::PARAM_STR, 50);
    $cmd->bindParam(':desc', $description, PDO::PARAM_STR, 50);
    $cmd->bindParam(':title', $title, PDO::PARAM_STR, 25);
    $cmd->bindParam(':datetime', $date);

//execute the insert
    $cmd->execute();

//Inform the user whether or not their file could be successfully uploaded
    if (move_uploaded_file($_FILES["imageUpload"]["tmp_name"], $target_file)) {
        //Check if the Email address is valid
        if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            echo "Your image was uploaded but your email address was invalid and so we couldn't send you a confirmation.";

        }else {
            echo "Your image was uploaded and a confirmation email was sent to your address.";
            mail($mail, 'Image Upload Confirmation', 'Your Image titled '.$title.' was successfully uploaded to the server!');
        }
    } else {
        echo "Sorry, there was an error uploading your file.";
    }

//disconnect
    $conn = null;
}
?>

<?php require_once("footer.php"); ?>