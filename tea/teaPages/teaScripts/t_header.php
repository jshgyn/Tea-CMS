<?php
session_start();
if ($_SESSION['loggedIn']!=1 && $t_page!="login")
{
  header( 'Location: login.php?denied=1');
}
?>

<!doctype html>
<html lang="en">
<head>
  
  <meta charset="utf-8" />
  <title>
  <?php 
    include 't_dbConnect.php';
    $result = mysqli_query($con,"SELECT * FROM info");
    while($row = mysqli_fetch_array($result)) {
        $siteName = $row[sitename];
    }
    echo $siteName." | Tea";
    mysqli_close($con);
  ?>
  </title>
  
  <!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
  
  <!-- <link rel="stylesheet" href="fonts/neou.css"> -->
  <link rel="stylesheet" href="./teaCSS/main.css"/>
  <link href='http://fonts.googleapis.com/css?family=Raleway:200' rel='stylesheet' type='text/css'>

  <?php
    if ($t_page=="login")
    {
      return;
    }
    if ($t_page=="upload")
    {
      echo "<link rel='stylesheet' href='./teaCSS/dropzone.css'></script>";
      echo "<script src='./teaJS/dropzone.js'></script>";
    }
    if ($t_page=="manage")
    {
      echo "<script src='./teaJS/jquery-1.7.1.min.js'></script>";
      echo "<script src='./teaJS/jquery.jeditable.js'></script>";
      echo "<script src='./teaJS/jeditable-save.js'></script>";
    }
    if ($t_page=="category")
    {
      echo "<script src='./teaJS/jquery-1.7.1.min.js'></script>";
      echo "<script src='./teaJS/jquery.jeditable.js'></script>";
      echo "<script src='./teaJS/jeditable-save.js'></script>";
    }
    if ($t_page=="thumbnail")
    {
      echo "<link rel='stylesheet' href='./teaCSS/imgareaselect-default.css' />";
      echo "<script src='./teaJS/jquery-1.7.1.min.js'></script>";
      echo "<script src='./teaJS/jquery.imgareaselect.pack.js'></script>";
      // echo "<script src='./teaJS/crop.js'></script>";
    }    
  ?>


</head>
<body class="homepage">

 <div id="headline">
    <div class="title">
      <h1>
        <div class="titletext">
        <?php 
          echo $siteName;
        ?>
        </div>
      </h1>

    </div>
    <!-- <div id="logo">LOGO</div> -->
    <?php include 'teaScripts/t_menu.php' ?>
 </div>
 <div id="content">