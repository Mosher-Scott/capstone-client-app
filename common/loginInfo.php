<div class="text-center" id="accountInfo">
        <div id="loggedInName">
            <?php if($isLoggedIn == 'Yes') {
            // echo ("<h4><span>Welcome " . $clientData['clientFirstname'] . "</span></h4>"); 
            echo ('<h4><a href="' . urlPath('/controller/index.php?action=userAlreadyLoggedIn') . '">Welcome ' . $_SESSION['clientData']['clientFirstname'] . "</a></h4>");  
            } else {
                echo ("<h4>Please login to continue</h4>");
            }
            ?>
        </div>
                    
        <?php
            if ($_SESSION['loggedin'] == TRUE) {
                echo ('<a class="btn btn-sm" href="' . urlPath('/controller/index.php?action=logout') . '">logOut</a>');
            } else {
                echo('<a class="btn btn-primary" href="' . urlPath('/controller/index.php?action=login') . '">Login To My Account</a>');
            }
            // Instead show the login form, not the links
        ?>
    </div>
</div>