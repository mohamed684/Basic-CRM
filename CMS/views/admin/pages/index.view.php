<h1>Admin: Manage Pages</h1>

<a href="index.php?route=admin/pages/create">Create Page</a>

<table style="width: 100%">
    <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
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
            </tr>
        <?php endforeach ?>
    </tbody>
</table>