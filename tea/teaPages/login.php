<?php $t_page="login"; include 'teaScripts/t_header.php'; ?>
<!-- MAIN -->
  <div id="loginBox"> 
    <?php 
    if ($_POST[checksubmit]==1) {
      include 'teaScripts/t_dbConnect.php';
      $result = mysqli_query($con,"SELECT * FROM users WHERE user='".$_POST[user]."'");
      $success = 0;
      if (mysqli_num_rows($result)>0) {
        while($row = mysqli_fetch_array($result)) {
          if (md5($_POST[pass])==$row[pass]) {
            $success = 1;
            session_start();
            $_SESSION["loggedIn"]=1;
            $_SESSION["loggedUser"]=$row[user]; 
            header( 'Location: manage.php');
          }
        }
      }
      if ($success == 0) {
          echo '<div id="loginMessage">
                  Details are incorrect. Please try again.
                </div>';              
      }
    }

    if ($_GET[denied]==1) {
      echo '<div id="loginMessage">
              You need to log in to access that page.
            </div>';        
    }
    ?>
    <table>
      <form name="login_form" method="post" action="login.php">
      <tr>
        <td>Username: </td>
        <td><input name="user" type="text" id="user"></td>        
      </tr>
      <tr>
        <td>Password: </td>
        <td><input name="pass" type="password" id="user"></td>
      </tr>
      <tr>
        <td></td>
        <td><input type="hidden" name="checksubmit" id="checksubmit" value="1"><input type="submit" name="submit" value="Login"></td>
      </tr>      
    </table>
    <div id="loginReturn">
      <a href="index.php">Back to site</a>
    </div>
  </div>

<!-- /MAIN -->
<?php include 'teaScripts/t_footer.php'; ?>
