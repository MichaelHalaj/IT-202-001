<?php
require(__DIR__ . "/../../partials/nav.php");

$result = [];
$db = getDB();


$col = se($_GET, "col", "deposit", false);
//echo var_export($col);

if(!in_array($col, ["desposit", "withdraw", "transfer"])){
    $col = "deposit";
}
$order = se($_GET, "order", "asc", false);
//allowed list
if (!in_array($order, ["asc", "desc"])) {
    $order = "asc"; //default value, prevent sql injection
}

//echo var_export($_SESSION["user"]["id"]);
$query = "SELECT id, src, dest, diff, typeTrans, memo, created FROM Bank_Account_Transactions WHERE (1=1)";
$params = [];
$account = se($_GET, "account", "" , false);
echo var_export($account);
if(strlen($account) === 12){
    $account = find_account($account);
    $query .= " AND (src = :src OR dest = :dest)";
    $params[":src"] = $account;
    $params[":dest"] = $account;
    //echo var_export($params);
}else{
   // $q = $db->prepare("SELECT id FROM Bank_Accounts WHERE user_id = :user_id");
            $q = $db->prepare("SELECT Bank_Accounts.id FROM Bank_Accounts JOIN Bank_Account_Transactions ON 
            Bank_Accounts.id = Bank_Account_Transactions.src WHERE Bank_Accounts.user_id = :user_id");
        $q->execute([":user_id" => get_user_id()]);
        $src = $q->fetchAll(PDO::FETCH_ASSOC);
        if($src){
            echo "YOOOOOOO";
            echo var_export($src);
        }
        else{
            echo "EEEEEEEEEEEEEEEEEEEE";
            
        }
        $q = $db->prepare("SELECT Bank_Accounts.id FROM Bank_Accounts JOIN Bank_Account_Transactions ON 
        Bank_Accounts.id = Bank_Account_Transactions.dest WHERE Bank_Accounts.user_id = :user_id");
        $q->execute([":user_id" => get_user_id()]);
        $src = $q->fetchAll(PDO::FETCH_ASSOC);
        if($src){
            echo "YOOOOOOO";
            echo var_export($src);
        }
        else{
            echo "EEEEEEEEEEEEEEEEEEEE";

        }
    /*$q =  $db->prepare("SELECT Bank_Accounts.id FROM Bank_Accounts JOIN Bank_Account_Transactions ON
    Bank_Accounts.id = Bank_Account_Transactions.src OR Bank_Accounts.id = Bank_Account_Transactions.dest 
    WHERE Bank_Accounts.id = :user_id"); */

     //echo var_export($result);
    /*
    $s = "SELECT id from Bank_Accounts WHERE user_id = :uid";
    $stmt = $db->prepare($s);
    $accountList = [];
    try{
        $stmt->execute([":uid" => get_user_id()]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($results) {
            $accountList = $results;
            echo var_export($accountList);
            //$query .= " AND (src in ({implode(',', $accountList)}) or dest in ({implode(',', $accountList)}))";
        }
    } catch (PDOException $e) {
        flash(var_export($e->errorInfo, true), "danger");
    } */
   // $query .= " AND ";
}

if(!empty($col)){
    $query .= " AND typeTrans = :typeTrans";
    $params[":typeTrans"] = $col;
}
if (!empty($order)) {
    $query .= " ORDER BY  typeTrans $order"; //be sure you trust these values, I validate via the in_array checks above
    //THIS IS PROBABLY NOT WORKING BECAUSE YOU NEED TO SPECIFY WHAT VARIABLE TO ORDER BY LIKE IN HIS EXAMPLE , IE  ORDER BY $col $order
}
//echo var_export($params);
$stmt = $db->prepare($query);
//echo var_export($query);
try {
    $stmt->execute($params); //dynamically populated params to bind
    $r = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if ($r) {
        $results = $r;
        echo var_export($results);
    }
} catch (PDOException $e) {
    flash("<pre>" . var_export($e, true) . "</pre>");
}
/*
$results = [];
$db = getDB();
//Sort and Filters
$col = se($_GET, "col", "cost", false);
//allowed list
if (!in_array($col, ["cost", "stock", "name", "created"])) {
    $col = "cost"; //default value, prevent sql injection
}
$order = se($_GET, "order", "asc", false);
//allowed list
if (!in_array($order, ["asc", "desc"])) {
    $order = "asc"; //default value, prevent sql injection
}
$name = se($_GET, "name", "", false);
//dynamic query
$query = "SELECT id, name, description, cost, stock, image FROM BGD_Items items WHERE 1=1 and stock > 0"; //1=1 shortcut to conditionally build AND clauses
$params = []; //define default params, add keys as needed and pass to execute
//apply name filter
if (!empty($name)) {
    $query .= " AND name like :name";
    $params[":name"] = "%$name%";
}
//apply column and order sort
if (!empty($col) && !empty($order)) {
    $query .= " ORDER BY $col $order"; //be sure you trust these values, I validate via the in_array checks above
}
$stmt = $db->prepare($query); //dynamically generated query
//$stmt = $db->prepare("SELECT id, name, description, cost, stock, image FROM BGD_Items WHERE stock > 0 LIMIT 50");
try {
    $stmt->execute($params); //dynamically populated params to bind
    $r = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if ($r) {
        $results = $r;
    }
} catch (PDOException $e) {
    flash("<pre>" . var_export($e, true) . "</pre>");
}
*/
$query = "SELECT account, account_type, balance from Bank_Accounts WHERE user_id = :uid";
$db = getDB();
$stmt = $db->prepare($query);
$accounts = [];
try{
    $stmt->execute([":uid" => get_user_id()]);
    $rr = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if ($rr) {
        $accounts = $rr;
    }
} catch (PDOException $e) {
    flash(var_export($e->errorInfo, true), "danger");
}
?>
<!--
<head>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
  <script>
  $( function() {
    $('#datepicker').datepicker({ dateFormat: 'yy-mm-dd' }).val();
  } );
  </script>
</head>
-->
<div class = "container-fluid">
<?php if (is_logged_in()) : ?>
<br> 
<form class="row row-cols-auto g-3 align-items-center">
   
    <div class="col">
            <div class="input-group">
                <select class=" btn btn-dark form-select" name = "account">
                <option selected> Select an account to filter</option>
                <?php foreach ($accounts as $account) : ?>
                    <li><option><?php se($account, "account"); ?></option></li>
                <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="col">
            <div class="input-group">
                <div class="input-group-text">Sort</div>
                <!-- make sure these match the in_array filter above-->
                <select class="form-control" name="col" value="<?php se($col); ?>">
                    <option value="deposit">Deposit</option>
                    <option value="withdraw">Withdraw</option>
                    <option value="transfer">Transfer</option>
                </select>
                <script>
                    //quick fix to ensure proper value is selected since
                    //value setting only works after the options are defined and php has the value set prior
                    document.forms[0].col.value = "<?php se($col); ?>";
                </script>
                <select class="form-control" name="order" value="<?php se($order); ?>">
                    <option value="asc">Up</option>
                    <option value="desc">Down</option>
                </select>
                <!--<input class="form-control" name="name" input type = "number" min = "1700" max = "2500" value="<?php echo date("Y")?>" placeholder="<?php echo date("Y")?>"/>
                <input class="form-control" name="name" input type = "number" min = "1" max = "12" value="<?php echo date("n")?>" placeholder="MM"/>
                <input class="form-control" name="name" input type = "number" min = "1" max = "31" value="<?php echo date("d")?>" placeholder="DD"/>
-->
                <div class = "form-control" name = "date">
                    <input type="datetime-local" id="date1" name="date1" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}T[0-9]{2}:[0-9]{2}">
                    <input type="datetime-local" id="date2" name="date2" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}T[0-9]{2}:[0-9]{2}">
                </div>
                <!--<p>Date: <input type="text" id="datepicker"></p> -->
                <script>
                    //quick fix to ensure proper value is selected since
                    //value setting only works after the options are defined and php has the value set prior
                    document.forms[0].order.value = "<?php se($order); ?>";
                </script>
            </div>
        </div>
        <div class="col">
            <div class="input-group">
                <input type="submit" class="btn btn-primary" value="Apply" onclick = "func()" />
            </div>
        </div>
        <table class=" table text-light">
                            <thead>
                                <th>Source</th>
                                <th>Destination</th>
                                <th>Amount</th>
                                <th>Type</th>
                                <th>Date</th>
                            </thead>
                            <tbody>
                            <?php if (empty($result)) : ?>
                                <tr>
                                    <td colspan="100%">No selected account</td>
                                </tr>
                                <?php else : ?>
                            <?php foreach ($result as $h) : ?>
                                <tr>
                                    <td><?php se($h, "src"); ?></td>
                                    <td><?php se($h, "dest"); ?></td>
                                    <td class = "bal"><?php se($h, "diff"); ?></td>
                                    <td><?php se($h, "typeTrans"); ?></td>
                                    <td><?php se($h, "created"); ?></td>
                                </tr>
                            <?php endforeach; ?> 
                            <?php endif; ?>
                            </table>
                            </tbody>
    </form>
  
</div>
</div>
                            <table class=" table text-light" id = "tbl">
                            <thead>
                                <th>Source</th>
                                <th>Destination</th>
                                <th>Amount</th>
                                <th>Type</th>
                                <th>Date</th>
                            </thead>
                            <tbody>
                            <?php if (empty($result)) : ?>
                                <tr>
                                    <td colspan="100%">No selected account</td>
                                </tr>
                                <?php else : ?>
                            <?php foreach ($result as $h) : ?>
                                <tr>
                                    <td><?php se($h, "src"); ?></td>
                                    <td><?php se($h, "dest"); ?></td>
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
    function func(){
 document.getElementById('tbl').style.display = 'block';
}
</script>
 

 

<?php
require(__DIR__ . "/../../partials/flash.php");
?>