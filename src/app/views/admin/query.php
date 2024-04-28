<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/1d3e88dd32.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="../assets/css/admin/admin-style.css">
    <link rel="stylesheet" href="../assets/css/admin/sidebar-tree-list.css">
    <link rel="stylesheet" href="../assets/css/admin/query-style.css">
    <script src="../assets/js/admin.js"></script>
    <title>Query</title>
</head>
<body>
    <div class="page-container">
        <?php require realpath(__DIR__ . '/../..') . '/components/admin/sidebar.php' ?>
        
        <div class="page-content">
            <?php require realpath(__DIR__ . '/../..') . '/components/admin/navbar.php' ?>
            <div id="queryContainer">
                <form role="query" id="form">
                    <div class="terminal-container">
                        <div id="query" class="textarea" contenteditable="true" placeholder="Enter a MySQL Query" aria-label="Query the db" autocomplete="off" contenteditable="true" spellcheck="false"></div>
                            <button type="button" onclick="submitQuery(event)" class="terminal-button">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M20.5 20.5L22 22" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M16 18.5C16 19.8807 17.1193 21 18.5 21C19.1916 21 19.8175 20.7192 20.2701 20.2654C20.7211 19.8132 21 19.1892 21 18.5C21 17.1193 19.8807 16 18.5 16C17.1193 16 16 17.1193 16 18.5Z" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M4 6V12C4 12 4 15 11 15C18 15 18 12 18 12V6" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M11 3C18 3 18 6 18 6C18 6 18 9 11 9C4 9 4 6 4 6C4 6 4 3 11 3Z" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M11 21C4 21 4 18 4 18V12" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
            <div id="queryResultContainer"></div>
        </div>      
    </div>
</body>
</html>
