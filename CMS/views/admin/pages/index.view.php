<h1>Admin: Manage Pages</h1>

<a href="index.php?route=admin/pages/create">Create Page</a>

<table style="width: 100%">
    <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($pages as $page): ?>
            <tr>
                <td>
                    <?= $page->id ?>
                </td>
                <td>
                    <?= $page->title ?>
                </td>
                <td style="display: flex; gap: 10px;">
                    <a href="index.php?<?php echo http_build_query(['route' => 'admin/pages/update', 'slug' => $page->slug]) ?>">
                        Edit
                    </a>

                    <form method="POST" action="index.php?<?php echo http_build_query(['route' => 'admin/pages/delete']) ?>">
                        <input type="hidden" name="_csrf" value="<?= csrf_token() ?>">
                        <input type="hidden" name="id" value="<?= e($page->id) ?>">
                        <input style="background:red;" type="submit" value="Delete">
                    </form>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>