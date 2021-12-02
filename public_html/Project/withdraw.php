<?php
require(__DIR__ . "/../../partials/nav.php");

if(isset($_POST["save"])){
    $account = se($_POST, "account", null, false);
    $withdrawAmount = se($_POST, "withdraw", null, false);
    $memo = se($_POST, "memo", null, false);
    //echo var_export((int)$withdrawAmount *-1);
    if(get_balance($account)>= $withdrawAmount){
        transaction((int)$withdrawAmount * -1, "withdraw", -1, find_account($account), $memo);
        flash("Successful withdrawal" , "success");
        die(header('Location: home.php'));
    }else{
        flash("Insufficient funds" , "warning");
    }


}
$query = "SELECT account, account_type, balance from Bank_Accounts WHERE user_id = :uid";
$db = getDB();
$stmt = $db->prepare($query);
$accounts = [];
try{
    $stmt->execute([":uid" => get_user_id()]);
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

            <select class=" btn btn-light form-select" name = "account">
                    <option selected> Select an account to withdraw from</option>
                <?php foreach ($accounts as $account) : ?>
                    <li><option><?php se($account, "account"); ?></option></li>
                <?php endforeach; ?>
            </select>


        <div class="mb-3 form-group col-md-3">
            <h2 label class="form-label text-dark" for="da">Withdraw</h2>
            <input class="form-control" type="number" input type="number" min="0.01" step="0.01"  name="withdraw"  id="da" />
        </div>
        <div class="mb-3 form-group">
            <h2 label class=" text-dark form-label" for="d">Memo</h2>
            <textarea class="form-control" name="memo" id="d"></textarea>
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