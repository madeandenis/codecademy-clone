<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/1d3e88dd32.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="assets/css/admin/admin-style.css">
    <link rel="stylesheet" href="assets/css/admin/sidebar-tree-list.css">
    <script src="assets/js/admin.js"></script>
    <title>Admin Panel</title>
</head>
<body>
    <div class="page-container">
        <?php require realpath(__DIR__ . '/../..') . '/components/admin/sidebar.php' ?>
        
        <div class="page-content">
        <?php require realpath(__DIR__ . '/../..') . '/components/admin/navbar.php' ?>
            <h1>Main Content</h1>
            <p>This is the main content area.</p>
        </div>

    </div>
</body>
</html>
