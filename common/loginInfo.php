
<?php
//var_dump($_SESSION);
?>
<div class="text-center" id="accountInfo">
        <div id="loggedInName">
            <?php if($_SESSION['loggedin'] == TRUE) {

            echo ('<h4>Welcome ' . $_SESSION['clientData']['email'] . "</h4>");  
            } else {
                echo ("<h4>Please login to continue</h4>");
            }
            ?>
                    
            <?php
                if ($_SESSION['loggedin'] == TRUE) {
                    echo ('<a class="btn btn-primary" href="' . urlPath('index.php?action=logout') . '">Log Out</a>');
                } else {
                    echo('<a class="btn btn-primary" href="' . urlPath('index.php') . '">Login To My Account</a>');
                }
                // Instead show the login form, not the links

            ?>
    </div>
</div>