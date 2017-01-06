<?php

$page_title = "Gallery";
require_once("header.php");

?>

<br />
<h1>Drawings</h1>
<br />
<?php
//Connect
$conn = new PDO('mysql:host=sql.computerstudi.es;dbname=gc200321780', 'gc200321780', 'Aqwx2BAW');
$conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//SQL for getting image data by order of newest to oldest
$sql = "SELECT * FROM pictures ORDER BY uploaded DESC";

//run the query and store the results into memory
$cmd = $conn->prepare($sql);
$cmd -> execute();
$drawings = $cmd->fetchAll();

//Loop through the data, creating a figure to display each image with the appropriate information
foreach($drawings as $drawing) {

    echo
        '<hr>
        <h2>'.$drawing['imageTitle'].' by '.$drawing['authorName'].'</h2>
        <small>Uploaded '.$drawing['uploaded'].'</small>
        <br />
        <figure>
            <a href="uploads/'.$drawing[imageName].'">
                <img src="uploads/'.$drawing['imageName'].'" alt="'.$drawing['imageTitle'].'"  width="250">
            </a>
            <figcaption>'.$drawing['userDesc'].'</figcaption>
        </figure>
        <br />';
}

//disconnect
$conn=null;
?>
<?php require_once("footer.php"); ?>