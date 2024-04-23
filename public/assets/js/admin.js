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
function callPostAPI(action, params, callback) {
    // Base api path
    const apiUrl = '/api/' + action;
    params.action = action;

    const requestOptions = {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(params)
    };

    fetch(apiUrl, requestOptions)
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

function callGetAPI(action, params, callback){
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
    callGetAPI('getTables', {schema:schema_name}, function(response) {
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
    callGetAPI('getTableData', {schema:currSchema, table:currTable}, function(response) {
        buildTable(response);
    });
    
}
// Automatically displays table when an option is selected
document.addEventListener('DOMContentLoaded', function() {
    const tableSelector = document.getElementById('table-selector');
    if (tableSelector) {
        tableSelector.addEventListener('input', function() {
            displayTableContent();
        });
    }
});

// TEST ONLY
// callGetAPI('getTableData', {schema:'library_db', table:'customers'}, function(response) {
//     currSchema = 'library_db';
//     currTable = 'customers';
//     buildTable(response);
// });

function buildTable(data) {
    const tableContainer = document.getElementById('crud-table-container');
    tableContainer.innerHTML = '';

    const table = document.createElement('table');
    table.id = 'crud-table';
    
    // Table Head
    const thead = document.createElement('thead');
    const headerRow = document.createElement('tr');
    const keys = Object.keys(data[0]);
    
    // Create checkbox column header
    const checkboxHeader = document.createElement('th');
    checkboxHeader.id = 'headerCheckbox';
    const checkbox = document.createElement('input');
    checkbox.type = 'checkbox';
    checkbox.classList.add('checkbox');
    checkboxHeader.appendChild(checkbox);
    headerRow.appendChild(checkboxHeader);

    keys.forEach(key => {
        const th = document.createElement('th');
        th.textContent = key;
        headerRow.appendChild(th);
    });

    // Create actions column header
    const actionsHeader = document.createElement('th');
    actionsHeader.textContent = 'Actions';
    headerRow.appendChild(actionsHeader);
    
    thead.appendChild(headerRow);
    table.appendChild(thead);
    
    // Table Body
    const tbody = document.createElement('tbody');

    data.forEach(item => {
        const row = document.createElement('tr');
        row.id = 'row-' + data.indexOf(item);

        // Create checkbox for each row
        const checkboxCell = document.createElement('td');
        const rowCheckbox = document.createElement('input');
        rowCheckbox.type = 'checkbox';
        rowCheckbox.classList.add('checkbox');
        checkboxCell.appendChild(rowCheckbox);
        row.appendChild(checkboxCell);

        // Populate table cells with data
        keys.forEach(key => {
            const cell = document.createElement('td');
            cell.textContent = item[key];
            row.appendChild(cell);
        });

        // Create actions icons (edit and delete) 
        const actionsCell = document.createElement('td');
        actionsCell.classList.add('action');
        const editIcon = document.createElement('i');
        editIcon.className = 'fas fa-edit';
        editIcon.onclick = function(event) {
            openUpdateModal(event);
        }
        actionsCell.appendChild(editIcon);

        const deleteIcon = document.createElement('i');
        deleteIcon.className = 'fas fa-trash-alt';
        deleteIcon.onclick = function(event) {
            openDeleteSingleRowModal(event);
        } 
        actionsCell.appendChild(deleteIcon);

        row.appendChild(actionsCell);

        tbody.appendChild(row);
    });

    table.appendChild(tbody);

    tableContainer.appendChild(table);

    selectAllCheckboxes();

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
            <button type="submit" class="btn-submit" onclick="insertDatabase(event)">Add</button>
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

function deleteModal(table) {
    let deleteModal = `
        <div class="modal-header">
            <h3>Delete from ${table}</h3>
            <span class="close" onclick="closeModal()">&times;</span>
        </div>
        <p style="padding:14px; font-size:14px;">Are you sure you want to delete the following rows:</p>
    `;

    deleteModal += '<div id="deleteRowsDiv"></div>'
  
    deleteModal += `
        <div class="modal-footer">
            <button type="button" class="btn-submit" onclick="deleteFromDatabase()">Delete</button>
            <button type="button" class="btn-cancel" onclick="closeModal()">Cancel</button>
        </div>
    `;

    return deleteModal;
}

function rebuildTable(rowIds) {
    // Create a new table element
    const rebuiltTable = document.createElement('table');
    const tableBody = document.createElement('tbody');

    // Iterate through each row ID
    rowIds.forEach(rowId => {
        const row = document.getElementById(rowId);
        if (row) {
            // Create a new table row and append to the table body
            const newRow = document.createElement('tr');
            const rowIDCell = document.createElement('td');
            rowIDCell.textContent = rowId;
            newRow.appendChild(rowIDCell);
            for (let i = 1; i < row.cells.length-1; i++) {
                const cell = document.createElement('td');
                cell.textContent = row.cells[i].textContent;
                newRow.appendChild(cell);
            }
            tableBody.appendChild(newRow);
        } else {
            console.warn(`Row with ID "${rowId}" not found.`);
        }
    });

    // Append the table body to the rebuilt table
    rebuiltTable.appendChild(tableBody);

    // Find the target div by ID
    const deleteRowsDiv = document.getElementById('deleteRowsDiv');
    if (deleteRowsDiv) {
        // Append the rebuilt table to the target div
        deleteRowsDiv.innerHTML = ''; // Clear existing content
        deleteRowsDiv.appendChild(rebuiltTable);
    } else {
        console.error('Div with ID "deleteRowsById" not found.');
    }
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
    // Removes the first and the last added table columns ( checkbox, actions)
    columns.shift();
    columns.pop();

    return columns;
}
function getRowValues(rowId){
    const row = document.getElementById(rowId);

    if (!row){
        return [];
    }
    const rowValues = row.querySelectorAll('td');

    const values = [];
    rowValues.forEach(td => {
        values.push(td.textContent.trim());
    }) 

    values.shift();
    values.pop();

    return values;
}


// Open Modals -> Insert Modal
function openInsertModal(){
    const modalsContainer = document.getElementById('crud-modals')
    const createDataModal = document.getElementById('create-data-modal');
    createDataModal.innerHTML = insertModal(currTable,getCurrentTableColumns());
    modalsContainer.style.display = 'block';
    createDataModal.style.display = 'block';
}

// Open Update Modal
function openUpdateModal(event){
    const modalsContainer = document.getElementById('crud-modals')
    const updateDataModal = document.getElementById('create-data-modal');

    rowId = event.currentTarget.parentElement.parentElement.id;

    updateDataModal.innerHTML = updateModal(currTable,getCurrentTableColumns(),getRowValues(rowId));
    modalsContainer.style.display = 'block';
    updateDataModal.style.display = 'block';

}

// Open Delete Modal
function openDeleteModal(event){
    const modalsContainer = document.getElementById('crud-modals')
    const deleteDataModal = document.getElementById('delete-data-modal');

    deleteDataModal.innerHTML = deleteModal(currTable);
    rebuildTable(getAllSelectedRowsID());
    modalsContainer.style.display = 'block';
    deleteDataModal.style.display = 'block';

    deleteModal(currTable,getAllSelectedRowsID());
} 

// Delete Modal
function openDeleteSingleRowModal(event){
    const modalsContainer = document.getElementById('crud-modals')
    const deleteDataModal = document.getElementById('delete-data-modal');
    
    rowId = event.currentTarget.parentElement.parentElement.id;

    deleteDataModal.innerHTML = deleteModal(currTable,[rowId]);
    rebuildTable([rowId]);

    modalsContainer.style.display = 'block';
    deleteDataModal.style.display = 'block';
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
function handleDatabaseOperation(event, operationType) {
    const currentModal = event.currentTarget.parentElement.parentElement;
    const formData = new FormData(currentModal.querySelector('#modal-form'));
    formData.append('schema', currSchema);
    formData.append('table', currTable);

    const formDataArray = {};
    formData.forEach((value, key) => {
        formDataArray[key] = value;
    });

    closeModal();

    callPostAPI(operationType, formDataArray, function(response) {
        flashMessage(response);
    });
}

function insertDatabase(event) {
    handleDatabaseOperation(event, 'insertDatabase');
}

function updateDatabase(event) {
    handleDatabaseOperation(event, 'updateDatabase');
}

function deleteFromDatabase(){
    const tableColumn = getCurrentTableColumns()[0];
    rowsToDeleteContainer = document.getElementById('deleteRowsDiv');
    const rowsToDelete =  rowsToDeleteContainer.querySelectorAll('tr')

    const deleteData = {};

    deleteData.table = currTable;
    deleteData.schema = currSchema;
    deleteData.column = tableColumn;
    
    const idsToDelete = [];

    rowsToDelete.forEach(row => {
        const idCell = row.querySelectorAll('td')[1]; // Assuming the ID cell is the second cell in each row
        if (idCell) {
            idsToDelete.push(idCell.textContent.trim()); // Assuming the ID is stored in the cell's text content
        }
    });

    deleteData.column_values = idsToDelete;

    callPostAPI('deleteFromDatabase', deleteData, function(response) {
        flashMessage(response);
    });
}


function flashMessage(textContent) {
    // Activate dark background
    const modalsContainer = document.getElementById('crud-modals');
    modalsContainer.style.display = 'block';

    const messageBox = document.createElement('div');
    messageBox.id = 'messageBox';

    let timeOut = 0;
    if(textContent.Error){
        timeOut = 5000;
        messageBox.innerHTML = '<strong style="color: #c9473e">Error: </strong>' + textContent.Error;
    }
    else if(textContent.Success){
        timeOut = 2000;
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

// Table actions 
function selectAllCheckboxes() {
    const headerCheckboxCell = document.getElementById('headerCheckbox');
    const headerCheckbox = headerCheckboxCell.querySelector('.checkbox');
    const rowCheckboxes = document.querySelectorAll('.checkbox');

    headerCheckbox.addEventListener('change', function() {
        const isChecked = headerCheckbox.checked;
        rowCheckboxes.forEach(checkbox => {
            checkbox.checked = isChecked;
        });
    });
}

function getAllSelectedRowsID(){
    let selectedRows = [];
    const checkboxes = document.querySelectorAll('.checkbox');
    
    checkboxes.forEach(checkbox => {
        if (checkbox.checked) {
            let row = checkbox.closest('tr');
            selectedRows.push(row.id);
        }
    });

    return selectedRows;
}


// SearchSubmit
function submitSearch(event){
    event.preventDefault();
    const searchInput = document.getElementById('search').value;
    callGetAPI('search',{'searchQuery' : searchInput},function(response) {
        console.log(response);
    })
}