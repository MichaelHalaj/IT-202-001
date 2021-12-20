<?php
require_once(__DIR__ . "/db.php");
$BASE_PATH = '/Project/'; //This is going to be a helper for redirecting to our base project path since it's nested in another folder
function se($v, $k = null, $default = "", $isEcho = true)
{
    if (is_array($v) && isset($k) && isset($v[$k])) {
        $returnValue = $v[$k];
    } else if (is_object($v) && isset($k) && isset($v->$k)) {
        $returnValue = $v->$k;
    } else {
        $returnValue = $v;
        //added 07-05-2021 to fix case where $k of $v isn't set
        //this is to kep htmlspecialchars happy
        if (is_array($returnValue) || is_object($returnValue)) {
            $returnValue = $default;
        }
    }
    if (!isset($returnValue)) {
        $returnValue = $default;
    }
    if ($isEcho) {
        //https://www.php.net/manual/en/function.htmlspecialchars.php
        echo htmlspecialchars($returnValue, ENT_QUOTES);
    } else {
        //https://www.php.net/manual/en/function.htmlspecialchars.php
        return htmlspecialchars($returnValue, ENT_QUOTES);
    }
}
//TODO 2: filter helpers
function sanitize_email($email = "")
{
    return filter_var(trim($email), FILTER_SANITIZE_EMAIL);
}
function is_valid_email($email = "")
{
    return filter_var(trim($email), FILTER_VALIDATE_EMAIL);
}
//TODO 3: User Helpers
function is_logged_in($redirect = false, $destination = "login.php")
{
    $isLoggedIn = isset($_SESSION["user"]);
    if ($redirect && !$isLoggedIn) {
        flash("You must be logged in to view this page", "warning");
        die(header("Location: $destination"));
    }
    return $isLoggedIn; //se($_SESSION, "user", false, false);
}
function has_role($role)
{
    if (is_logged_in() && isset($_SESSION["user"]["roles"])) {
        foreach ($_SESSION["user"]["roles"] as $r) {
            if ($r["name"] === $role) {
                return true;
            }
        }
    }
    return false;
}
function get_visi($email){
    if(is_logged_in()){
        $query = "SELECT visibility FROM Users WHERE email = :email LIMIT 1";
        $db = getDB();
        $stmt = $db->prepare($query);
        try{
            $stmt->execute([":email" => $email]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result["visibility"];
        }catch (PDOException $e){
            flash("Technical error: " . var_export($e->errorInfo, true), "danger");
        }
    }
}
function get_username()
{
    if (is_logged_in()) { //we need to check for login first because "user" key may not exist
        return se($_SESSION["user"], "username", "", false);
    }
    return "";
}
function get_user_first()
{
    if (is_logged_in()) { //we need to check for login first because "user" key may not exist
        return se($_SESSION["user"], "firstName", "", false);
    }
    return "";
}
function get_user_last()
{
    if (is_logged_in()) { //we need to check for login first because "user" key may not exist
        return se($_SESSION["user"], "lastName", "", false);
    }
    return "";
}
function get_user_email()
{
    if (is_logged_in()) { //we need to check for login first because "user" key may not exist
        return se($_SESSION["user"], "email", "", false);
    }
    return "";
}
function get_user_id()
{
    if (is_logged_in()) { //we need to check for login first because "user" key may not exist
        return se($_SESSION["user"], "id", false, false);
    }
    return false;
}
//TODO 4: Flash Message Helpers
function flash($msg = "", $color = "info")
{
    $message = ["text" => $msg, "color" => $color];
    if (isset($_SESSION['flash'])) {
        array_push($_SESSION['flash'], $message);
    } else {
        $_SESSION['flash'] = array();
        array_push($_SESSION['flash'], $message);
    }
}

function getMessages()
{
    if (isset($_SESSION['flash'])) {
        $flashes = $_SESSION['flash'];
        $_SESSION['flash'] = array();
        return $flashes;
    }
    return array();
}
//TODO generic helpers
function reset_session()
{
    session_unset();
    session_destroy();
    session_start();
}
function users_check_duplicate($errorInfo)
{
    if ($errorInfo[1] === 1062) {
        //https://www.php.net/manual/en/function.preg-match.php
        preg_match("/Users.(\w+)/", $errorInfo[2], $matches);
        if (isset($matches[1])) {
            flash("The chosen " . $matches[1] . " is not available.", "warning");
        } else {
            //TODO come up with a nice error message
            flash("<pre>" . var_export($errorInfo, true) . "</pre>");
        }
    } else {
        //TODO come up with a nice error message
        flash("<pre>" . var_export($errorInfo, true) . "</pre>");
    }
}
function get_url($dest)
{
    global $BASE_PATH;
    if (str_starts_with($dest, "/")) {
        //handle absolute path
        return $dest;
    }
    //handle relative path
    return $BASE_PATH . $dest;
}
function get_balance($accountNumber){
    if(is_logged_in()){
        $query = "SELECT balance FROM Bank_Accounts WHERE account = :account LIMIT 1";
        $db = getDB();
        $stmt = $db->prepare($query);
        try{
            $stmt->execute([":account" => $accountNumber]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result["balance"];
        }catch (PDOException $e){
            flash("Technical error: " . var_export($e->errorInfo, true), "danger");
        }
    }
}
function find_account($accountNumber){
    if(is_logged_in()){
        $query = "SELECT id FROM Bank_Accounts WHERE account = :account LIMIT 1";
        $db = getDB();
        $stmt = $db->prepare($query);
        try{
            $stmt->execute([":account" => $accountNumber]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result["id"];
        }catch (PDOException $e){
            flash("Technical error: " . var_export($e->errorInfo, true), "danger");
        }
    }
}
function get_last_name_id($last){
    $query = "SELECT id FROM Users WHERE lastName = :lastName LIMIT 1" ;
    $db = getDB();
    $stmt = $db->prepare($query);
    try{
        $stmt->execute([":lastName" => $last]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if($result){
            return $result["id"];
        }
        else{
            return "none";
        }
        
        //echo var_export($userID);
    }catch (PDOException $e){
        flash("Technical error: " . var_export($e->errorInfo, true), "danger");
    }
}
function get_user_account_id(){
    if (is_logged_in()) { //we need to check for login first because "user" key may not exist
        $query = "SELECT id FROM Bank_Accounts WHERE id=(SELECT max(id) FROM Bank_Accounts) and user_id = :uid LIMIT 1";
        $db = getDB();
        $stmt = $db->prepare($query);
        try{
            $stmt->execute([":uid" => get_user_id()]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result["id"];
        }catch (PDOException $e){
            flash("Technical error: " . var_export($e->errorInfo, true), "danger");
        }
        //return se($_SESSION["user"]["account"], "id", "", false);
    }
    return "";
}
/*
function refresh_system_balance()
{
    if (is_logged_in()) {
        $query = "UPDATE Bank_Accounts set balance = (SELECT IFNULL(SUM(diff), 0) from Bank_Account_Transactions WHERE src = :src) where id = :src";
        $db = getDB();
        $stmt = $db->prepare($query);
        try {
            $stmt->execute([":src" => -1]);
            get_account(); //refresh session data
        } catch (PDOException $e) {
            flash("Error refreshing account: " . var_export($e->errorInfo, true), "danger");
        }
    }
}*/

function pagination_filter($newPage){
    $_GET["page"] = $newPage;
    return se(http_build_query($_GET));
}

function refresh_account_balance($accountID)
{
    if (is_logged_in()) {
        $query = "UPDATE Bank_Accounts set balance = (SELECT IFNULL(SUM(diff), 0) from Bank_Account_Transactions WHERE src = :src) where id = :src";
        $db = getDB();
        $stmt = $db->prepare($query);
        try {
            $stmt->execute([":src" =>$accountID]);
            //get_account(); //refresh session data
        } catch (PDOException $e) {
            flash("Error refreshing account: " . var_export($e->errorInfo, true), "danger");
        }
    }
}
function update_APY(){
    $query = "SELECT account, ID, created, balance, updated, active FROM Bank_Accounts where user_id = :ID AND account_type = :savings OR account_type = :loan AND active = :true";
    
    $db = getDB();
    $stmt = $db->prepare($query);
    try{
        $stmt->execute([":ID" => get_user_id(), ":savings" => "savings", ":loan" => "loan", ":true" => "true"]);
        $result = $stmt->fetchALL(PDO::FETCH_ASSOC);
        $queryAPY = "SELECT APY from System_Properties WHERE APY = :APY";
        $stmt = $db->prepare($queryAPY);
        try{
            $stmt->execute([":APY" => 1]);
            $APY = $stmt->fetch(PDO::FETCH_ASSOC);
            $APY = $APY["APY"];
            $APY = $APY/1000;
            //$date = date('Y-m-d H:i:s');
            $date1 = date_create();
            

            foreach($result as $r){
                $date2 = date_create($r["created"]);
                $diff = date_diff($date2,$date1, true);
                $offset = ceil($diff->d/30);
                if($r["updated"] == NULL){
                    if($offset%30 == 0 && $offset != 0){
                        $interest = (($APY/12) * $r["balance"]/100)*100;
                        transaction($interest, "transfer", -1, $r["ID"], "interest");
                        //$updatedBalance = $interest + $r["balance"]*100;
                        $query = "UPDATE Bank_Accounts set updated = :updated WHERE ID = :id";
                        $db = getDB();
                        $stmt = $db->prepare($query);
                        try {
                            $stmt->execute([":updated" => $date1->format('Y-m-d'), ":id" => $r["ID"]]);
                        } catch (PDOException $e) {
                            flash("Error refreshing account: " . var_export($e->errorInfo, true), "danger");
                        }
                    }
                }else{
                    $date3 = date_create($r["updated"]);
                    $updatedDiff = date_diff($date3,$date1, true);
                    if($updatedDiff->d != 0){
                        if($offset%30 == 0 && $offset != 0){
                            $interest = (($APY/12) * $r["balance"]/100)*100;
                            transaction($interest, "transfer", -1, $r["ID"], "interest");
                            //$updatedBalance = $interest + $r["balance"];
                            $query = "UPDATE Bank_Accounts set updated = $date1 WHERE id = :id";
                            $db = getDB();
                            $stmt = $db->prepare($query);
                            try {
                                $stmt->execute([":id" => $r["id"]]);
                                
                            } catch (PDOException $e) {
                                flash("Error refreshing account: " . var_export($e->errorInfo, true), "danger");
                            }
                    }
                }
                }
                //echo var_export($offset);
                //echo var_export($r["created"]);
                
                
            }
        }catch (PDOException $e) {
            flash("Error refreshing account: " . var_export($e->errorInfo, true), "danger");
        }
    }catch (PDOException $e) {
        flash("Error refreshing account: " . var_export($e->errorInfo, true), "danger");
    }

} 



function transaction($money, $typeTrans, $src = -1, $dest = -1, $memo = "")
{
    //I'm choosing to ignore the record of 0 point transactions
        $query = "INSERT INTO Bank_Account_Transactions (src, dest, diff, typeTrans, memo) 
            VALUES (:acs, :acd, :pc, :r,:m), 
            (:acs2, :acd2, :pc2, :r, :m)";
        //I'll insert both records at once, note the placeholders kept the same and the ones changed.
        $params[":acs"] = $src;
        $params[":acd"] = $dest;
        $params[":r"] = $typeTrans;
        $params[":m"] = $memo;
        $params[":pc"] = ($money * -100);

        $params[":acs2"] = $dest;
        $params[":acd2"] = $src;
        $params[":pc2"] = $money *100;
        $db = getDB();
        $stmt = $db->prepare($query);
        try {
            $stmt->execute($params);
            //Only refresh the balance of the user if the logged in user's account is part of the transfer
            //this is needed so future features don't waste time/resources or potentially cause an error when a calculation
            //occurs without a logged in user
           
                refresh_account_balance($dest);
                refresh_account_balance($src);
              //  refresh_system_balance();
            
        } catch (PDOException $e) {
            flash("Transfer error occurred: " . var_export($e->errorInfo, true), "danger");
        }
    
}
function get_random_str($length)
{
    return substr(str_shuffle(str_repeat('0123456789abcdefghijklmnopqrstvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', 36)), 0, $length);
}
function get_or_create_account($accountType, $money)
{
    if (is_logged_in()) {
        //let's define our data structure first
        //id is for internal references, account_number is user facing info, and balance will be a cached value of activity
        $account = ["id" => -1, "account_number" => false, "balance" => 0];
        //this should always be 0 or 1, but being safe
        $query = "SELECT id, account, balance, account_type from Bank_Accounts where user_id = :uid LIMIT 1";
        $db = getDB();
        $stmt = $db->prepare($query);
        try {
            $stmt->execute([":uid" => get_user_id()]);
            //$result = $stmt->fetch(PDO::FETCH_ASSOC);
                //account doesn't exist, create it
                $created = false;
                //we're going to loop here in the off chance that there's a duplicate
                //it shouldn't be too likely to occur with a length of 12, but it's still worth handling such a scenario

                //you only need to prepare once
                $query = "INSERT INTO Bank_Accounts (account, user_id, account_type) VALUES (:an, :uid, :at)";
                $stmt = $db->prepare($query);
                $user_id = get_user_id(); //caching a reference
                $account_number = "";
                while (!$created) {
                    try {
                        $account_number = get_random_str(12);
                        $stmt->execute([":an" => $account_number, ":uid" => $user_id, ":at" => $accountType]);
                        $created = true;
                        //transaction($money, "deposit", -1, $account_number, ""); 
                        //if we got here it was a success, let's exit
                        if($accountType == "loan"){
                            flash("Your loan account has been opened");
                        }else{
                            flash("Welcome! Your account has been created successfully", "success");
                        }
                        
                    } catch (PDOException $e) {
                        $code = se($e->errorInfo, 0, "00000", false);
                        //if it's a duplicate error, just let the loop happen
                        //otherwise throw the error since it's likely something looping won't resolve
                        //and we don't want to get stuck here forever
                        if (
                            $code !== "23000"
                        ) {
                            throw $e;
                        }
                    }
                }
                //loop exited, let's assign the new values
                $account["id"] = $db->lastInsertId();
                $account["account_number"] = $account_number;
        } catch (PDOException $e) {
            flash("Technical error: " . var_export($e->errorInfo, true), "danger");
        }
        $_SESSION["user"]["account"] = $account; //storing the account info as a key under the user session
        //Note: if there's an error it'll initialize to the "empty" definition around line 161

    } else {
        flash("You're not logged in", "danger");
    }
}
function get_system_account(){
    if (is_logged_in()) {
        //let's define our data structure first
        //id is for internal references, account_number is user facing info, and balance will be a cached value of activity
        $account = ["id" => -1, "account_number" => false, "balance" => 0];
        //this should always be 0 or 1, but being safe
        $query = "SELECT id, account, balance from Bank_Accounts where user_id = :uid LIMIT 1";
        $db = getDB();
        $stmt = $db->prepare($query);
        try {
            $stmt->execute([":uid" => -1]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

                //$account = $result; //just copy it over
                $account["id"] = $result["id"];
                $account["account_number"] = $result["account"];
                $account["balance"] = $result["balance"];
            
        } catch (PDOException $e) {
            flash("Technical error: " . var_export($e->errorInfo, true), "danger");
        }
        $_SESSION["user"]["account"] = $account; //storing the account info as a key under the user session
        //Note: if there's an error it'll initialize to the "empty" definition around line 161

    } else {
        flash("You're not logged in", "danger");
    } 
}
function get_account()
{
    if (is_logged_in()) {
        //let's define our data structure first
        //id is for internal references, account_number is user facing info, and balance will be a cached value of activity
        $account = ["id" => -1, "account_number" => false, "balance" => 0];
        //this should always be 0 or 1, but being safe
        $query = "SELECT id, account, balance from Bank_Accounts where user_id = :uid LIMIT 1";
        $db = getDB();
        $stmt = $db->prepare($query);
        try {
            $stmt->execute([":uid" => get_user_id()]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

                //$account = $result; //just copy it over
                $account["id"] = $result["id"];
                $account["account_number"] = $result["account"];
                $account["balance"] = $result["balance"];
            
        } catch (PDOException $e) {
            flash("Technical error: " . var_export($e->errorInfo, true), "danger");
        }
        $_SESSION["user"]["account"] = $account; //storing the account info as a key under the user session
        //Note: if there's an error it'll initialize to the "empty" definition around line 161

    } else {
        flash("You're not logged in", "danger");
    }
}
