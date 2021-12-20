<?php
require(__DIR__ . "/../../partials/nav.php");
if(is_logged_in()){
    if(isset($_POST["save"])){
        $account1 = se($_POST, "account", "", false);
        $account2 = se($_POST, "account2", "", false);
        $accountType1 = substr($account1,12);
        $accountType2 = substr($account2,12);
        $account1 = substr($account1,0,12);
        $account2 = substr($account2,0,12);
        $bal1 = get_balance($account1);
        $ac1ID = find_account($account1);
     
        //echo var_export($accountType1);
    
        $Amount = se($_POST, "withdraw", "", false);
        $Amount *= 100;
        $db = getDB();
       // echo var_export($Amount);
        if(strlen($account1) === 27){
            flash("Please select an account", "warning");
        }else{
            if($accountType1 === "loan"){
                $ac2ID = find_account($account2);
                $bal2 = get_balance($account2);
                echo var_export($bal2);
                if($bal2 - ($Amount) < 0){
                    flash("Insufficient funds to transfer" , "warning");
                }else{
                    if($bal1 - $Amount !== 0){
                        flash("Must transfer exact amount in order to close account" , "warning");
                    }else{
                        if($bal1 - $Amount === 0){
                            transaction($Amount/100,"transfer", $ac2ID, -1, "close");
                            transaction($Amount/100,"transfer", $ac1ID, -1, "close");
                            flash("Successful transfer and closing" , "success");
                            $query= "UPDATE Bank_Accounts set active = :false WHERE id = :id";
                            $stmt = $db->prepare($query);
                            try {
                                $stmt->execute([":false" => "false", ":id" => $ac1ID]);
                                
                            } catch (PDOException $e) {
                                flash("Error refreshing account: " . var_export($e->errorInfo, true), "danger");
                            }
                            die(header('Location: user_accounts.php'));
                        }
                    }
                }
            }else{
                if($accountType1 !== "loan"){
                    if($bal1 - ((int)$Amount) == 0){
                        transaction($Amount/100, "withdraw", find_account($account1), -1, "withdraw and close");
                        flash("Successful withdrawal" , "success");
                        $query= "UPDATE Bank_Accounts set active = :false WHERE id = :id";
                        $stmt = $db->prepare($query);
                        try {
                            $stmt->execute([":false" => "false", ":id" => $ac1ID]);
                            
                        } catch (PDOException $e) {
                            flash("Error refreshing account: " . var_export($e->errorInfo, true), "danger");
                        }
                        die(header('Location: user_accounts.php'));
                        //echo var_export(get_balance($account)>= $withdrawAmount);
                       

                       // die(header('Location: home.php'));
                       
                    }else{
                        if($bal1 - $Amount > 0){
                            flash("Must transfer exact amount in order to close account", "warning");
                        }
                        else{
                            flash("Insufficent funds to withdraw", "warning");
                        }
                    }
                }else{
                    flash("Please select an account to transfer loans", "warning");
                } 
                
            }
            //echo var_export($account);
    
        }
    }
    $query = "SELECT account, account_type, balance from Bank_Accounts WHERE user_id = :uid AND active = :true";
    $db = getDB();
    $stmt = $db->prepare($query);
    $accounts = [];
    try{
        $stmt->execute([":uid" => get_user_id(), ":true" => "true"]);
        $r = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($r) {
            $accounts = $r;
        }
    } catch (PDOException $e) {
        flash(var_export($e->errorInfo, true), "danger");
    }
    $query = "SELECT account, account_type, balance from Bank_Accounts WHERE user_id = :uid AND account_type <> :loan";
    $db = getDB();
    $stmt = $db->prepare($query);
    $accounts2 = [];
    try{
        $stmt->execute([":uid" => get_user_id(), ":loan" => "loan"]);
        $r = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($r) {
            $accounts2 = $r;
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
<?php if (is_logged_in()) : ?>
    <br>
    <form onsubmit="return validate(this)" method="POST">
    <div class = "row">
        <div class="mb-3 form-group col-md-3">
            <select class=" btn btn-dark form-select" name = "account" id = "account">
                        <option selected> Select an account to close</option>
                    <?php foreach ($accounts as $account) : ?>
                        <li><option class = "bal" value = "<?php [se($account, "account"), se($account, "account_type")];?>"><?php se($account, "account");?> ---- <?php se($account, "account_type"); ?> ---- $<?php se($account, "balance"); ?></option></li>
                        
                    <?php endforeach; ?>
                </select>
                <small id="minimums"  class="form-text text-warning"
                >In order to close an account, you must withdraw all funds from that account or pay off the loan.</small>
            </div>
            <div class="mb-3 form-group col-md-4">
            <select class=" btn btn-dark form-select" name = "account2" id = "account2">
                        <option selected> Select an account to transfer funds to loan account</option>
                    <?php foreach ($accounts2 as $account) : ?>
                        <li><option class = "bal" value = "<?php [se($account, "account"), se($account, "account_type")];?>"><?php se($account, "account");?> ---- <?php se($account, "account_type"); ?> ---- $<?php se($account, "balance"); ?></option></li>
                        
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3 form-group col-md-4">
                <h2 label class="form-label text-dark" for="da" id = "header" >Enter Amount:</h2>
            <input class="form-control" type="number" input type="number" min="0.01" step="0.01"  name="withdraw"  id="da" required/>
            </div>
    </div>

        <input type="submit" class="btn btn-success" value = "Close Account" name = "save"></input>
    </form>
    <?php endif; ?>
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
    $("#account2").hide();
    $("#account").click(function(){
       //var data = <?php echo json_encode($accounts, JSON_HEX_TAG); ?>;
      // let g = <?php echo json_encode($accounts);?>
      // $("#header").text(data);
       let p = $("#account option:selected").text();
       let z = p.substring(12);
       let result = p.includes("loan");
       
       if(p.length !== 27){
           if(result){
                $("#header").text("Deposit into loan account: " + p);
                $("#account2").show();
           }else{
               $("#header").text("Withdraw from account: " + p);
               $("#account2").hide();
           }
            
       }else{
        $("#header").text("Enter Amount");
       }
       
    });
    var x = document.getElementsByClassName("bal");
    var data = <?php echo json_encode($accounts, JSON_HEX_TAG); ?>;
    console.log(data[0]["balance"]);
    for(let i of x){
        let y = i.innerHTML;
        for(let d = 0; d < data.length; d++){
           // console.log(y.includes(data[d]["account"]));
           // console.log(y.includes("loan"));
            if(y.includes(data[d]["account"]) && y.includes("loan")){
                i.innerHTML = y.substring(0,29) + parseInt(data[d]["balance"])/100; 
            }else{
                if(y.includes(data[d]["account"]) && y.includes("savings")){
                    i.innerHTML = y.substring(0,32) + parseInt(data[d]["balance"])/100; 
            }else{
                if(y.includes(data[d]["account"]) && y.includes("checking")){
                    i.innerHTML = y.substring(0,33) + parseInt(data[d]["balance"])/100;
                }
            }
        }
        }

    }

</script>
<?php
require(__DIR__ . "/../../partials/flash.php");
?>