<?php session_start(); ?>
<!doctype html>
    <html lang="en">
<head>
    <meta content="text/html; charset=utf-8" http-equiv="content-type">
    <title><?php echo $page_title; ?></title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">

    <!-- Font Awesome Css -->
    <link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.no-icons.min.css" rel="stylesheet">
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

</head>

<body>
<header>
    <nav class="navbar navbar-default">
        <a href="#" title="Drawing the Chain" class="navbar-brand">Drawing the Chain</a>
        <ul class="nav navbar-nav navbar-right">

            <li><a href="../imgupload/upload.php">Upload Art</a></li>
            <li><a href="../imgupload/drawings.php">Image Archive</a></li>

            </ul>
    </nav>
</header>
<main class="container">