<?php

use app\core\database\mysql\MySqlManager;

function generateSchemaNodes(){
    $schemaBranch = '';

    $pdo = MySqlManager::getConnection();
    $associativeTables = MySqlManager::getAssociativeTables($pdo);

    foreach($associativeTables as $schema => $tables){
        $schemaNode = '<li class="schema-node">';
        $schemaNode .= '<span onclick="toggleSchemaTables(event); setSchemaInUse(event); renderTableOptions(event);">'.$schema.'</span>';
        $schemaNode .= '<ul class="tables-list">';
        
        generateTableNodes($tables,$schemaNode);

        $schemaNode .= '</ul>';
        $schemaNode .= '</li>';
        $schemaBranch .= $schemaNode;
    }

    return $schemaBranch;
}
function generateTableNodes($tables, &$schemaNode){
    foreach($tables as $table){
        $schemaNode .= '<li class="table-node">'.'<span onclick="setTableInUse(event);">'.$table.'</span>'.'</li>';
    }
}

// Outputs navigation tree
echo '
<ul class="tree" id="navigationTree">
    <li>
        <details open>
            <summary></summary>
            <ul class="schemas-list">
                ' . generateSchemaNodes() . '
            </ul>
        </details>
    </li>
</ul>
';
