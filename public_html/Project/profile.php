<?php
require_once(__DIR__ . "/../../partials/nav.php");
is_logged_in(true);
?>
<?php
if (isset($_POST["save"])) {
    $email = se($_POST, "email", null, false);
    $username = se($_POST, "username", null, false);
    $first = se($_POST, "firstName", null, false);
    $last = se($_POST, "lastName", null, false);
    $hasError = false;
    //sanitize
    $email = sanitize_email($email);
    //validate
    if (!is_valid_email($email)) {
        flash("Invalid email address", "danger");
        $hasError = true;
    }
    if(strlen($first) > 25 || strlen($last) > 25){
        flash("First name or last name length must be less than 25 characters", "danger");
        $hasError = true;
    }
    if(!preg_match('/^[a-zA-Z]+$/', $first)){
        flash("First name must be alphabetical", "danger");
        $hasError = true;
    }
    if(!preg_match('/^[a-zA-Z]+$/', $last)){
        flash("Last name must be alphabetical", "danger");
        $hasError = true;
    } 
    if (!preg_match('/^[a-z0-9_-]{3,16}$/i', $username)) {
        flash("Username must only be alphanumeric and can only contain - or _", "danger");
        $hasError = true;
    }
    if (!$hasError) {
        $params = [":email" => $email, ":username" => $username, ":firstName" => $first, ":lastName" => $last, ":id" => get_user_id()];
        $db = getDB();
        $stmt = $db->prepare("UPDATE Users set email = :email, username = :username, firstName = :firstName, lastName = :lastName where id = :id");
        try {
            $stmt->execute($params);
            flash("Successful update");
        } catch (Exception $e) {
            users_check_duplicate($e->errorInfo);  
        }
    }
    //select fresh data from table
    $db = getDB();
    $stmt = $db->prepare("SELECT id, email, IFNULL(username, email) as `username`, firstName, lastName from Users where id = :id LIMIT 1");
    try {
        $stmt->execute([":id" => get_user_id()]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user) {
            //$_SESSION["user"] = $user;
            $_SESSION["user"]["email"] = $user["email"];
            $_SESSION["user"]["username"] = $user["username"];
            $_SESSION["user"]["firstName"] = $user["firstName"];
            $_SESSION["user"]["lastName"] = $user["lastName"];
        } else {
            flash("User doesn't exist", "danger");
        }
    } catch (Exception $e) {
        flash("An unexpected error occurred, please try again", "danger");
        //echo "<pre>" . var_export($e->errorInfo, true) . "</pre>";
    }


    //check/update password
    $current_password = se($_POST, "currentPassword", null, false);
    $new_password = se($_POST, "newPassword", null, false);
    $confirm_password = se($_POST, "confirmPassword", null, false);
    if (!empty($current_password) && !empty($new_password) && !empty($confirm_password)) {
        if ($new_password === $confirm_password) {
            //TODO validate current
            $stmt = $db->prepare("SELECT password from Users where id = :id");
            try {
                $stmt->execute([":id" => get_user_id()]);
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                if (isset($result["password"])) {
                    if (password_verify($current_password, $result["password"])) {
                        $query = "UPDATE Users set password = :password where id = :id";
                        $stmt = $db->prepare($query);
                        $stmt->execute([
                            ":id" => get_user_id(),
                            ":password" => password_hash($new_password, PASSWORD_BCRYPT)
                        ]);

                        flash("Password reset", "success");
                    } else {
                        flash("Current password is invalid", "warning");
                    }
                }
            } catch (Exception $e) {
                echo "<pre>" . var_export($e->errorInfo, true) . "</pre>";
            }
        } else {
            flash("New passwords don't match", "warning");
        }
    }
}
?>

<?php
$email = get_user_email();
$username = get_username();
$first = get_user_first();
$last = get_user_last();
?>
<div class="container-fluid">
    <h1 class = "fw-bold">Profile</h1>
    <form method="POST" onsubmit="return validate(this);">
    <div class = "row">
        <div class="mb-3 form-group col-md-4">
            <label class="form-label" for="email">Email</label>
            <input class="form-control" type="email" name="email" id="email" value="<?php se($email); ?>" />
        </div>
        <div class="mb-3 form-group col-md-4">
            <label class="form-label" for="username">Username</label>
            <input class="form-control" type="text" name="username" id="username" value="<?php se($username); ?>" />
        </div>
        </div>
        <div class ="row">
        <div class="mb-3 form-group col-md-4">
            <label class="form-label" for="first">First Name</label>
            <input class="form-control" type="text" name="firstName" id="first" value = "<?php se($first); ?>"/>
        </div>
        <div class="mb-3 form-group col-md-4">
            <label class="form-label" for="last">Last Name</label>
            <input class="form-control" type="text" name="lastName" id="last" value = "<?php se($last); ?>"/>
        </div>
        </div>
        <!-- DO NOT PRELOAD PASSWORD -->
        <h3 class="mb-3">Password Reset</h3>
        <div class="mb-3 form-group col-md-4">
            <label class="form-label" for="cp">Current Password</label>
            <input class="form-control" type="password" name="currentPassword" id="cp" />
        </div>
        <div class="mb-3 form-group col-md-4">
            <label class="form-label" for="np">New Password</label>
            <input class="form-control" type="password" name="newPassword" id="np" />
        </div>
        <div class="mb-3 form-group col-md-4">
            <label class="form-label" for="conp">Confirm Password</label>
            <input class="form-control" type="password" name="confirmPassword" id="conp" />
        </div>
        <input type="submit" class="mt-3 btn btn-primary" value="Update Profile" name="save" />
    </form>
</div>
<script>
    function validate(form) {
        let pw = form.newPassword.value;
        let con = form.confirmPassword.value;
        let isValid = true;
        //TODO add other client side validation....

        //example of using flash via javascript
        //find the flash container, create a new element, appendChild
        if (pw !== con) {
            //find the container
            /*let flash = document.getElementById("flash");
            //create a div (or whatever wrapper we want)
            let outerDiv = document.createElement("div");
            outerDiv.className = "row justify-content-center";
            let innerDiv = document.createElement("div");
            //apply the CSS (these are bootstrap classes which we'll learn later)
            innerDiv.className = "alert alert-warning";
            //set the content
            innerDiv.innerText = "Password and Confirm password must match";
            outerDiv.appendChild(innerDiv);
            //add the element to the DOM (if we don't it merely exists in memory)
            flash.appendChild(outerDiv);*/
            flash("Password and Confirm password must match", "warning");
            isValid = false;
        }
        return isValid;
    }
</script>
<?php
require_once(__DIR__ . "/../../partials/flash.php");
?>