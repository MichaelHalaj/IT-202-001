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



if (isset($_POST["first"]) && isset($_POST["last"])) {
    $query = "SELECT id, email, username, firstName, lastName, visibility ,is_active from Users";
    $params = null; 
    $first = se($_POST, "first", "", false);
    $last = se($_POST, "last", "", false);
    $query .= " WHERE firstName LIKE :first AND lastName like :last";
    $params =  [":first" => "%$first%", ":last" => "%$last%"];
        $query .= " ORDER BY modified desc LIMIT 1";
    $db = getDB();
    $stmt = $db->prepare($query);
    $info = [];
    try {
        $stmt->execute($params);
        $results = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($results) {
            $info = $results;
            $active = $info["is_active"];
            $user = $info["id"];
           // echo var_export($user);
            //echo var_export($active);
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
    }
    if(isset($_POST["radio"])){
        $account = se($_POST, "radio", "", false);
        //echo var_export($account);
        $userID = se($_POST, "user", "", false);
        //echo var_export($userID);
        if(empty($account)){
            $account = "checking";
        }elseif(empty($userID)){
            flash("No user selected", "warning");
        }else{
            create_account_admin($account, $userID);
            flash("Created " . $account . " account for ID ->" . $userID, "success");
        } 
        
    }
    if(isset($_POST["radio1"])){
        $userID = se($_POST, "user1", "", false);
        $activate = se($_POST, "radio1", "", false);
        if(empty($activate)){
            flash("No selection made on active column", "warning");
        }elseif(empty($userID)){
            flash("No user selected", "warning");
        }else{
            $query = "UPDATE Users set is_active = :is_active where id = :id";
            $stmt = $db->prepare($query);
            try {
                $stmt->execute([":is_active" => $activate, ":id" => $userID]);
                flash("ID -> " . $userID . " has been deactived", "info");
            } catch (PDOException $e) {
                flash(var_export($e->errorInfo, true), "danger");
            }
        }
    }


?>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
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
            <th>Open Account</th>
            <th>Active</th>
        </thead>
        <tbody>
        <?php if (empty($info)) : ?>
                <tr>
                    <td colspan="100%" >No info</td>
                </tr>
            <?php else : ?>
               
                    <tr>
                        <td><?php se($info, "id"); ?></td>
                        <?php if($info["visibility"] == "public"): ?>
                            <td><?php se($info, "email"); ?></td>
                        <?php else :?>
                            <td>PRIVATE</td>
                        <?php endif; ?>
                        <td><?php  se($info, "username"); ?></td>
                        <td><?php se($info, "firstName"); ?></td>
                        <td><?php se($info, "lastName"); ?></td>
                        <td>
                            <form method = "POST">

                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="radio" value = "checking" id="checking" checked>
                                        <label class="form-check-label" for="Checking">
                                            Checking
                                        </label>
                                </div>
                                <div class="form-check">
                                        <input class="form-check-input" type="radio" name="radio" value = "savings" id="savings">
                                        <label class="form-check-label" for="Savings">
                                            Savings
                                        </label>
                                            <?php if (isset($user) && !empty($user)) : ?>
                                                <input type="hidden" name="user" value="<?php se($user, null); ?>" />
                                            <?php endif; ?>
                                <br>
                                <br>
                                <input class="btn btn-success" type="submit" value="Create Account" />
                                    </div>
                            </form>
                        </td>
                        <td>
                        <form method = "POST">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="radio1" value = "true" id="true" checked>
                                        <label class="form-check-label" for="True">
                                            True
                                        </label>
                                </div>
                                <div class="form-check">
                                        <input class="form-check-input" type="radio" name="radio1" value = "false" id="false">
                                        <label class="form-check-label" for="False">
                                            False
                                        </label>
                                        <?php if (isset($user) && !empty($user)) : ?>
                                    <input type="hidden" name="user1" value="<?php se($user, null); ?>" />
                                <?php endif; ?>
                                <br>
                                <br>
                                <input class="btn btn-danger" type="submit" value="Confirm" />
                        </form>
                        </td>
                        </td>
                    </tr>
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
    
    }/*
    var data = <?php echo json_encode($active, JSON_HEX_TAG); ?>;
    //console.log(data);
    if(data == "true"){
        $('#active').prop('checked', true);
    }else{
        $('#inactive').prop('checked', true);
    }*/
    
</script>

<?php
//note we need to go up 1 more directory
require_once(__DIR__ . "/../../../partials/flash.php");
?>