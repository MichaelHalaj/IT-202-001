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
$query = "SELECT account, account_type, balance, active from Bank_Accounts WHERE user_id = :uid  and active = :true LIMIT 5";
$db = getDB();
$stmt = $db->prepare($query);
$accounts = [];
try{
    $stmt->execute([":uid" => get_user_id(), ":true" => "true"]);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if ($results) {
        $accounts = $results;
    }
} catch (PDOException $e) {
    flash(var_export($e->errorInfo, true), "danger");
}
$queryAPY = "SELECT APY from System_Properties WHERE APY = :APY";
        $stmt = $db->prepare($queryAPY);
        try{
            $stmt->execute([":APY" => 1]);
            $APY = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            flash(var_export($e->errorInfo, true), "danger");
        }

?>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<div class="container-fluid">

<?php if (is_logged_in()) : ?>    
<form onsubmit="return validate(this)" method="POST">
    <h1>Account list</h1>
    <table class = "table text-light">
        <thead>
            <th>Account number</th>
            <th>Account type</th>
            <th>Balance</th>
            <th>APY</th>
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
                        <td id = "APY" class = "APY">-</td>

                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>

</form>
</table>
<div class = "row">
<div class="mb-3 col-md-9">
<?php if (empty($history)) : ?>
    <h1>Transaction History for No Account Shown</h1>
    <?php else : ?>
        <h1>Transaction History for <?php se($_POST, "save"); ?></h1>
    <?php endif; ?>
</div>
<div class="mb-3 col-md-3">
    <a class="btn btn-dark" href="<?php echo get_url('transactions.php'); ?>" role="button">More details</a>
</div>
</div>

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
    var data = <?php echo json_encode($APY, JSON_HEX_TAG); ?>;
    let a = data['APY'];
    var accounts =  <?php echo json_encode($accounts, JSON_HEX_TAG); ?>;
    let r = document.getElementsByClassName("APY");
    let d = 0;
    for(let y of r){
        console.log(accounts[d]["account_type"]);
        let u = y.innerHTML;
        er = accounts[d]["account_type"];
        if(er === "savings" || er == "loan"){
            y.innerHTML = (a/10) + "%";
        }else{
            y.innerHTML = "-";
        }
        
        //console.log(u);
        d++;
    }
</script>
<?php
//(se($account, "balance")
require(__DIR__ . "/../../partials/flash.php");
?>