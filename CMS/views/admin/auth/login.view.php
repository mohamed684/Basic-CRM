<h1>Login</h1>

<form action="index.php?<?php echo http_build_query(['route' => 'admin/login']) ?>" method="POST">
    <label for="username">Username:</label>
    <input type="text" name="username" id="username" value="<?php if(!empty($_POST['username'])) echo e($_POST['username']) ?>">

    <label for="password">Password</label>
    <input type="password" name="password" id="password">
    <br>
    <input type="submit" value="Login">
</form>