// PubSub pattern implementation
const subscribers = {};

function subscribe(eventName, callback) {
    if (!subscribers[eventName]) {
        subscribers[eventName] = [];
    }
    subscribers[eventName].push(callback);
}

function publish(eventName, data) {
    if (subscribers[eventName]) {
        subscribers[eventName].forEach(callback => {
            callback(data);
        });
    }
}

// For testing
var currSchema;
var currTable;

// Event handlers
function setSchemaInUse(event) {
    const schemaName = event.currentTarget.innerHTML;
    currSchema = schemaName;
    publish('schemaChange', schemaName);
}

function setTableInUse(event) {
    const tableName = event.currentTarget.innerHTML;
    currTable = tableName;
    publish('tableChange', tableName);
}

function hideCurrentTable() {
    const tableArrowIcon = document.querySelector('#table-arrows');
    const currentTableElement = document.querySelector('#current-table');
    if (tableArrowIcon && currentTableElement) {
        tableArrowIcon.style.display = 'none';
        currentTableElement.style.display = 'none';
    }
}

function handleSchemaChange(newSchema) {
    const schemaArrowIcon = document.querySelector('#schema-arrows');
    const currentSchemaElement = document.querySelector('#current-schema');
    if (newSchema && schemaArrowIcon && currentSchemaElement) {
        hideCurrentTable();
        schemaArrowIcon.style.display = 'block';
        currentSchemaElement.style.display = 'block';
        currentSchemaElement.querySelector('span').textContent = newSchema;
    }
}

function handleTableChange(newTable) {
    const tableArrowIcon = document.querySelector('#table-arrows');
    const currentTableElement = document.querySelector('#current-table');
    if (newTable && tableArrowIcon && currentTableElement) {
        tableArrowIcon.style.display = 'block';
        currentTableElement.style.display = 'block';
        currentTableElement.querySelector('span').textContent = newTable;
    }
}

// Subscribe to events
subscribe('schemaChange', handleSchemaChange);
subscribe('tableChange', handleTableChange);

// DOMContentLoaded
let databaseTree;
document.addEventListener('DOMContentLoaded', function() {
    databaseTree = document.getElementById('dbTree');
});

// Toggle database tree visibility
function toggleDbTree() {
    const displayState = databaseTree.style.display === 'none' ? 'block' : 'none';
    databaseTree.style.display = displayState;
}

// Close database tree
function closeDbTree() {
    databaseTree.style.display = 'none';
}

// Toggle schema tables visibility
function toggleSchemaTables(event) {
    const schemaNode = event.currentTarget;
    const tableList = schemaNode.nextElementSibling;
    if (tableList) {
        const displayState = tableList.style.display === 'none' ? 'block' : 'none';
        tableList.style.display = displayState;
    }
}

// CRUD Operations

function callAPI(action, params, callback){
    apiUrl = '/api/' + action;
    
    if(action === 'getTables'){
        apiUrl += '?schema=' + params['schema'];
    }

    fetch(apiUrl)
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            callback(data);
        })
        .catch(error => {
            console.error('Fetch Error:', error);
        });
}

function renderTableOptions(event){
    const schema_name = event.currentTarget.innerHTML;
    callAPI('getTables', {schema:schema_name}, function(response) {
        var tableSelector = document.getElementById('table-selector');
        tableSelector.innerHTML = '';

        response.forEach(table => {
            var option = document.createElement('option');
            option.value = table;
            option.textContent = table;
            tableSelector.appendChild(option);
        });

        tableSelector.onchange = function() {
            var selectedTable = tableSelector.value;
            if (selectedTable) {
                publish('tableChange', selectedTable);
            }
        };
    });
}
