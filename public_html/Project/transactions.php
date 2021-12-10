<?php
require(__DIR__ . "/../../partials/nav.php");


$total_query = "SELECT count(1) as total FROM Bank_Account_Transactions t WHERE 1=1";
$base_query = "SELECT t.id, t.diff, t.typeTrans, t.memo, t.created /*IF(a2.account = '0', 'system', a2.account) as 'account' */ FROM Bank_Account_Transactions t JOIN 
Bank_Accounts a1 on a1.id = t.src JOIN Bank_Accounts a2 on a2.id = t.dest WHERE 1=1";


$account = se($_GET, "account", "" , false);
$account = find_account($account);

$type = se($_GET, "type", null, false);
$start = se($_GET, "date1", date("Y-m-d", strtotime("-1 month")));
$end = se($_GET, "date2", date("Y-m-d"), false);
$order = se($_GET, "order", "asc", false);
$params = [];
if (!in_array($order, ["asc", "desc"])) {
    $order = "asc"; //default value, prevent sql injection
}

if($start){
    $total_query .= " AND t.created >= :start";
    $base_query .= " AND t.created >= :start";
    $params[":start"] = $start;
}
if($end){
    $total_query .= " AND t.created <= :end";
    $base_query .= " AND t.created <= :end";
    $params[":end"] = date("Y-m-d 23:59:59", strtotime($end));
}
if($type && $type !== "none"){
    $total_query .= " AND typeTrans = :typeTrans";
    $base_query .= " AND typeTrans = :typeTrans";
    $params[":typeTrans"] = $type;
}
$total_query .= " AND src = :src";
$base_query .= " AND src = :src";
$params[":src"] = $account;

$sort = se($_GET, "sort", "", false);
switch($sort){
    case "+date":
        $total_query .= " ORDER BY created asc";
        $base_query .= " ORDER BY created asc";
        break;
    case "-date":
        $total_query .= " ORDER BY created desc";
        $base_query .= " ORDER BY created desc";
        break;
    case "+change":
        $total_query .= " ORDER BY diff asc";
        $base_query .= " ORDER BY diff asc";
        break;
    case "-change":
        $total_query .= " ORDER BY diff desc";
        $base_query .= " ORDER BY diff desc";
        break;
}
$records_per_page = 10;
$total_records = 0;
$db = getDB();
$stmt = $db->prepare($total_query);
try{
    $stmt->execute($params);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if($result){
        $total_records = se($result, "total", 0, false);
    }
}catch(PDOException $e){
    flash("<pre>" . var_export($e, true) . "</pre>");
}

$page = se($_GET, "page", 1, false);
if($page < 1){
    $page = 1;
}

$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

$offset = ($page -1) * $records_per_page;
$base_query .= " LIMIT :offset, :limit";
$result = [];

$stmt = $db->prepare($base_query);
try{
    $params[":offset"] = $offset;
    $params[":limit"] = $records_per_page;
    $stmt->execute($params);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
}catch (PDOException $e){
    flash("<pre>" . var_export($e, true) . "</pre>");
}
$total_pages = ceil($total_records/$records_per_page);
echo var_export($results);
$options = [];
$query = "SELECT DISTINCT typeTrans from Bank_Account_Transactions";
$stmt = $db->prepare($query);
try{
    $stmt->execute();
    $r = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if($r){
        $options = $r;
        echo var_export($options);
    }
}catch(PDOException $e){
    flash("<pre>" . var_export($e, true) . "</pre>");
}
$query = "SELECT account, account_type, balance from Bank_Accounts WHERE user_id = :uid";
$stmt = $db->prepare($query);
$accounts= [];
try{
    $stmt->execute([":uid" => get_user_id()]);
    $rr = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if ($rr) {
        $accounts = $rr;
    }
}catch (PDOException $e){
    flash(var_export($e->errorInfo, true), "danger");
}
//echo var_export($accounts);
//get the total
/*
$stmt = $db->prepare($total_query . $query);
$total = 0;
try {
    $stmt->execute($params);
    $r = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($r) {
        $total = (int)se($r, "total", 0, false);
    }
} catch (PDOException $e) {
    flash("<pre>" . var_export($e, true) . "</pre>");
} */
/*
//apply the pagination (the pagination stuff will be moved to reusable pieces later)
$page = se($_GET, "page", 1, false); //default to page 1 (human readable number)
$per_page = 10; //how many items to show per page (hint, this could also be something the user can change via a dropdown or similar)
$offset = ($page - 1) * $per_page;
$query .= " LIMIT :offset, :count";
$params[":offset"] = $offset;
$params[":count"] = $per_page;
//get the records
$stmt = $db->prepare($base_query . $query); //dynamically generated query
//we'll want to convert this to use bindValue so ensure they're integers so lets map our array
foreach ($params as $key => $value) {
    $type = is_int($value) ? PDO::PARAM_INT : PDO::PARAM_STR;
    $stmt->bindValue($key, $value, $type);
}
$params = null; //set it to null to avoid issues

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
*/
?>

<div class = "container-fluid">
<?php if (is_logged_in()) : ?>
    <br>
    <div>
        <form>
        <select class=" btn btn-dark form-select" name = "account">
                    <option selected> Select an account to see transaction history</option>
                <?php foreach ($accounts as $account) : ?>
                    <li><option><?php se($account, "account"); ?></option></li>
                <?php endforeach; ?>
            </select>
            <div class = "input-group mb-3">
           <!--     <span class = "input-group-text" id = "account">Account</span>
                <select class = "form-control" name = "type" aria-label = "account" aria-describedby="account"> -->
                <span class = "input-group-text" id = "date1">Start</span>
                <input name = "date1" type = date class = "form-control" placeholder = "mm/dd/yyyy" aria-label="start date" aria-describedby="start-date" value = "<?php se($start)?>">
                <span class = "input-group-text" id = "date2">End</span>
                <input name = "date2" type = date class = "form-control" placeholder = "mm/dd/yyyy" aria-label="end date" aria-describedby="end-date" value = "<?php se($end)?>">
                <span class = "input-group-text" id = "filter">Transaction Type</span>
                <select class = "form-control" name = "type" aria-label = "filter" aria-describedby="filter">
                    <option value = "none">None</option>
                    <option value = "transfer">Transfer</option>
                    <option value = "deposit">Deposit</option>
                    <option value = "withdraw">Withdrawal</option>
                </select>
                <span class = "input-group-text" id = "sort">Sort</span>
                <select class = "form-control" name = "sort" aria-label="sort" aria-describedby="sort">
                    <option value = "-date">Created New to Old</option>
                    <option value = "+date">Created Old to New</option>
                    <option value = "-change">Change High to Low</option>
                    <option value = "+change">Change Low to High</option>
                </select>
               
            </div>
            <input type = "submit" class = "btn btn-success" value = "Filter"/>
        </form>
    </div>

    <?php endif?>
    <table class=" table text-light">
                            <thead>
                                <th>Account</th>
                            
                                <th>Amount</th>
                                <th>Type</th>
                                <th>Memo</th>
                                <th>Date</th>
                            </thead>
                            <tbody>
                            <?php if (empty($results)) : ?>
                                <tr>
                                    <td colspan="100%">No data</td>
                                </tr>
                                <?php else : ?>
                            <?php foreach ($results as $h) : ?>
                                <tr>
                                    <td><?php find_account(se($h, "src"))?></td>
                                    <td class = "bal"><?php se($h, "diff"); ?></td>
                                    <td><?php se($h, "typeTrans"); ?></td>
                                    <td><?php se($h, "memo");?></td>
                                    <td><?php se($h, "created"); ?></td>
                                </tr>
                            <?php endforeach; ?> 
                            <?php endif; ?>
                            </table>
                            </tbody>
</div>
<div>
    <?php if(!isset($page)){
        $page =1;}
        
        if(!isset($total_pages)){
            $total_pages =1;   
        }?>
        <ul class = "pagination">
            <li class = "page-item <?php if (($pafe -1) < 1) echo 'disabled';?>">
                <a class = "page-link" href = "?<?php pagination_filter($page -1); ?>">Previous</a>
            </li>
            <?php for($i = 1; $i <= $total_pages; $i++) ?>
                <li class = "page item <?php if ($page == $i) echo 'active'; ?>">
                <a class = "page-link" href = "?<?php pagination_filter($i);?>">
                    <?php se($i); ?></a>
            </li>
            <li class = "page-item <?php if(($page + 1) > $total_pages) echo 'disabled';?> ">
                <a class = "page-link" href = "?<?php pagination_filter($page + 1); ?>">Next</a>
            </li>    
        </ul>
</div>
<?php
require(__DIR__ . "/../../partials/flash.php");
?>