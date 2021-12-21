<?php
require(__DIR__ . "/../../partials/nav.php");

if(isset($_POST["save"])){
    $amount = se($_POST, "transfer", null ,false);
    $from = se($_POST, "accountFROM", null, false);

    $into = se($_POST, "accountINTO", null, false);
    $intoAccount = substr($into,0,12);
    $intoType = substr($into,12);
    $memo = se($_POST, "memo", null, false);
    $fromBal = get_balance($from);
    $intoBal = get_balance($intoAccount);
    $fromID = find_account($from);
    $intoID = find_account($intoAccount);
    //echo var_export($fromID);
   // echo var_export($intoID);
    $query = "SELECT user_id, account_type from Bank_Accounts where id = :src";
    $db = getDB();
    $stmt = $db->prepare($query);
    $belongsToUser = true;
    $isLoanSrc = false;
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
                }elseif($r["account_type"] == "loan"){
                    $isLoanSrc = true;
                    break;
                }
            }
        }
    }catch (PDOException $e){
        flash("Technical error: " . var_export($e->errorInfo, true), "danger");
    }
    $query = "SELECT user_id from Bank_Accounts where id = :dest";
    $db = getDB();
    $stmt = $db->prepare($query);
    $belongsToUser = true;
    try{
        $stmt->execute([":dest" => $intoID]);
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
    }elseif($isLoanSrc){
        flash("Cannot transfer from a loan account", "warning");
    }else{
        if($fromBal - ($amount*100) < 0 ){
            flash("Insufficient funds to transfer", "warning");
        }else{
            if($intoType == "loan"){
                if($intoBal - ($amount*100) < 0){
                    flash("Transfer exceeded loan balance", "warning");
                }
                else{
                    if(frozen_check($fromID) || frozen_check($intoID)){
                        flash("Transaction cannot occur; Account[s] is/are frozen!", "warning");
                    }else{
                        transaction($amount, "transfer", $fromID, -1, $memo);
                        transaction($amount, "transfer", $intoID, -1, $memo);
                        die(header("Location: user_accounts.php"));
                    }
                }
            }else{
                transaction($amount, "transfer", $fromID, $intoID, $memo);
                die(header("Location: user_accounts.php"));
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
$query = "SELECT account, account_type, balance from Bank_Accounts WHERE user_id = :uid";
$db = getDB();
$stmt = $db->prepare($query);
$accounts2 = [];
try{
    $stmt->execute([":uid" => get_user_id()]);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if ($results) {
        $accounts2 = $results;
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
        <select class=" btn btn-dark form-select" name = "accountINTO" aria-label="into">
                        <option selected> Select an account to transfer INTO</option>
                        <?php foreach ($accounts2 as $account) : ?>
                    <li><option value = "<?php [se($account, "account"), se($account, "account_type")];?>"><?php se($account, "account"); ?></option></li>
                <?php endforeach; ?>
                
                    </select>
    </div>
</div>
<div class="mb-3 form-group col-md-3">
            <h2 label class="form-label text-dark" for="da" >Transfer Amount</h2>
            <input class="form-control" type="number" input type="number" min="0.01" step="0.01"  name="transfer"  id="da" aria-labelledby="da" required/>
</div>
<div class="mb-3 form-group col-md-6">
            <h2 label class="form-label text-dark" for="memo" >Memo</h2>
            <textarea class="form-control" name="memo"  id="memo" maxlength = 240></textarea> 
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
        let a = document["this"]["accountINTO"].value;
        a = a.substring(0,12);
        if(z === a){
            flash("Accounts must be different", "warning");
            return false;
        }
        if(z.length > 12 || a.length > 12){
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