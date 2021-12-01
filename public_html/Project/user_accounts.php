<?php
require(__DIR__ . "/../../partials/nav.php");

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
                        <td><?php se($account, "account"); ?></td>
                        <td><?php se($account, "account_type"); ?></td>
                        <td class = "bal"><?php se($account, "balance");?></td>
                        <td>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<script>
    /*$(document).ready(function(){
        //$("div").html
        $("div").text(100)
    }) */
    var x = document.getElementsByClassName("bal");
    for(let i of x){
        let y = i.innerHTML;
        i.innerHTML = parseInt(y)/100;
        console.log(i.innerHTML);
    }

</script>
<?php
//(se($account, "balance")
require(__DIR__ . "/../../partials/flash.php");
?>