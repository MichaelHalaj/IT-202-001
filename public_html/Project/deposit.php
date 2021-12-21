<?php
require(__DIR__ . "/../../partials/nav.php");

if(isset($_POST["save"])){
    $account = se($_POST, "account", null, false);
    $depositAmount = se($_POST, "deposit", null, false);
    $memo = se($_POST, "memo", null, false);
    $ID= find_account($account);
    $query = "SELECT user_id, account_type, active from Bank_Accounts where id = :src";
            $db = getDB();
            $stmt = $db->prepare($query);
            $belongsToUser = true;
            $isLoan = false;
            $isActive = true;
            try{
                $stmt->execute([":src" => $ID]);
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
                            $isLoan = true;
                            break;
                        }elseif($r["active"] == "false"){
                            $isActive = false;
                        }
                    }
                }
            }catch (PDOException $e){
                flash("Technical error: " . var_export($e->errorInfo, true), "danger");
            }
            if(!$belongsToUser){
                flash("Please select accounts that belong to user", "warning");
            }elseif($isLoan){
                flash("Cannot deposit into loan account; user must transfer into loan account", "warning");
            }elseif(!$isActive){
                flash("Cannot complete transaction as account is closed", "warning");
            }
            else{
                if(strlen($account)!=12){
                    flash("Please select an account", "warning");
                }else{
                    transaction($depositAmount, "deposit", -1, $ID, $memo);
                    die(header('Location: home.php'));
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
<?php

?>
<div class = "container-fluid">
<?php if (is_logged_in()) : ?>
   <form onsubmit="return validate(this)" method="POST">
   <br>

            <select class=" btn btn-dark form-select" name = "account">
                    <option selected> Select an account to depsosit into</option>
                <?php foreach ($accounts as $account) : ?>
                    <li><option><?php se($account, "account"); ?></option></li>
                <?php endforeach; ?>
            </select>


        <div class="mb-3 form-group col-md-3">
            <h2 label class="form-label text-dark" for="da">Deposit</h2>
            <input class="form-control" type="number" input type="number" min="0.01" step="0.01"  name="deposit"  id="da" required/>
        </div>
        <div class="mb-3 form-group">
            <h2 label class=" text-dark form-label" for="d">Memo</h2>
            <textarea class="form-control" name="memo" id="d" maxlength =240></textarea>
        </div>
        <input type="submit" class="btn btn-success" value = "Deposit" name = "save"></input>  
   </form>
    <?php endif; ?>       
</div>
<script>
    function validate(form) {
        //TODO 1: implement JavaScript validation
        //ensure it returns false for an error and true for success

        return true;
    }
</script>
<?php
require(__DIR__ . "/../../partials/flash.php");
?>