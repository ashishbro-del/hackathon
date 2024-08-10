<?php 
include('process/db_config.php'); 
?>
<?php 
session_start();
unset($_SESSION["id"]);
session_destroy();


?>

<!DOCTYPE html>
<html>
<head>
    <title>Blood Bank</title>


 <meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

 <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>





<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://code.getmdl.io/1.1.3/material.indigo-pink.min.css">
<script defer src="https://code.getmdl.io/1.1.3/material.min.js"></script>

<link rel="stylesheet" type="text/css" href="style.css">

<style>
    
body {
    font-family: 'Roboto', sans-serif;
    background-color: #f9f9f9;
    margin: 0;
    padding: 0;
    color: #333;
}


.mdl-layout__header {
    background-color: #d32f2f; 
    color: #fff;
}

.mdl-layout-title {
    font-weight: bold;
    font-size: 1.5em;
}

.mdl-navigation__link {
    color: #fff;
    text-transform: uppercase;
    font-weight: 500;
    letter-spacing: 1px;
    transition: background-color 0.3s ease;
}

.mdl-navigation__link:hover {
    background-color: #b71c1c; 
}


.mdl-layout__drawer {
    background-color: #f5f5f5;
    color: #d32f2f;
}

.mdl-navigation__link {
    color: #d32f2f;
}

.mdl-navigation__link:hover {
    background-color: blue;
}


.mdl-layout__content {
    padding: 20px;
    min-height: calc(100vh - 64px); 
    display: flex;
    justify-content: center;
    align-items: center;
}

.page-content {
    width: 100%;
    max-width: 600px;
    margin: 0 auto;
}


.panel-danger {
    border-color: #d32f2f;
    background-color: #ffebee; 
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.panel-body {
    color: #d32f2f;
    font-size: 1.25em;
    text-align: center;
    padding: 20px;
    font-weight: bold;
}


@media (max-width: 768px) {
    .mdl-layout__header,
    .mdl-layout__drawer {
        text-align: center;
    }
    
    .mdl-layout-title {
        font-size: 1.25em;
    }
    
    .panel-body {
        font-size: 1.1em;
        padding: 15px;
    }
}

</style>
</head>
<body>



<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
  <header class="mdl-layout__header">
    <div class="mdl-layout__header-row">
      
      <span class="mdl-layout-title">Blood Bank</span>
      
      <div class="mdl-layout-spacer"></div>

      <nav class="mdl-navigation mdl-layout--large-screen-only">
        <a class="mdl-navigation__link" href="process/login.php">Login</a>
        <a class="mdl-navigation__link" href="process/donate.php">Donate</a>
       
      </nav>
    </div>
  </header>
  <div class="mdl-layout__drawer">
    <span class="mdl-layout-title">Blood Bank</span>
    <nav class="mdl-navigation">
      <a class="mdl-navigation__link" href="process/login.php">Login</a>
      <a class="mdl-navigation__link" href="process/donate.php">Donate</a>
       <a class="mdl-navigation__link" href="index.html">Home</a>
    </nav>
  </div>
  <main class="mdl-layout__content">
  <div class="page-content">
<div id="lo" class="panel panel-danger">
     <div class="panel-body">
    You have been logged out!!!
  </div>
</div>


</div>
</main>
</div>
</div>
</div>
</body>
</html>