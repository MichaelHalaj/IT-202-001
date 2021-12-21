<?php
//note we need to go up 1 more directory
require(__DIR__ . "/../../../partials/nav.php");

if (!has_role("Admin")) {
    flash("You don't have permission to view this page", "warning");
    die(header("Location: $BASE_PATH" . "home.php"));
}
$query = "SELECT src, dest, diff, typeTrans, memo, created from Bank_Account_Transactions";
$params = null;
if(isset($_POST["account"])){
    $account = se($_POST, "account", "", false);
    $id = find_partial_account($account);
    $query .= " WHERE src = :src";
    $params = [":src" => $id];
}
$query .= " ORDER BY created desc LIMIT 10";
$db = getDB();
$stmt = $db->prepare($query);
$accounts = [];
try {
    $stmt->execute($params);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if ($results) {
        $accounts = $results;

    } else {
        flash("No matches found", "warning");
    }
} catch (PDOException $e) {
    flash(var_export($e->errorInfo, true), "danger");
}


$query = "SELECT id, email, username, firstName, lastName, visibility from Users";
$params = null; 
if (isset($_POST["first"]) && isset($_POST["last"])) {
    $first = se($_POST, "first", "", false);
    $last = se($_POST, "last", "", false);
    $query .= " WHERE firstName LIKE :first AND lastName like :last";
    $params =  [":first" => "%$first%", ":last" => "%$last%"];
}
$query .= " ORDER BY modified desc LIMIT 10";
$db = getDB();
$stmt = $db->prepare($query);
$info = [];
try {
    $stmt->execute($params);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if ($results) {
        $info = $results;
        /*
        foreach($info as $o){
            if($o["visibility"] == "public"){
                $o["email"] = "";
                echo var_export($o["email"]);
            }
        }*/

    } else {
        flash("No matches found", "warning");
    }
} catch (PDOException $e) {
    flash(var_export($e->errorInfo, true), "danger");
}

?>
<div class="container-fluid">
    <h1>Search Users</h1>
    <form method="POST" class="row row-cols-lg-auto g-3 align-items-center">
        <div class="input-group mb-3">
            <input class="form-control" type="search" name="first" placeholder="First Name" />
            <input class="form-control" type="search" name="last" placeholder="Last Name" />
            <input class="btn btn-primary" type="submit" value="Search" />
        </div>
    </form>
    <table class = "table text-dark">
        <thead>
            <th>ID</th>
            <th>Email</th>
            <th>UserName</th>
            <th>First Name</th>
            <th>Last Name</th>
        </thead>
        <tbody>
        <?php if (empty($info)) : ?>
                <tr>
                    <td colspan="100%" >No info</td>
                </tr>
            <?php else : ?>
                <?php foreach($info as $i) : ?>
                    <tr>
                        <td><?php se($i, "id"); ?></td>
                        <?php if($i["visibility"] == "public"): ?>
                            <td><?php se($i, "email"); ?></td>
                        <?php else :?>
                            <td>PRIVATE</td>
                        <?php endif; ?>
                        <td><?php  se($i, "username"); ?></td>
                        <td><?php se($i, "firstName"); ?></td>
                        <td><?php se($i, "lastName"); ?></td>
                    </tr>
                <?php endforeach ?>
            <?php endif ?>
        </tbody>
    </table>
    <h1>Search Account History</h1>
    <form method="POST" class="row row-cols-lg-auto g-3 align-items-center">
        <div class="input-group mb-3">
            <input class="form-control" type="search" name="account" placeholder="Account" />
            <input class="btn btn-primary" type="submit" value="Search" />
        </div>
    </form>

    <table class ="table text-dark">
    <thead>
            <th>ID</th>
            <th>Balance</th>
            <th>Type of Transaction</th>
            <th>Memo</th>
            <th>Date Created</th>
        </thead>
        <tbody>
        <?php if (empty($accounts)) : ?>
                <tr>
                    <td colspan="100%" >No info</td>
                </tr>
            <?php else : ?>
                <?php foreach($accounts as $i) : ?>
                    <tr>
                        <td><?php se($i, "src"); ?></td>
                        <td class ="bal"><?php se($i, "diff"); ?></td>
                        <td><?php  se($i, "typeTrans"); ?></td>
                        <td><?php se($i, "memo"); ?></td>
                        <td><?php se($i, "created"); ?></td>
                    </tr>
                <?php endforeach ?>
            <?php endif ?>
        </tbody>
    </table>
</div>
<script>
        var x = document.getElementsByClassName("bal");
        for(let i of x){
        let y = i.innerHTML;

        i.innerHTML = parseInt(y)/100;
        console.log(i.innerHTML);
    
    }

</script>

<?php
//note we need to go up 1 more directory
require_once(__DIR__ . "/../../../partials/flash.php");
?>