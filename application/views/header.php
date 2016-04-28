<!-- written by jamesr -->

<!DOCTYPE html>
<html lang="en">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>City of Kelowna Road Mapper</title>
  <!-- Bootstrap fonts -->
  <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <!-- our external style sheet -->
  <link rel="stylesheet" href="css/stylesheet.css">
  <!-- header javascript functions -->
  <script src="js/headerFunc.js"></script>
  <!-- google maps -->
  <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB9iQXncNMthIbjKA6RMqRlLcNXyI1z7r4"></script>
  <!-- Include jQuery -->
  <script src="http://code.jquery.com/jquery-2.1.1.min.js"></script>
  <!-- Include jBox -->
  <link href="http://code.jboxcdn.com/0.3.2/jBox.css" rel="stylesheet">
  <script src="http://code.jboxcdn.com/0.3.2/jBox.min.js"></script>
  <!-- Bootstrap JS -->
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <!-- js functions for handling the list (button) queries -->
  <script src="js/listFunc.js"></script>
  <!-- js for handling fullscreen mode -->
  <script src="js/fullScreenMaps.js" type="text/javascript"></script>
</head>

<header>
  <div class="headDiv clearfix">
    <h1 id="logo">
      <img id="imgLogo" src="images/logo.png"></img>
    </h1>
    <nav>
      <a href="http://www.kelowna.ca/">
        <button type="button" class="btn btn-default" style="background-color: #fdb813; border-color:#fdb813; color: white;" id="homeButton"><b>Home</b></button>
      </a>
      <a href="http://www.kelowna.ca/CM/Page67.aspx">
        <button type="button" class="btn btn-default" style="background-color: #fdb813; border-color:#fdb813; color: white;" id="aboutButton"><b>About</b></button>
      </a>
      <a href="http://www.kelowna.ca/CM/Page14.aspx">
        <button type="button" class="btn btn-default" style="background-color: #becc26; border-color:#becc26; color: white;" id="contactButton"><b>Contact Us&nbsp</b><span class="glyphicon glyphicon-earphone"></span></button>
      </a>

    </nav>
  </div>
</header>
