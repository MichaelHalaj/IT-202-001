<?php
require(__DIR__ . "/../../partials/nav.php");
if(isset($_POST["save"])){
    $account = se($_POST, "save", null, false);
    $query = "SELECT diff, typeTrans, created from Bank_Account_Transactions where src = :src LIMIT 10";
    $db = getDB();
    $stmt = $db->prepare($query);
    try{
        $stmt->execute([":src" => find_account(($account))]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($results) {
            $history = $results;
        }
    } catch (PDOException $e) {
        flash(var_export($e->errorInfo, true), "danger");
    }
}
$query = "SELECT account, account_type, balance from Bank_Accounts WHERE user_id = :uid LIMIT 5";
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
<div class="container-fluid">
<?php if (is_logged_in()) : ?>    
<form onsubmit="return validate(this)" method="POST">
    <h1>Account list</h1>
    <table class = "table text-light">
        <thead>
            <th>Account number</th>
            <th>Account type</th>
            <th>Balance</th>
        </thead>
        <tbody>
        <?php if (empty($accounts)) : ?>
                <tr>
                    <td colspan="100%">No accounts</td>
                </tr>
                <?php else : ?>
                <?php foreach ($accounts as $account) : ?>
                    <tr>
                        <td><input name = "save" class="btn btn-secondary" value = <?php se($account, "account"); ?> type="submit" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                            </input></td>
                        <td><?php se($account, "account_type"); ?></td>
                        <td class = "bal"><?php se($account, "balance");?></td>


                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>

</form>
</table>
<?php if (empty($history)) : ?>
    <h1>Transaction History for No Account Shown</h1>
    <?php else : ?>
        <h1>Transaction History for <?php se($_POST, "save"); ?></h1>
    <?php endif; ?>
                            <table class=" table text-light">
                            <thead>
                                <th>Amount</th>
                                <th>Type</th>
                                <th>Date</th>
                            </thead>
                            <tbody>
                            <?php if (empty($history)) : ?>
                                <tr>
                                    <td colspan="100%">No selected account</td>
                                </tr>
                                <?php else : ?>
                            <?php foreach ($history as $h) : ?>
                                <tr>
                                
                                    <td class = "bal"><?php se($h, "diff"); ?></td>
                                    <td><?php se($h, "typeTrans"); ?></td>
                                    <td><?php se($h, "created"); ?></td>
                                </tr>
                            <?php endforeach; ?> 
                            <?php endif; ?>
                            </table>
                            </tbody>
                            <?php endif; ?> 
</div>
<script>
    function validate(form) {
        //TODO 1: implement JavaScript validation
        //ensure it returns false for an error and true for success

        return true;
    }

    var x = document.getElementsByClassName("bal");
        for(let i of x){
        let y = i.innerHTML;
        if(y < 0){
            y*=-1;
        }
        i.innerHTML = parseInt(y)/100;
        console.log(i.innerHTML);
    
    }


</script>
<?php
//(se($account, "balance")
require(__DIR__ . "/../../partials/flash.php");
?>