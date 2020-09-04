<?php

 // <select id="provinces" province class="btn btn-secondary dropdown-toggle">

        //     <option name="QC">Quebec</option>
        //     <option name="Ont">Ontario</option>
        //     <option name="BC">British Columbia</option>
        //     <option name="AB">Alberta</option>
        //     <option name="NS">Nova Scotia</option>
        //     <option name="MN">Manitoba</option>
        // </select>
require_once 'tools.php';
class users
{
    public function LoginPageDisplay($error_msg = '', $prev_values = [])
    {
        if ($prev_values == []) {
            $prev_values['email'] = '';
            $prev_values['password'] = '';
        }
        $form_page = new Webpage();
        $form_page->title = 'Login Page: Please Login !!';
        $form_page->content = <<<HTML
         <form action="index.php?op=2" method="POST">
        <!-- <input type="hidden" name ="op" value="2">used in case of GET method -->
        <div style="color:red">$error_msg</div>
        <input type="text" name="email" maxlength=126 size=25  placeholder="EMAIL" value="{$prev_values['email']}"><br>
        <input type="Password" name="password" maxlength=8  placeholder="Password (8 char)" value="{$prev_values['password']}"><br>
        <input type="submit" name="sumbit" value="Continue" class="btn btn-primary">
        HTML;
        $form_page->render();
    }

    public function LoginPageVerify()
    {
        $users = [['id' => 0, 'email' => 'abc@test.com', 'password' => 12345678],
        ['id' => 1, 'email' => 'abcd@test.com', 'password' => 12345678],
        ['id' => 2, 'email' => 'abce@test.com', 'password' => 12345678],
        ['id' => 3, 'email' => 'abcf@test.com', 'password' => 12345678], ];
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
            $prev_values =
            $this->LoginPageDisplay($error_message, $_POST);
        }
        foreach ($users as $key => $value) {
            if ($users[$key]['email'] == $email_input && $users[$key]['password'] == $password_input) {
                $verify_page = new Webpage();
                $verify_page->title = 'Verify Page';
                $verify_page->content = '<h2>Welcome Back!!</h2> <br>
        <h3>Hello , You are Loged in-'.$email_input.'<br>'.$password_input.'</h3>';
                $verify_page->render();
                die();
            }
        }

        $verify_page = new Webpage();
        $verify_page->title = 'Verify Page';
        $verify_page->content = '<p>User id not found!!!<br>
            Login Again:<a href="index.php?op=1">Reload</a> </p>';
        $verify_page->render();

        // echo $email_input.'<br>'.$passwor_input.'<br>';
    }

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
        }
        $form_page = new Webpage();
        $form_page->title = 'Login Page: Please Login !!';
        $form_page->content = <<<HTML
    <h2>General Information</h2>
    <form action="index.php?op=2" method="POST">
    <!-- <input type="hidden" name ="op" value="2">used in case of GET method -->
    <div style="color:red">$error_message</div>
    <input type="text" name="fullName" class="form-control" style="width: 300px;" maxlength="50" required size=25  placeholder="Firstname and lastname" value="{$prev_values['email']}"><br>'
    <label for="address1">Adress(Optional)</label>
    <input type="text" name="address" class="form-control" style="width: 300px;" maxlength="255" placeholder="Address Line 1" id="address1"><br>
    <input type="text" name="address" class="form-control " style="width: 300px;"  placeholder="Address Line 2" id="address2"><br>
    <label for="city">City(Optional)</label>
    <input type="text" name="city" class="form-control"  style="width: 300px;"maxlength="50"  id="city"><br>
    <label for="provinces">Province(Optional)</label><br>
    HTML;
        $form_page->content .= make_dropDown($Provinces, 'provinces');
        $form_page->content .= <<<HTML
    <br>
    <label for="Postalcode">Postal Code</label><br>
    <input type="text" name="Postalcode"  maxlength="7"  class="form-control" style="width: 300px;"  id="Postalcode"><br>
    <input type=radio name="language" value="fr">French<br>
    <input type=radio name="language" value="en">English<br>
    <input type=radio name="language" value="other">Other<input type=text name="other_lang" maxlength="25" ><br><br>
    <h2>Connection Info(Required)</h2>
    <input type="text" name="email" class="form-control" style="width: 300px;" required maxlength=126 size=25  placeholder="EMAIL" value="{$prev_values['email']}"><br> 
    <input type="Password" name="password" class="form-control " style="width: 300px;" required maxlength=8  placeholder="Password (8 char)" value="{$prev_values['password']}"><br>
    <input type="Password" name="password" class="form-control " style="width: 300px;" required maxlength=8  placeholder="Repeat Password " value="{$prev_values['password']}"><br>
    <div class="form-group form-check">
        <input type="checkbox" class="form-check-input " name="spam_ok" id="accept">
        <label class="form-check-label" for="accept">I accept to periodically receive information about new products</label>
    </div>
    <input type="submit" name="sumbit" value="Continue">
    HTML;
        $form_page->render();
    }
}
