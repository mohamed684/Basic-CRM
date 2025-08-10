<h1>Create New Page</h1>

<?php if (!empty($errors)): ?>
    <?php foreach ($errors as $err): ?>
        <p style="color: red;"><?= htmlspecialchars($err) ?></p>
    <?php endforeach; ?>
<?php endif; ?>


<form method="POST" action="index.php?route=admin/pages/create">

    <input type="hidden" name="_csrf" value="<?= csrf_token() ?>">

    <label for="title">Title:</label>
    <input type="text" name="title" id="title" required>

    <label for="slug">Slug:</label>
    <input type="text" name="slug" id="slug" required>

    <label for="content">Content:</label>
    <textarea type="text" name="content" id="content" rows="10" required></textarea>

    <input type="submit" value="Submit">

</form>