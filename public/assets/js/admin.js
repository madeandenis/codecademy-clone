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
    // Base api path
    apiUrl = '/api/' + action;
    
    if (params && Object.keys(params).length > 0) {
        apiUrl += '?';
    
        const queryParams = [];
    
        Object.keys(params).forEach(key => {
            const encodedKey = encodeURIComponent(key); 
            const encodedValue = encodeURIComponent(params[key]); 
            queryParams.push(`${encodedKey}=${encodedValue}`); 
        });
    
        apiUrl += queryParams.join('&');
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
                currTable = selectedTable;
                publish('tableChange', selectedTable);
            }
        };
    });
}

function displayTableContent(){
    const tableContainer = document.getElementById('crud-table-container');

    callAPI('getTableData', {schema:currSchema, table:currTable}, function(response) {
        buildTable(response, tableContainer);
    });
    
}

// TEST ONLY
callAPI('getTableData', {schema:'library_db', table:'customers'}, function(response) {
    currSchema = 'library_db';
    currTable = 'customers';
    const tableContainer = document.getElementById('crud-table-container');
    buildTable(response, tableContainer);
});

function buildTable(data, container) {
    container.innerHTML = '';

    const table = document.createElement('table');
    table.id = 'crud-table';
    
    // Table Head
    const thead = document.createElement('thead');
    const headerRow = document.createElement('tr');

    
    const keys = Object.keys(data[0]);
    
    keys.forEach(key => {
        const th = document.createElement('th');
        th.textContent = key;
        headerRow.appendChild(th);
    });
    
    thead.appendChild(headerRow);
    table.appendChild(thead);
    
    // Table Body
    const tbody = document.createElement('tbody');

    data.forEach(item => {
        const row = document.createElement('tr');

        keys.forEach(key => {
            const cell = document.createElement('td');
            cell.textContent = item[key];
            row.appendChild(cell);
        });

        tbody.appendChild(row);
    });

    table.appendChild(tbody);

    container.appendChild(table);
}


// Modal Section -> Builder & Open modal

function buildModal(columns, columnValues = []) {
    let modalBuilder = `
        <div class="modal-form-container">
            <form id="modal-form" method="POST" onsubmit="event.preventDefault()">
    `;

    for (let i = 0; i < columns.length; i++) {
        let columnName = columns[i];
        let columnValue = columnValues[i] || ''; 

        modalBuilder += `
            <label for="${columnName}">${columnName}:</label><br>
            <input type="text" id="${columnName}" name="${columnName}" value="${columnValue}"><br>
        `;
    }

    modalBuilder += `
            </form>
        </div>
    `;

    return modalBuilder;
}

function insertModal(table, columns) {
    let insertModal = `
        <div class="modal-header">
            <h3>Add new ${table}</h3>
            <span class="close" onclick="closeModal()">&times;</span>
        </div>
    `;

    insertModal += buildModal(columns);

    insertModal += `
        <div class="modal-footer">
            <button type="submit" class="btn-submit" onclick="updateDatabase(event)">Add</button>
            <button type="button" class="btn-cancel" onclick="closeModal()">Cancel</button>
        </div>
    `;

    return insertModal;
}

function updateModal(table, columns, columnValues) {
    let updateModal = `
        <div class="modal-header">
            <h3>Update ${table}</h3>
            <span class="close" onclick="closeModal()">&times;</span>
        </div>
    `;

    updateModal += buildModal(columns, columnValues);

    updateModal += `
        <div class="modal-footer">
            <button type="submit" class="btn-submit" onclick="updateDatabase(event)">Update</button>
            <button type="button" class="btn-cancel" onclick="closeModal()">Cancel</button>
        </div>
    `;

    return updateModal;
}

function getCurrentTableColumns() {
    const tableHeaderRow = document.querySelector('#crud-table thead tr'); 

    if (!tableHeaderRow) {
        return []; 
    }
    const tableColumns = tableHeaderRow.querySelectorAll('th'); 

    const columns = []; 
    tableColumns.forEach(th => {
        columns.push(th.textContent.trim());
    });

    return columns;
}


// Open Modals
function openInsertModal(){
    const modalsContainer = document.getElementById('crud-modals')
    const createDataModal = document.getElementById('create-data-modal');
    createDataModal.innerHTML = insertModal(currTable,getCurrentTableColumns());
    modalsContainer.style.display = 'block';
    createDataModal.style.display = 'block';
}

// Close Modals
function closeModal(){
    const modalsContainer = document.getElementById('crud-modals');
    modalsContainer.style.display = 'none';
    
    Array.from(modalsContainer.children).forEach(modal => {
        modal.style.display = 'none';
    });   
}


// Update Database 
function updateDatabase(event){
    const currentModal = event.currentTarget.parentElement.parentElement;
    const formData = new FormData(currentModal.querySelector('#modal-form'));
    formData.append('schema',currSchema);
    formData.append('table',currTable);
    
    const formDataArray = {};
    formData.forEach((value, key) => {
        formDataArray[key] = value;
    });
    
    closeModal();
    
    callAPI('updateDatabase',formDataArray,function(response){
        flashMessage(response);
    })
    
}

function flashMessage(textContent) {
    // Activate dark background
    const modalsContainer = document.getElementById('crud-modals');
    modalsContainer.style.display = 'block';

    const messageBox = document.createElement('div');
    messageBox.id = 'messageBox';

    let timeOut;
    if(textContent.Error){
        timeOut = 5;
        messageBox.innerHTML = '<strong style="color: #c9473e">Error: </strong>' + textContent.Error;
    }
    else if(textContent.Success){
        timeOut = 2;
        messageBox.innerHTML = '<strong style="color: #73C873">Success: </strong>' + textContent.Success;
    }
    document.body.appendChild(messageBox);

    messageBox.style.display = 'block';

    setTimeout(() => {
        messageBox.style.display = 'none';
        document.body.removeChild(messageBox); 
        
        modalsContainer.style.display = 'none';
    }, timeOut); 
}