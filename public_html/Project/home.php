<?php
require(__DIR__ . "/../../partials/nav.php");
?>
<?php
if (is_logged_in()) {
   // echo "Welcome home, " . get_username();
    //comment this out if you don't want to see the session variables
   // echo "<pre>" . var_export($_SESSION, true) . "</pre>";
   //$email = get_user_email();
   update_APY();
} 
?>
<div class = "container-fluid">
<?php if (is_logged_in()) : ?>
        <h1>Welcome home, <?php echo get_username(); ?> </h1>
        <?php endif; ?>
    
        <?php if (is_logged_in()) : ?>
            <div class = "col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Account Creation</h5>
                    <p class="card-text">Create a savings or checking account with our streamlined process.</p>
                    <a class="btn btn-dark" href="<?php echo get_url('account.php'); ?>" role="button">Create Account</a>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">See Accounts</h5>
                    <p class="card-text">View all your accounts' balances and transaction history.</p>
                    <a class="btn btn-dark" href="<?php echo get_url('user_accounts.php'); ?>" role="button">My Accounts</a>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Deposit Funds</h5>
                    <p class="card-text">Deposit funds into any of your accounts.</p>
                    <a class="btn btn-dark" href="<?php echo get_url('deposit.php'); ?>" role="button" role="button">Deposit</a>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Withdraw Funds</h5>
                    <p class="card-text">Withdraw funds from any of your accounts.</p>
                    <a class="btn btn-dark" href="<?php echo get_url('withdraw.php'); ?>" role="button">Withdraw</a>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Transfer Locally</h5>
                    <p class="card-text">Transfer funds from one of your accounts to another.</p>
                    <a class="btn btn-dark" href="<?php echo get_url('transfer.php'); ?>" role="button">Transfer</a>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Transfer to Others</h5>
                    <p class="card-text">Transfer funds from one of your accounts to another user's account.</p>
                    <a class="btn btn-dark" href="<?php echo get_url('transferfunds.php'); ?>" role="button">Transfer</a>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Loan</h5>
                    <p class="card-text">Take advantage of our loans.</p>
                    <a class="btn btn-dark" href="<?php echo get_url('loan.php'); ?>" role="button">Loan</a>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Close Accounts</h5>
                    <p class="card-text">Close any of your eligible accounts.</p>
                    <a class="btn btn-dark" href="<?php echo get_url('close.php'); ?>" role="button">Close Account</a>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <img src="..." alt="...">
                    <h5 class="card-title">Manage Profile</h5>
                    <p class="card-text">View & Manage your profile.</p>
                    <a class="btn btn-dark" href="<?php echo get_url('profile.php'); ?>" role="button">Profile</a>
                </div>
            </div>
            </div>
        <?php endif; ?>
    
</div>

<?php
require(__DIR__ . "/../../partials/flash.php");
?>