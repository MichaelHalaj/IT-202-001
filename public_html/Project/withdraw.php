<?php
require(__DIR__ . "/../../partials/nav.php");

if(isset($_POST["save"])){
    $account = se($_POST, "account", null, false);
    $ID = find_account($account);
    $query = "SELECT user_id from Bank_Accounts where id = :src";
            $db = getDB();
            $stmt = $db->prepare($query);
            $belongsToUser = true;
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
                        }
                    }
                }
            }catch (PDOException $e){
                flash("Technical error: " . var_export($e->errorInfo, true), "danger");
            }
            if(!$belongsToUser){
                flash("Please select accounts that belong to user", "warning");
            }else{
                if(strlen($account)!=12){
                    flash("Please select an account", "warning");
                }else{
                    $withdrawAmount = se($_POST, "withdraw", null, false);
                    $memo = se($_POST, "memo", null, false);
                    
                    if(get_balance($account) - ((int)$withdrawAmount *100) >= 0){
                        transaction((int)$withdrawAmount * -1, "withdraw", -1, find_account($account), $memo);
                        //echo var_export(get_balance($account)>= $withdrawAmount);
                        die(header('Location: home.php'));
                       
                    }else{
                        flash("Insufficient funds" , "warning");
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
<?php

?>
<div class = "container-fluid">
<?php if (is_logged_in()) : ?>
   <form onsubmit="return validate(this)" method="POST">

            <select class=" btn btn-dark form-select" name = "account">
                    <option selected> Select an account to withdraw from</option>
                <?php foreach ($accounts as $account) : ?>
                    <li><option><?php se($account, "account"); ?></option></li>
                <?php endforeach; ?>
            </select>


        <div class="mb-3 form-group col-md-3">
            <h2 label class="form-label text-dark" for="da">Withdraw</h2>
            <input class="form-control" type="number" input type="number" min="0.01" step="0.01"  name="withdraw"  id="da" required/>
        </div>
        <div class="mb-3 form-group">
            <h2 label class=" text-dark form-label" for="d">Memo</h2>
            <textarea class="form-control" name="memo" id="d" maxlength = 240></textarea>
        </div>
        <input type="submit" class="btn btn-success" value = "Withdraw" name = "save"></input>  
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