<?php
require(__DIR__ . "/../../partials/nav.php");

if(isset($_POST["save"])){
    $amount = se($_POST, "transfer", null ,false);
    $from = se($_POST, "accountFROM", null, false);
    $into = se($_POST, "accountINTO", null, false);
    $fromBal = get_balance($from);
    //$intoBal = get_balance($into);
    $fromID = find_account($from);
    $intoID = find_account($into);
    if($fromBal - ($amount*100) < 0 ){
        flash("Insufficient funds to transfer", "warning");
    }else{
        transaction($amount, "transfer", $fromID, $intoID, "");
        flash("Successful transfer");
        die(header("Location: user_accounts.php"));
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
<div class = "container-fluid">
<?php if (is_logged_in()) : ?>
    <form onsubmit="return validate(this)"  name = "this" method="POST">
<br>
<div class = "row justify-content-center">
    <div class="mb-3 form-group col-md-3">
        <select class=" btn btn-dark form-select" name = "accountFROM" aria-label="from">
                        <option selected> Select an account to transfer FROM</option>
                        <?php foreach ($accounts as $account) : ?>
                    <li><option><?php se($account, "account"); ?></option></li>
                <?php endforeach; ?>
                    </select>
    </div>
    <div class="mb-3 form-group col-md-3">
        <select class=" btn btn-dark form-select" name = "accountINTO" aria-label="into">
                        <option selected> Select an account to transfer INTO</option>
                        <?php foreach ($accounts as $account) : ?>
                    <li><option><?php se($account, "account"); ?></option></li>
                <?php endforeach; ?>
                
                    </select>
    </div>
</div>
<div class="mb-3 form-group col-md-3">
            <h2 label class="form-label text-dark" for="da" >Transfer Amount</h2>
            <input class="form-control" type="number" input type="number" min="0.01" step="0.01"  name="transfer"  id="da" aria-labelledby="da" required/>
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
        if(z === a){
            flash("Accounts must be different", "warning");
            return false;
        }
        if(z.length != 12 || a.length != 12){
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