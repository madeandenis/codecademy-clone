<?php

use app\core\database\mysql\MySqlManager;

function generateSchemaBranches(){
    $schemaBranch = '';

    $pdo = MySqlManager::getConnection();
    $associativeTables = getAssociativeTables($pdo);

    foreach($associativeTables as $schema => $tables){
        $schemaNode = '<li class="schema-node">';
        $schemaNode .= '<span onclick="toggleSchemaTables(event); setSchemaInUse(event);">'.$schema.'</span>';
        $schemaNode .= '<ul class="tables-list">';
        foreach($tables as $table){
            $schemaNode .= '<li class="table-node" onclick="setTableInUse(event)">'.'<span>'.$table.'</span>'.'</li>';
        }
        $schemaNode .= '</ul>';
        $schemaNode .= '</li>';
        $schemaBranch .= $schemaNode;
    }

    return $schemaBranch;
}

$dbTree = '
<ul class="tree" id="dbTree">
    <li>
        <details open>
            <summary></summary>
            <ul class="schemas-list">
                ' . generateSchemaBranches() . '
            </ul>
        </details>
    </li>
</ul>
';

$databaseTree = '';
$databaseTree .= $dbTree;  

echo $databaseTree;