<div id="login">
        <div id="loggedInName">
            <?php if($isLoggedIn == 'Yes') {
            // echo ("<h4><span>Welcome " . $clientData['clientFirstname'] . "</span></h4>"); 
            echo ('<h4><a href="' . urlPath('/controller/index.php?action=userAlreadyLoggedIn') . '">Welcome ' . $_SESSION['clientData']['clientFirstname'] . "</a></h4>");  
            }
            ?>
        </div>
                    
        <?php
            if ($_SESSION['loggedin'] == TRUE) {
                echo ('<a class="btn btn-sm" href="' . urlPath('/controller/index.php?action=logout') . '">logOut</a>');
            } else {
                echo('<a class="btn btn-primary" href="' . urlPath('/controller/index.php?action=login') . '">Login To My Account</a>');
            }
        ?>
</div>

<div id="formDiv">

<h2>Log In</h2>

<?php
    if(isset($message)) {
        echo $message;
    }
?>

<form action="<?php echo urlPath('accounts/index.php'); ?>" method="post">
    <label for="userEmail">Email:</label>
    <input type="text" placeholder=" Enter Email" id="userEmail" name="userEmail" <?php if(isset($clientEmail)){echo "value='$clientEmail'";}  ?>required>
    <br>
    <label for="password">Password:  </label>
    <span>Passwords must be a minimum of 8 characters, and contain at least 1 of the following: Number, Capital letter, special character</span><br>
    <input type="password" placeholder=" Enter Password" id="password" name="password" required pattern=(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$>
    <input type="hidden" name="pageType" value="signInRequest">

    <p>Forgot password? <a href="">Send Reset Email</a>
    <br>
    <input type="submit" class="submitButton" value="Sign In">
</form>
</div>