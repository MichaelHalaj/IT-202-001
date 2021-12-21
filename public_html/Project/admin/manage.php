<?php
//note we need to go up 1 more directory
require(__DIR__ . "/../../../partials/nav.php");

if (!has_role("Admin")) {
    flash("You don't have permission to view this page", "warning");
    die(header("Location: $BASE_PATH" . "home.php"));
}
if(isset($_POST["radio"])){
    $freeze = se($_POST, "radio", "", false);
    $account = se($_POST, "accountID", "",false);
    if(empty($account)){
        flash("No account selected", "warning");
    }else{
        if(empty($freeze)){
            $freeze = "false";
        }
        $query = "UPDATE Bank_Accounts SET frozen = :val WHERE id = :id";
        $db = getDB();
        $stmt = $db->prepare($query);
        try {
            $stmt->execute([":val" => $freeze, ":id" => $account]);
            flash("Successful action", "success");
        } catch (PDOException $e) {
            flash(var_export($e->errorInfo, true), "danger");
        }
    }

}
if(isset($_POST["account"])){
    $account = se($_POST, "account", "", false);
    $id = find_partial_account($account);
    $query = "SELECT account, account_type, balance, frozen from Bank_Accounts WHERE id = :id";
    $db = getDB();
    $stmt = $db->prepare($query);
    $accounts = [];
    try {
        $stmt->execute([":id" => $id]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($results) {
            $accounts = $results;
            $frozen = $accounts[0]["frozen"];
            //echo var_export($accounts[0]["frozen"]);
        } else {
            flash("No matches found", "warning");
        }
    } catch (PDOException $e) {
        flash(var_export($e->errorInfo, true), "danger");
    }
}
if(isset($_POST["username"])){
    $user = se($_POST, "username", "", false);
    echo var_export($user);
    $query = "SELECT id, username, is_active from Users WHERE username like :username LIMIT 1";
    $db = getDB();
    $stmt = $db->prepare($query);
    try {
        $stmt->execute([":username" => "%$user%"]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        //echo var_export($result);
        if ($result) {
            $userInfo = $result;
            $active = $userInfo["is_active"];
            echo var_export($active);
            echo var_export($userInfo);
        } else {
            flash("No matches found", "warning");
        }
    } catch (PDOException $e) {
        flash(var_export($e->errorInfo, true), "danger");
    }
}

?>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<div class = "container-fluid">
    <!--
<h1>Search User</h1>
    <form method="POST" class="row row-cols-lg-auto g-3 align-items-center">
        <div class="input-group mb-3">
            <input class="form-control" type="search" name="username" placeholder="Username" />
            <input class="btn btn-primary" type="submit" value="Search" />
        </div>
    </form>
    <table class = "table text-dark">
        <thead>
            <th>ID</th>
            <th>Username</th>
            <th>Open Account</th>
            <th>Active</th>
        </thead>
        <tbody>
        <?php if (empty($userInfo)) : ?>
                <tr>
                    <td colspan="100%" >No info</td>
                </tr>
            <?php else : ?>
                    <tr>
                        <td><?php se($userInfo, "id"); ?></td>
                        <td><?php se($userInfo, "username"); ?></td>
                        <td>

                        </td>
                        <td>
                        <form method = "POST">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="radio" value = "active" id="active">
                                        <label class="form-check-label" for="Active">
                                            Active
                                        </label>
                                </div>
                                <div class="form-check">
                                        <input class="form-check-input" type="radio" name="radio" value = "inactive" id="inactive">
                                        <label class="form-check-label" for="Inactive">
                                            Inactive
                                        </label>
                                        <?php if (isset($id) && !empty($id)) : ?>
                                    <input type="hidden" name="accountID" value="<?php se($id, null); ?>" />
                                <?php endif; ?>
                        </td>
                    </tr>
                <?php endif; ?>
        </tbody>
    </table> -->
<h1>Search Account</h1>
    <form method="POST" class="row row-cols-lg-auto g-3 align-items-center">
        <div class="input-group mb-3">
            <input class="form-control" type="search" name="account" placeholder="Account" />
            <input class="btn btn-primary" type="submit" value="Search" />
        </div>
    </form>
    <table class = "table text-dark">
        <thead>
            <th>Account</th>
            <th>Type</th>
            <th>Balance</th>
            <th>Freeze</th>
        </thead>
        <tbody>
        <?php if (empty($accounts)) : ?>
                <tr>
                    <td colspan="100%" >No info</td>
                </tr>
            <?php else : ?>
                <?php foreach($accounts as $i) : ?>
                    <tr>
                        <td><?php se($i, "account"); ?></td>
                        <td><?php se($i, "account_type"); ?></td>
                        <td class ="bal"><?php se($i, "balance"); ?></td>
                        <td>
                            <form method = "POST">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="radio" value = "true" id="true">
                                        <label class="form-check-label" for="True">
                                            True
                                        </label>
                                </div>
                                <div class="form-check">
                                        <input class="form-check-input" type="radio" name="radio" value = "false" id="false">
                                        <label class="form-check-label" for="False">
                                            False
                                        </label>
                                        <?php if (isset($id) && !empty($id)) : ?>
                                    <input type="hidden" name="accountID" value="<?php se($id, null); ?>" />
                                <?php endif; ?>

                            </div>

                        </td>
                    </tr>
                <?php endforeach ?>
            <?php endif ?>
        </tbody>
    </table>
    <input class="btn btn-danger" type="submit" value="Confirm" />
                            </form>
</div>
<script>
        var x = document.getElementsByClassName("bal");
        for(let i of x){
        let y = i.innerHTML;

        i.innerHTML = parseInt(y)/100;
        console.log(i.innerHTML);
    
    }
    var data = <?php echo json_encode($frozen, JSON_HEX_TAG); ?>;
    $('#' + data).prop('checked', true);

</script>
<?php
//note we need to go up 1 more directory
require_once(__DIR__ . "/../../../partials/flash.php");
?>