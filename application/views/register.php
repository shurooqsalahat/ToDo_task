<!DOCTYPE html>
<html lang="en">
<head>
    <title>To Do
    </title>
    <?php include('header.php') ?>
</head>
<body>
<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100 p-t-85 p-b-20">
            <form class="login100-form validate-form" method="post" action="<?php echo base_url(); ?>user/register">
            <span class="login100-form-title p-b-70">
              Register 
            </span>
                <?php
                if ($this->session->userdata('register_error')) {
                    ?>
                    <div class="alert alert-danger">
                        <?php echo $register_error;
                        $this->session->unset_userdata('register_error');
                        ?>
                    </div>
                    <?php
                }
                ?>
                <div class="wrap-input100 validate-input m-t-85 m-b-35" data-validate="Enter username">
                    <input class="input100" type="text" name="username">
                    <span class="focus-input100" data-placeholder="Full_name">
              </span>
                </div>
                <?php
                if (form_error('username')) {
                    echo '<div class="alert alert-danger wrap-input100  ">' . form_error('username') . '</div>';
                }
                ?>
                <div class="wrap-input100 validate-input m-t-85 m-b-35" data-validate="Enter email">
                    <input class="input100" type="email" name="email">
                    <span class="focus-input100" data-placeholder="email">
              </span>
                </div>
                <?php
                if (form_error('email')) {
                    echo ' <div class="alert alert-danger wrap-input100  ">' . form_error('email') . '</div>';
                }
                ?>
                <div class="wrap-input100 validate-input m-t-85 m-b-35" data-validate="Enter age">
                    <input class="input100" type="number" name="age">
                    <span class="focus-input100" data-placeholder="age">
              </span>
                </div>
                <?php
                if (form_error('age')) {
                    echo ' <div class="alert alert-danger wrap-input100  ">' . form_error('age') . '</div>';

                }
                ?>
                <div class="wrap-input100 validate-input m-t-85 m-b-35" data-validate="Enter city">
                    <input class="input100" type="text" name="city">
                    <span class="focus-input100" data-placeholder="city">
              </span>
                </div>
                <?php
                if (form_error('city')) {
                    echo ' <div class="alert alert-danger wrap-input100  ">' . form_error('city') . '</div>';
                }
                ?>
                <div class="wrap-input100 validate-input m-b-50" data-validate="Enter password">
                    <input class="input100" type="password" name="password">
                    <span class="focus-input100" data-placeholder="Password">
              </span>
                </div>
                <?php
                if (form_error('password')) {
                    echo ' <div class="alert alert-danger wrap-input100  ">' . form_error('password') . '</div>';
                }
                ?>
                <div class="container-login100-form-btn">
                    <input type="submit" value="Register" class="login100-form-btn">
                </div>
                <ul class="login-more p-t-190">
                    <li class="m-b-8">
                <span class="txt1">
                  Forgot
                </span>
                        <a href="#" class="txt2">
                            Username / Password?
                        </a>
                    </li>
                    <li>
                <span class="txt1">
                  Already have an account?
                </span>
                        <a href="<?php echo base_url(); ?>user/loadLogin " class="txt2">
                            Sign in
                        </a>
                    </li>
                </ul>
            </form>
        </div>
    </div>
</div>
<div id="dropDownSelect1">
</div>
<?php include('footer.php') ?>
</body>
</html>
​

