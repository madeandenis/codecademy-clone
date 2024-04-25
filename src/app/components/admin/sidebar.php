<div class="sidebar" onmouseleave="closeDbTree()">
    <div class="sidebar-header">
        <a style="text-decoration:none;" href="http://codecademyre.com/admin"><p class="logo">DenDev_<br>Manager</p></a>
    </div>
    <div class="sidebar-routes">
        <ul>
            <li><a onclick="toggleDbTree()"><i class="fa-solid fa-sitemap"></i><span>Database</span></a></li>
            <?php include 'databaseTree.php' ?>            
            <li><a href="http://codecademyre.com/admin/crud"><i class="fa-solid fa-bars-progress"></i><span>CRUD</span></a></li>
            <li><a href="http://codecademyre.com/admin/search"><i class="fas fa-search"></i><span>Search</span></a></li>
            <li><a href="http://codecademyre.com/admin/query"><i class="fas fa-exchange-alt"></i></i><span>Query</span></a></li>
            <li><a><i class="fas fa-history"></i><span>History</span></a></li>
            <li><a><i class="fas fa-cog"></i><span>Settings</span></a></li>
            <li><a><i class="fa-solid fa-door-open" onclick="logoutUser()"></i><span>Logout</span></a></li>
        </ul>
    </div>
</div>