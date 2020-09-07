<?php

require_once 'db_pdo.php';
$_SESSION['user_connected'] = null;

        $Provinces = [
            ['id' => 0, 'code' => 'QC', 'name' => 'Québec'],
            ['id' => 1, 'code' => 'ON', 'name' => 'Ontario'],
            ['id' => 2, 'code' => 'NB', 'name' => 'New-Brunswick'],
            ['id' => 4, 'code' => 'NS', 'name' => 'Nova-Scotia'],
            ['id' => 5, 'code' => 'MN', 'name' => 'Manitoba'],
            ['id' => 6, 'code' => 'SK', 'name' => 'Saskatchewan'],
        ];
require_once 'tools.php';
class users
{
    public function LoginPageDisplay($error_msg = '', $prev_values = [])
    {
        echo $_SESSION['login_count'];
        if ($prev_values == []) {
            $prev_values['email'] = '';
            $prev_values['password'] = '';
        }
        $form_page = new Webpage();
        $form_page->title = 'Login Page: Please Login !!';
        $form_page->content = <<<HTML
         <form action="index.php?op=2" method="POST" style="margin:1vw">
        <!-- <input type="hidden" name ="op" value="2">used in case of GET method -->
        <div style="color:red">$error_msg</div>
        <input type="text" name="email" maxlength=126 size=25  placeholder="EMAIL" value="{$prev_values['email']}"><br><br>
        <input type="Password" name="password" maxlength=8  placeholder="Password (8 char)" value="{$prev_values['password']}"><br><br>
        <input type="submit" name="sumbit" value="Continue" class="btn btn-primary">
        HTML;
        $form_page->render();
    }

    public function LoginPageVerify()
    {
        // $users = [['id' => 0, 'email' => 'abc@test.com', 'password' => 12345678, 'name' => 'Jayesh Uttam', 'user_level' => 'employee'],
        // ['id' => 1, 'email' => 'abcd@test.com', 'password' => 12345678, 'name' => 'Khuspinder singh', 'user_level' => 'employee'],
        // ['id' => 2, 'email' => 'abce@test.com', 'password' => 12345678, 'name' => 'Harmanpreet singh', 'user_level' => 'customer'],
        // ['id' => 3, 'email' => 'abcf@test.com', 'password' => 12345678, 'name' => 'Rohan singh', 'user_level' => 'customer'], ];
        //
        $DB = new db_pdo();
        $users = $DB->querySelect('select * from users');

        $email_input = '';
        $password_input = '';

        //email validation
        $error_message = '';
        if (isset($_POST['email'])) {
            $email_input = $_POST['email'];
        } else {
            $error_message = 'Please Enter your email !!';
        }

        if (!filter_var($email_input, FILTER_VALIDATE_EMAIL)) {
            $error_message .= 'Email is not valid !!';
        }
        if (isset($_POST['password'])) {
            $password_input = $_POST['password'];
        } else {
            $error_message .= 'Please Enter the password !!';
            die();
            // header('location:index.php?op=1');
        }

        if (strlen($password_input) != 8) {
            $error_message .= ' Password must be 8 characters';
        }

        if ($error_message != '') {
            $this->LoginPageDisplay($error_message, $_POST);
        }
        $user_found = false;
        $name = '';
        foreach ($users as $one_user) {
            if ($one_user['email'] == $email_input and $one_user['password'] == $password_input) {
                $user_found = true;
                $_SESSION['user_connected'] = true;
                $_SESSION['user_email'] = $one_user['email'];
                $_SESSION['user_name'] = $one_user['name'];
                $_SESSION['user_id'] = $one_user['id'];
                $_SESSION['user_level'] = $one_user['user_level'];
                $name = $one_user['name'];
                break;
            }
        }
        if ($user_found == true) {
            echo $_SESSION['login_count'];
            $verify_page = new Webpage();
            $verify_page->title = 'Verify Page';
            $verify_page->content = '<h2>Welcome Back!!</h2> <br>
             <h3>Hello , You are Loged in-'.$name.'<br>'.$password_input.'</h3>';
            $verify_page->render();
        } else {
            if (isset($_SESSION['login_count'])) {
                $_SESSION['login_count'] = 1;
            } else {
                ++$_SESSION['login_count'];
            }
            if (isset($_SESSION['login_count']) < 3) {
                ++$_SESSION['login_count'];
                echo $_SESSION['login_count'];
                $verify_page = new Webpage();
                $verify_page->title = 'Verify Page';
                $verify_page->content = $this->LoginPageDisplay("'<p>User id not found!!!<br>
                        Login Again:</p>'");
                $verify_page->render();
            } else {
                $verify_page = new Webpage();
                $verify_page->title = 'You are blocked';
                $verify_page->content = 'You have reached the max login limit !! Please try agin later'.
                $verify_page->render();
            }
        }
    }

    // echo $email_input.'<br>'.$passwor_input.'<br>';

    public function CreateRegistrationForm($error_message = '', $prev_values = [])
    {
        $Provinces = [
            ['id' => 0, 'code' => 'QC', 'name' => 'Québec'],
            ['id' => 1, 'code' => 'ON', 'name' => 'Ontario'],
            ['id' => 2, 'code' => 'NB', 'name' => 'New-Brunswick'],
            ['id' => 4, 'code' => 'NS', 'name' => 'Nova-Scotia'],
            ['id' => 5, 'code' => 'MN', 'name' => 'Manitoba'],
            ['id' => 6, 'code' => 'SK', 'name' => 'Saskatchewan'],
        ];
        if ($prev_values == []) {
            $prev_values['email'] = '';
            $prev_values['password'] = '';
            $prev_values['fullName'] = '';
            $prev_values['address1'] = '';
            $prev_values['address2'] = '';
            $prev_values['city'] = '';
            $prev_values['Postalcode'] = '';
            $prev_values['password2'] = '';
        }
        $form_page = new Webpage();
        $form_page->title = 'Login Page: Please Login !!';
        $form_page->content = <<<HTML
    <h2>General Information</h2>
    <!-- //starting of  the form -->
    <form action="index.php?op=4" method="POST" style="margin:1vw;">
    <!-- <input type="hidden" name ="op" value="2">used in case of GET method -->
    <div style="color:red">$error_message</div>
    <input type="text" name="fullName" class="form-control" style="width: 300px;" maxlength="50"  size=25  placeholder="Firstname and lastname" value="{$prev_values['fullName']}"><br>'
    <label for="address1">Adress(Optional)</label>
    <input type="text" name="address1"  value="{$prev_values['address1']}" class="form-control" style="width: 300px;" maxlength="255" placeholder="Address Line 1" id="address1"><br>
    <input type="text" name="address2"  value="{$prev_values['address2']}" class="form-control " style="width: 300px;"  placeholder="Address Line 2" id="address2"><br>
    <label for="city">City(Optional)</label>
    <input type="text" name="city"  value="{$prev_values['city']}" class="form-control"  style="width: 300px;"maxlength="50"  id="city"><br>
    <label for="provinces">Province(Optional)</label><br>
    HTML;
        $form_page->content .= make_dropDown($Provinces, 'provinces');
        $form_page->content .= <<<HTML
    <br>
    <label for="Postalcode">Postal Code</label><br>
    <input type="text" name="Postalcode"  value="{$prev_values['Postalcode']}" maxlength="7"  class="form-control" style="width: 300px;"  id="Postalcode"><br>
    <input type=radio name="language" value="fr" >French<br>
    <input type=radio name="language" value="en">English<br>
    <input type=radio name="language" value="other">Other<input type=text name="other_lang" maxlength="25" ><br><br>
    <h2>Connection Info(Required)</h2>
    <input type="text" name="email"  value="{$prev_values['email']}" class="form-control" style="width: 300px;" required maxlength=126 size=25  placeholder="EMAIL" value="{$prev_values['email']}"><br> 
    <input type="Password" name="password"  value="{$prev_values['password']}" class="form-control " style="width: 300px;" required maxlength=8  placeholder="Password (8 char)" value="{$prev_values['password']}"><br>
    <input type="Password" name="password2"  value="{$prev_values['password2']}" class="form-control " style="width: 300px;" required maxlength=8  placeholder="Repeat Password " value="{$prev_values['password']}"><br>
    <div class="form-group form-check">
        <input type="checkbox" class="form-check-input " name="spam_ok" id="accept" checked>
        <label class="form-check-label" for="accept">I accept to periodically receive information about new products</label>
    </div>
    <input type="submit" name="sumbit" value="Continue" class="btn btn-primary">
    HTML;
        $form_page->render();
    }

    public function RegistrationFormDisplay()
    {
        $error_message = '';
        $Users = [
            ['id' => 0, 'email' => 'abc@test.com', 'pw' => '12345678'],
            ['id' => 1, 'email' => 'def@test.com', 'pw' => '12345678'],
            ['id' => 0, 'email' => 'abc@gmail.com', 'pw' => '11111111'],
        ];

        $full_name = '';
        $address1 = '';
        $address2 = '';
        $postalCode = '';
        $province = '';
        $email = '';
        $password = '';
        $repeatPass = '';
        $language = '';
        $city = '';
        if (isset($_POST['fullName'])) {
            $full_name = $_POST['fullName'];
            if (strlen($full_name) <= 2) {
                $error_message .= 'Please Enter you First name and last name<br>';
            }
        } else {
            $error_message .= 'Please Enter you First name and last name<br>';
        }
        if (isset($_POST['address1']) || isset($_POST['address2'])) {
            $address1 = $_POST['address1'];
            $address2 = $_POST['address2'];
            if (strlen($address1) > 255 && strlen($address2) > 255) {
                $error_message .= '<br>Address cannot be more than  255 characters<br>';
            }
        }
        if (isset($_POST['Postalcode'])) {
            $postalCode = $_POST['Postalcode'];

            if (strlen($postalCode) > 7) {
                $error_message .= 'Postal code cannot be greater than 7 characters<br>';
            }
        }
        if (isset($_POST['province'])) {
            $province = $_POST['province'];
        }
        if (isset($_POST['city'])) {
            $city = $_POST['city'];
            if (strlen($city) > 50) {
                $error_message .= 'City name cannot be greater than 50 characters '.'<br>';
            } elseif (strlen($city) == 0) {
                $error_message .= 'City name empty!<br>';
            }
        }
        if (isset($_POST['email'])) {
            if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $error_message .= 'Invalid Email !!<br>';
            } else {
                $email = $_POST['email'];
                foreach ($Users as $values) {
                    if ($full_name == $values['email']) {
                        $error_message .= 'Email already Exists..Please try again with different email.<br> ';
                    }
                }
            }
        } else {
            $error_message .= 'Please enter your email';
        }

        if (isset($_POST['language'])) {
            $language = $_POST['language'];
            if (isset($_POST['lanugage']) == 'other') {
                $language = $_POST['other_lang'];
            }
        }

        if (isset($_POST['password']) && isset($_POST['password2'])) {
            $password = $_POST['password'];
            $repeatPass = $_POST['password2'];

            if (strlen($password) != 8) {
                $error_message .= 'Password must be 8 characters !<br>';
            }
            if (strlen($repeatPass) != 8) {
                $error_message .= 'Confirm password must be 8 characters !<br>';
            }
            if ($password != $repeatPass) {
                $error_message .= 'Passwords do not match.Please re-enter same passwords.<br>';
            }
        } else {
            $error_message .= 'Please enter your password and reverify it.!';
        }
        if (!isset($_POST['spam_ok'])) {
            $_POST['spam_ok'] = 0;
        } else {
            $_POST['spam_ok'] = 1;
        }
        $DB = new db_pdo();
        $record = $DB->querySelect("select * from users where email='$email'");
        if (count($record) == 0) {
            $user_exist = false;
        } else {
            $user_exist = true;
            $error_message .= 'User Already Exists..try again with differernt email!!';
        }

        // foreach ($Users as $user) {
        //     if ($user['email'] == $email) {
        //         $error_message .= 'User already exists';
        //         break;
        //     }
        // }

        if ($error_message == '') {
            //ALL OK
            $userPage = new Webpage();
            $userPage->title = 'Welcome';
            $userPage->content = '<h2> Account details :</h2>';
            $userPage->content .= 'Name:'.$full_name
            .'<br>City: '.$city.'Province : '.$province.'<br> Postal Code :'.$postalCode.
            '<br>Email : '.$email.'<br>Address : '.$address1.'<br>Language:'.$language;
            // echo $full_name;
            $DB->querySelect("insert into users(name,email,password,address1,address2,province,postal_code,language,city) values('$full_name','$email','$password','$address1','$address2','$province','$postalCode','$language','$city')");

            $userPage->render();
        } else {
            //IN CASE OF ERROR
            $this->CreateRegistrationForm($error_message, $_POST);
        }
    }

    public function logout()
    {
        $_SESSION['user_connected'] = null;

        $_SESSION['user_email'] = null;
        $_SESSION['user_name'] = null;
        $_SESSION['user_id'] = null;
        $_SESSION['user_level'] = null;
        HomePage();
    }

    public function listUsers($table)
    {
        // $DB = new db_pdo();
        // $users = $DB->querySelect('Select * from users');

        $userPage = new Webpage();
        $userPage->title = 'Welcome';
        $userPage->content = '<h2> Account details :</h2>';
        $userPage->content .= array_to_ProductTable($table);
        $userPage->render();
    }
}
