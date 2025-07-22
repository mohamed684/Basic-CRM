<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./styles/simple.css" />
    <link rel="stylesheet" type="text/css" href="./styles/custom.css" />
    <title>CMS Project</title>
</head>
<body>
    <header>
        <h1>
            <a href="index.php">CMS Project</a>
        </h1>
        <p>A custom-made CMS system</p>
        <nav>
            <?php foreach($navigation as $navPage): ?>
                <a href="index.php?<?php echo http_build_query(['page' => $navPage->slug]) ?>" 
                class="<?php if(!empty($page) && !empty($page->id) && $page->id === $navPage->id): ?>active<?php endif ?>">
                    <?= $navPage->title ?>
                </a>
            <?php endforeach ?>
        </nav>
    </header>
    <main>
        <?php echo $contents; ?>
    </main>
    <footer>
        <p></p>
    </footer>

    <script src="./js/main.js"></script>
</body>
</html>