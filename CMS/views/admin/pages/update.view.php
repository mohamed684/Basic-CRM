<h1>Update <?php if(!empty($page->title)): ?> <?= ':' . e( $page->title) ?> <?php endif ?></h1>

<?php if (!empty($errors)): ?>
    <?php foreach ($errors as $err): ?>
        <p style="color: red;"><?= htmlspecialchars($err) ?></p>
    <?php endforeach; ?>
<?php endif; ?>


<form method="POST" action="index.php?route=admin/pages/update">
    <input type="hidden" name="_csrf" value="<?= csrf_token() ?>">
    <input type="hidden" name="id" value="<?php if(!empty($page->id)): ?> <?= $page->id ?> <?php endif ?>">
    <label for="title">Title:</label>
    <input type="text" name="title" id="title" value="<?php if(!empty($page->title)): ?> <?= e($page->title) ?> <?php endif ?>" required>

    <label for="content">Content:</label>
    <textarea type="text" name="content" id="content" rows="10" required>
        <?php if(!empty($page->content)): ?> <?= e($page->content) ?> <?php endif ?>
    </textarea>

    <input type="submit" value="Submit">

</form>