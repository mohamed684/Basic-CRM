<h1>Login</h1>

<?php if($loginError): ?>

    <p style="color: red;">Username Or Password Not Correct!</p>

<?php endif ?>

<form action="index.php?<?php echo http_build_query(['route' => 'admin/login']) ?>" method="POST">
    <input type="hidden" name="_csrf" value="<?= csrf_token() ?>">
    <label for="username">Username:</label>
    <input type="text" name="username" id="username" value="<?php if(!empty($_POST['username'])) echo e($_POST['username']) ?>" required>

    <label for="password">Password</label>
    <input type="password" name="password" id="password" required>
    <br>
    <input type="submit" value="Login">
</form>