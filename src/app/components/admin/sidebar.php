<div class="sidebar" onmouseleave="closeDbTree()">
    <div class="sidebar-header">
        <p class="logo">DenDev_<br>Manager</p>
    </div>
    <div class="sidebar-routes">
        <ul>
            <li><a onclick="toggleDbTree()"><i class="fa-solid fa-sitemap"></i><span>Database</span></a></li>
            <?php include 'databaseTree.php' ?>            
            <li><a><i class="fa-solid fa-bars-progress"></i><span>CRUD</span></a></li>
            <li><a><i class="fas fa-search"></i><span>Search</span></a></li>
            <li><a><i class="fas fa-exchange-alt"></i></i><span>Transactions</span></a></li>
            <li><a><i class="fas fa-history"></i><span>History</span></a></li>
            <li><a><i class="fas fa-cog"></i><span>Settings</span></a></li>
            <li><a><i class="fa-solid fa-door-open"></i><span>Logout</span></a></li>
        </ul>
    </div>
</div>