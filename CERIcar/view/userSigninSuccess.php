<?php if(!isset($_SESSION['authUser'])): ?>
<div id="SigninSection">
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <div class="login100-form-title" style="background-image: url(images/bg-01.jpg);">
                        <span class="login100-form-title-1">
                            Sign In
                        </span>
                </div>

                <form id="formLogin" class="login100-form validate-form" method="post">
                    <div class="wrap-input100 validate-input m-b-26" data-validate="First name is required">
                        <span class="label-input100">First name</span>
                        <input class="input100" type="text" name="firstName" id="inputFirstName" placeholder="Enter first name">
                        <span class="focus-input100"></span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-26" data-validate="Last name is required">
                        <span class="label-input100">Last name</span>
                        <input class="input100" type="text" name="lastName" id="inputLastName" placeholder="Enter last name">
                        <span class="focus-input100"></span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-26" data-validate="Date of birth is required">
                        <span class="label-input100">Date of birth</span>
                        <input class="input100" type="date" name="dateOfBirth" id="inputDateOfBirth" placeholder="Enter date of birth">
                        <span class="focus-input100"></span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
                        <span class="label-input100">Username</span>
                        <input class="input100" type="text" name="username" id="inputUserName" placeholder="Enter username">
                        <span class="focus-input100"></span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-26" data-validate = "Password is required">
                        <span class="label-input100">Password</span>
                        <input class="input100" type="password" name="password" id="inputPassword" placeholder="Enter password">
                        <span class="focus-input100"></span>
                    </div>

                    <div class="container-login100-form-btn">
                        <input name="submit" type="button" id="btnSubmit" class="login100-form-btn" value="Sign in"/>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>