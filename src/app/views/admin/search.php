<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/1d3e88dd32.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="../assets/css/admin/admin-style.css">
    <link rel="stylesheet" href="../assets/css/admin/sidebar-tree-list.css">
    <link rel="stylesheet" href="../assets/css/admin/search-style.css">
    <script src="../assets/js/admin.js"></script>
    <title>Search</title>
</head>
<body>
    <div class="page-container">
        <?php require realpath(__DIR__ . '/../..') . '/components/admin/sidebar.php' ?>
        
        <div class="page-content">
            <?php require realpath(__DIR__ . '/../..') . '/components/admin/navbar.php' ?>
            <div id='searchContainer'>
                <form role="search" id="form" onsubmit="submitSearch(event)">
                    <input type="search" id="search" name="search"
                        placeholder="Search..."
                        aria-label="Search through db"
                        autocomplete="off">
                    <button>
                        <svg viewBox="0 0 1024 1024"><path class="path1" d="M848.471 928l-263.059-263.059c-48.941 36.706-110.118 55.059-177.412 55.059-171.294 0-312-140.706-312-312s140.706-312 312-312c171.294 0 312 140.706 312 312 0 67.294-24.471 128.471-55.059 177.412l263.059 263.059-79.529 79.529zM189.623 408.078c0 121.364 97.091 218.455 218.455 218.455s218.455-97.091 218.455-218.455c0-121.364-103.159-218.455-218.455-218.455-121.364 0-218.455 97.091-218.455 218.455z"></path></svg>
                    </button>
                </form>
                <button id="hideErrorsBtn" onclick="toggleHideErrors()">Hide errors</button>
            </div>
            <div id="searchTablesContainer"></div>
        </div>
    </div>
</body>
</html>
