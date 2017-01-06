<?php

$page_title = "Submit Your Art";
require_once("header.php");

?>

<h1>Upload Your Art!</h1>

<!--Form for users to upload an image and fill out information about it-->
<form action="upload-action.php" method="post" enctype="multipart/form-data">
    <fieldset>
        <label for="imageUpload" class="col-sm-3">Image to Upload:</label>
        <input name="imageUpload" id="imageUpload" required type="file">
    </fieldset>
    <fieldset>
        <label for="author" class="col-sm-3">Author:</label>
        <input name="author" id="author" placeholder="Author ex: 'by ____'" required/>
    </fieldset>
    <fieldset>
        <label for="title" class="col-sm-3">Title:</label>
        <input name="title" id="title" placeholder="Title your Image'" required/>
    </fieldset>
    <fieldset>
        <label for="medium" class="col-sm-3">Medium:</label>



<?php
//code for filling dropdown box from table info

//establish connection to database
$conn = new PDO('mysql:host=sql.computerstudi.es;dbname=gc200321780', 'gc200321780', 'Aqwx2BAW');
$conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//SQL to get info from table
$sql="SELECT * FROM genres";

//run the query and store the results into memory
$cmd = $conn->prepare($sql);
$cmd -> execute();
$genres = $cmd->fetchAll();

echo "<select name='medium' value='medium'>Medium: </option>";

//Loop through the table and create a drop-down item for each row
foreach ($genres as $genre){

    echo "<option value=$genre[genre]>$genre[genre]</option>";
}

echo "</select>";
$conn=null;
?>

    </fieldset>
    <fieldset>
        <label for="description" class="col-sm-3">Description: </label>
        <input name="description" id="description" placeholder="Description..." required/>
    </fieldset>
    <fieldset>
        <label for="email" class="col-sm-3">Email Address (Optional): </label>
        <input name="email" id="email" placeholder="yourname@example.com"/>
    </fieldset>
    <button class="btn btn-primary col-sm-offset-3">Save</button>
</form>
<?php require_once("footer.php"); ?>