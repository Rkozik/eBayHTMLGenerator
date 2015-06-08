<?php
$attributes = array('id'=>'login-topbar');
?>
<body>
<!-- Top Bar Navigation -->
<nav id="top-bar">
    <section class="one-half left">
        <a href="<?php echo base_url(); ?>" class="underline-off">
            <h1 class="cream-font">eBay &lt;html&gt; Generator</h1>
        </a>
    </section>
    <?php if(!isset($login_status) || $login_status==false): ?>
    <section class="one-half right">
        <?php echo form_open('user/login/',$attributes);?>
            <div id="login-topbar-container">
                <input type="text" id="login-username" class="left" name="username" value="username"/>
                <div id="divider-login" class="left"></div>
                <input type="password" id="login-password" class="left" name="password" value="password"/>
                <input type="submit" class="button-black left bold" id="submit-login" value="login"/>
            </div>
        <?php echo form_close(); ?>
    </section>
    <?php endif; ?>
    <?php if(isset($login_status) && $login_status==true): ?>
    <section class="one-half right">
        <?php if($currentPage!=="dashboard"): ?>
        <form name="user-dashboard" id="login-topbar" method="post" action="dashboard/">
            <input type="submit" class="right button-black bold" name="submit-login" value="My Account"/>
            <p class="right cream-font bold">Welcome back, <?php echo (strlen($username>12)?substr($username, 0, 12)."...":$username); ?></p>
        </form>
        <?php endif; ?>
        <?php if($currentPage=="dashboard"): ?>
            <?php echo form_open('user/logout/',$attributes);?>
                <input type="submit" class="right button-black bold" name="submit-login" value="Logout"/>
                <p class="right cream-font bold">Welcome back, <?php echo substr($username, 0, 12); ?></p>
            <?php echo form_close(); ?>
        <?php endif; ?>
    </section>
    <?php endif; ?>
</nav>
<div class="clearer"></div>
