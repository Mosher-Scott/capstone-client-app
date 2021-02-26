<div id="formDiv">

    <h2 class="text-center">Please Log In To Continue</h2>

    <?php
        if(isset($message)) {
            echo $message;
        }
    ?>

    <form method="post">
        <label for="userEmail">Email:</label>
        <input type="text" placeholder=" Enter Email" id="userEmail" name="userEmail" <?php if(isset($clientEmail)){echo "value='$clientEmail'";}  ?>required>
        <br>
        <label for="userPassword">Password:  </label>
        <input type="password" placeholder=" Enter Password" id="userPassword" name="userPassword">
        <p>Passwords must be a minimum of 8 characters, and contain at least 1 of the following: Number, Capital letter, special character</p>
        <!-- Removing password requirements for now
                <input type="password2" placeholder=" Enter Password" id="password" name="password" required pattern=(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$>
        -->
        
        <input type="hidden" name="pageType" value="signInRequest">
        <br>
        <!-- Todo: Create this method -->
        <p>Forgot password? <a href="">Send Reset Email</a>
        <br>
        <input type="submit" class="submitButton btn btn-primary"  value="Sign In">
    </form>
</div>