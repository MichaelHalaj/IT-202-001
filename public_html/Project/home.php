<?php
require(__DIR__ . "/../../partials/nav.php");
?>
<?php
if (is_logged_in()) {
   // echo "Welcome home, " . get_username();
    //comment this out if you don't want to see the session variables
   // echo "<pre>" . var_export($_SESSION, true) . "</pre>";
} 
?>
<div class = "container-fluid">
<?php if (is_logged_in()) : ?>
        <h1>Welcome home, <?php echo get_username(); ?> </h1>
        <?php endif; ?>
    <div class = "col">
        <?php if (is_logged_in()) : ?>
            <a class="btn btn-dark" href="<?php echo get_url('account.php'); ?>" role="button">Create Account</a>
            <a class="btn btn-dark" href="<?php echo get_url('user_accounts.php'); ?>" role="button">My Accounts</a>
            <a class="btn btn-dark" href="<?php echo get_url('deposit.php'); ?>" role="button" role="button">Deposit</a>
            <a class="btn btn-dark" href="<?php echo get_url('withdraw.php'); ?>" role="button">Withdraw</a>
            <a class="btn btn-dark" href="#" role="button">Transfer</a>
            <a class="btn btn-dark" href="<?php echo get_url('profile.php'); ?>" role="button">Profile</a>
        <?php endif; ?>
    </div>
</div>

<?php
require(__DIR__ . "/../../partials/flash.php");
?>