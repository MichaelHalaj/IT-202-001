<?php
require(__DIR__ . "/../../partials/nav.php");
if(isset($_POST["save"])){
    $account = se($_POST, "account", "", false);
    if(strlen($account) === 27){
        flash("Please select an account", "warning");
    }else{
        echo var_export($account);
    }
}
$query = "SELECT account, account_type, balance from Bank_Accounts WHERE user_id = :uid";
$db = getDB();
$stmt = $db->prepare($query);
$accounts = [];
try{
    $stmt->execute([":uid" => get_user_id()]);
    $r = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if ($r) {
        $accounts = $r;
    }
} catch (PDOException $e) {
    flash(var_export($e->errorInfo, true), "danger");
}
?>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<div class = "container-fluid">
    <br>
    <form onsubmit="return validate(this)" method="POST">
    <div class = "row">
        <div class="mb-3 form-group col-md-3">
            <select class=" btn btn-dark form-select" name = "account" id = "account">
                        <option selected> Select an account to close</option>
                    <?php foreach ($accounts as $account) : ?>
                        <li><option class = "bal" value = "<?php se($account, "account");?>"><?php se($account, "account");?> ---- <?php se($account, "account_type"); ?> ---- <?php se($account, "balance"); ?></option></li>
                    <?php endforeach; ?>
                </select>
                <small id="minimums"  class="form-text text-warning"
                >In order to close an account, you must withdraw all funds from that account or pay off the loan.</small>
            </div>
            <div class="mb-3 form-group col-md-5">
                <h2 label class="form-label text-dark" for="da" id = "header" >Withdraw</h2>
            <input class="form-control" type="number" input type="number" min="0.01" step="0.01"  name="withdraw"  id="da" required/>
            </div>
    </div>

        <input type="submit" class="btn btn-success" value = "Close Account" name = "save"></input>
    </form>
</div>
<script>
    function validate(form) {
        let b = form.account.value;
        if(b == "Select an account to close"){
            flash("Please select an account to close", "warning");
            return false;
        }

        return true;
    }
    $("#account").click(function(){
       //var data = <?php echo json_encode($accounts, JSON_HEX_TAG); ?>;
      // let g = <?php echo json_encode($accounts);?>
      // $("#header").text(data);
       let p = $("#account option:selected").text();
       let z = p.substring(12);
       if(p.length !== 27){
            $("#header").text(p);
       }else{
        $("#header").text("Withdraw");
       }
       
    });
    var x = document.getElementsByClassName("bal");
    console.log(x.length);
       /* for(let i of x){
        let y = i.innerHTML;
        if(y < 0){
            y*=-1;
        }
        i.innerHTML = parseInt(y)/100;
        console.log(i.innerHTML);
    
    }*/
</script>
<?php
require(__DIR__ . "/../../partials/flash.php");
?>