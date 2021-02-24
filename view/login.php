<div id="formDiv">

    <h2>Please Log In To Continue</h2>

    <?php
        if(isset($message)) {
            echo $message;
        }
    ?>

    <form action="" method="post">
        <label for="userEmail">Email:</label>
        <input type="text" placeholder=" Enter Email" id="userEmail" name="userEmail" <?php if(isset($clientEmail)){echo "value='$clientEmail'";}  ?>required>
        <br>
        <label for="password">Password:  </label>
        <span>Passwords must be a minimum of 8 characters, and contain at least 1 of the following: Number, Capital letter, special character</span><br>
        <!-- Removing password requirements for now
                <input type="password" placeholder=" Enter Password" id="password" name="password" required pattern=(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$>
        -->
        <input type="password" placeholder=" Enter Password" id="userPassword" name="userPassword">
        <input type="hidden" name="pageType" value="signInRequest">

        <p>Forgot password? <a href="">Send Reset Email</a>
        <br>
        <input type="submit" class="submitButton" value="Sign In">
    </form>
</div>