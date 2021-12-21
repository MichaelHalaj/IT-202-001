<?php
require(__DIR__ . "/../../partials/nav.php");

if(isset($_POST["save"])){
    $amount = se($_POST, "transfer", null ,false);
    $from = se($_POST, "accountFROM", null, false);
    $account = se($_POST, "accountNum", null, false);
    $last = se($_POST, "lastName", null ,false);

    if(!preg_match('/^[a-zA-Z]+$/', $last)){
        flash("Must be valid last name", "warning");
    }else{
        $userID = get_last_name_id($last);
        if($userID === "none"){
            flash("No such user exists", "warning");
        }else{
            $fromID = find_account($from);
            $query = "SELECT user_id from Bank_Accounts where id = :src";
            $db = getDB();
            $stmt = $db->prepare($query);
            $belongsToUser = true;
            try{
                $stmt->execute([":src" => $fromID]);
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $user_id = get_user_id();
            // echo var_export($result);
                if($result){
                    //echo var_export($result);
                    foreach($result as $r){
                        if($r["user_id"] != $user_id){
                            $belongsToUser = false;
                            break;
                        }
                    }
                }
            }catch (PDOException $e){
                flash("Technical error: " . var_export($e->errorInfo, true), "danger");
            }
            if(!$belongsToUser){
                flash("Please select accounts that belong to user", "warning");
            }else{
            $query = "SELECT id, account_type, balance FROM Bank_Accounts WHERE account LIKE '%$account' AND user_id = :uid and active = :true LIMIT 1" ;
            $db = getDB();
            $stmt = $db->prepare($query);
            try{
                $stmt->execute([":uid" => $userID, ":true" => "true"]);
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                if($result){
                    $otherID =  $result["id"];
                    $otherType = $result["account_type"];
                    $intoBal = $result["balance"];
                    
                }
                else{
                    $otherID = "none";
                }
        
            }catch (PDOException $e){
                flash("Technical error: " . var_export($e->errorInfo, true), "danger");
            }
           // $into = se($_POST, "accountINTO", null, false);
            $memo = se($_POST, "memo", null, false);
            $fromBal = get_balance($from);
            //$intoBal = get_balance($into);
            //$fromID = find_account($from);
            //$intoID = find_account($into);
            if($otherID === "none"){
                flash("No such account exists. Try again.", "warning");
            }else{
                if($otherID === $fromID){
                    flash("Accounts must be different", "warning");
                }else{
                    if($fromBal - ($amount*100) < 0 ){
                        flash("Insufficient funds to transfer", "warning");
                    }else{
                        if($userID === get_user_id()){
                            flash("Please select an account that is not yours", "warning");
                        }else{
                            if($otherType == "loan"){
                                if($intoBal - ($amount*100) < 0){
                                    flash("Transfer exceeded loan balance", "warning");
                                }
                                else{
                                    if(frozen_check($fromID) || frozen_check($otherID)){
                                        flash("Transaction cannot occur; Account[s] is/are frozen!", "warning");
                                    }else{
                                        transaction($amount, "ext-transfer", $fromID, -1, $memo);
                                        transaction($amount, "ext-transfer", $otherID, -1, $memo);
                                        //echo var_export($otherID);
                                        die(header("Location: user_accounts.php"));
                                    }
                                }
                            }else{
                                transaction($amount, "ext-transfer", $fromID, $otherID, $memo);
                                die(header("Location: user_accounts.php"));
                            }
                       // echo var_export($fromID);
                        //echo var_export($otherID);

                        }
            
                    }
                }
             
            
            }
            }
    }
}

        }

    



$query = "SELECT account, account_type, balance from Bank_Accounts WHERE user_id = :uid AND account_type <> :loan and active = :true";
$db = getDB();
$stmt = $db->prepare($query);
$accounts = [];
try{
    $stmt->execute([":uid" => get_user_id(), ":loan" => "loan", ":true" => "true"]);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if ($results) {
        $accounts = $results;
    }
} catch (PDOException $e) {
    flash(var_export($e->errorInfo, true), "danger");
}
?>
<div class = "container-fluid">
<?php if (is_logged_in()) : ?>
    <form onsubmit="return validate(this)"  name = "this" method="POST">
<br>
<div class = "row ">
    <div class = "mb-3 form-group col-md-3">
        
    </div>
    <div class="mb-3 form-group col-md-3">
    <h2 class = "text-warning">Source</h2>
        <select class=" btn btn-dark form-select" name = "accountFROM" aria-label="from">
                        <option selected> Select an account to transfer FROM</option>
                        <?php foreach ($accounts as $account) : ?>
                    <li><option><?php se($account, "account"); ?></option></li>
                <?php endforeach; ?>
                    </select>
    </div>
    <div class="mb-3 form-group col-md-3">
            <h2 class = "text-info">Destination</h2>
            <input class="form-control" type="text" name="lastName" id="lastName" maxlength = 25 required/>
            <small id="search"  class="form-text text-warning">Search for user's last name</small>
    </div>
    </div>
</div>
<div class = "row">
        <div class = "mb-3 form-group col-md-3"></div>
        <div class = "mb-3 form-group col-md-3"></div>
<div class="mb-3 form-group col-md-3">
            <h2 class = "text-info">Account Number</h2>
            <input class="form-control" type="text" name="accountNum" id="accountNum" minlength =4 maxlength = 4 required/>
            <small id="4chars"  class="form-text text-warning">Enter the last 4 characters of the user account</small>
    </div>
</div>
<div class="mb-3 form-group col-md-3">
            <h2 label class="form-label text-dark" for="da" >Transfer Amount</h2>
            <input class="form-control" type="number" input type="number" min="0.01" step="0.01"  name="transfer"  id="da" aria-labelledby="da" required/>
</div>
<div class="mb-3 form-group col-md-6">
            <h2 label class="form-label text-dark" for="memo" >Memo</h2>
            <textarea class="form-control" name="memo"  id="memo"></textarea> 
</div>
<input type="submit" class="btn btn-success" value = "Transfer" name = "save"></input>  
    <table class = "table text-light">
        <thead>
            <th></th>
        </thead>
    </table>
    </form>
    <?php endif; ?>  
</div>

<script>
    function validate(form) {
        let z = document["this"]["accountFROM"].value;
        //let a = document["this"]["accountINTO"].value;
        //alert(z);
        //console.log(z);
        if(z.length != 12){
            flash("Please select an account", "warning");
            return false;
        }
        //TODO 1: implement JavaScript validation
        //ensure it returns false for an error and true for success
        /*
        let x = document.forms[form]["transfer"];
  if (isNaN(x)) {
    flash("Enter a valid amount", "warning");
    return false;
  } */
        return true;
    }
</script>
<?php
require(__DIR__ . "/../../partials/flash.php");
?>