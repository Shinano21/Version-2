<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
const preview = document.querySelector('.reportPreview');
preview.style.justifyContent = 'center';
preview.style.alignItems = 'center';
// Function to update table data
let count = 0;

function formatDate(dateString) {
    const dateObject = new Date(dateString);
    const options = {
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    };
    return dateObject.toLocaleDateString('en-US', options);
}

function generateTableHeader() {
    var tableHeader = document.getElementById('tableHeader');
    var printHeader = document.getElementById('printHeader');
    <?php
        $keys = array_keys($table);
        $lastKey = end($keys);
    ?>
    var headerRow = '<div class="row">';
    headerRow += '<tr>';
    headerRow += '<th scope="col">No.</th>'; // Add "No." column header
    <?php foreach ($table as $key => $value): ?>
    headerRow +=
        '<th scope="col-4" <?php if ($key === $lastKey): ?>class="address-col" style="text-align: left;" <?php endif; ?>>';
    headerRow += '<?php echo $key ?>';
    headerRow += '</th>';
    <?php endforeach ?>
    headerRow += '</tr>';
    headerRow += '</div>';

    tableHeader.innerHTML = headerRow;
    printHeader.innerHTML = headerRow;
}

function generateTableFooter(totalCount) {
    var tableFooter = document.getElementById('tableFooter');
    tableFooter.innerHTML = ''; // Clear any existing footer content

    var footerRow = '<tr>';
    footerRow += '<td colspan="7" style="text-align: right; font-weight: bold; color: black;">Total Residents:</td>'; // Adjust colspan to match the number of columns
    footerRow += '<td style="font-weight: bold; color: black;">' + totalCount + '</td>';
    footerRow += '</tr>';

    tableFooter.innerHTML = footerRow; // Append footer to the table
}



function generateTableName(data, catSelect, optSelect, catSelect2 = '', optSelect2 = '') {
    var tableName = document.getElementById('tableName');
    tableName.innerText = '';
    tableName.style.color = 'black';
    if (catSelect.value != '' && optSelect.value == '') {
        tableName.innerText = 'MASTERLIST OF RESIDENTS';
    } else if ((catSelect.value == 'bday' && optSelect.value != '') && (catSelect2.value == 'sex' && optSelect2.value !=
            '')) {
        tableName.innerText = `MASTERLIST OF AGED ${optSelect.value} ${optSelect2.value} RESIDENTS`.toUpperCase();
    } else if ((catSelect.value == 'zone' && optSelect.value != '') && (catSelect2.value == 'sex' && optSelect2.value !=
            '')) {
        tableName.innerText = `MASTERLIST OF ${optSelect.value} ${optSelect2.value} RESIDENTS`.toUpperCase();
    } else if ((catSelect.value == 'pwd_status' && optSelect.value != '') && (catSelect2.value == 'zone' && optSelect2
            .value !=
            '')) {
        tableName.innerText = `MASTERLIST OF PWD OF ${optSelect2.value} RESIDENTS`.toUpperCase();
    } else if ((catSelect.value == 'bday' && optSelect.value != '') && (catSelect2.value == 'zone' && optSelect2
            .value != '')) {
        tableName.innerText = `MASTERLIST OF AGED ${optSelect.value} RESIDENTS OF ${optSelect2.value}`.toUpperCase();
    } else if ((catSelect.value == 'labor_status' && optSelect.value != '') && (catSelect2.value == 'zone' && optSelect2
            .value != '')) {
        tableName.innerText = `MASTERLIST OF ${optSelect.value} RESIDENTS OF ${optSelect2.value}`.toUpperCase();
    } else if ((catSelect.value == 'voter_status' && optSelect.value != '') && (catSelect2.value == 'zone' && optSelect2
            .value != '')) {
        tableName.innerText = `MASTERLIST OF ${optSelect.value} VOTERS OF ${optSelect2.value}`.toUpperCase();
    } else if (catSelect.value == 'zone' && optSelect.value != '') {
        tableName.innerText = `MASTERLIST OF RESIDENTS OF ${optSelect.value}`.toUpperCase();
    } else if (catSelect.value == 'bday' && optSelect.value != '') {
        if (optSelect.value == '60-69' || optSelect.value == '70-79' || optSelect.value == '80+')
            tableName.innerText = `MASTERLIST OF SENIOR CITIZENS`;
        else {
            tableName.innerText = `MASTERLIST OF AGED ${optSelect.value} RESIDENTS`.toUpperCase();
        }
    } else if (catSelect.value == 'sex' && optSelect.value != '') {
        tableName.innerText = `MASTERLIST OF ${optSelect.value} RESIDENTS`.toUpperCase();
    } else if (catSelect.value == 'educational' && optSelect.value != '') {
        if (optSelect.value == 'No Formal Education')
            tableName.innerText = "MASTERLIST OF RESIDENTS WITH NO FORMAL EDUCATION";
        else
            tableName.innerText = `MASTERLIST OF ${optSelect.value} RESIDENTS`.toUpperCase();
    } else if (catSelect.value == 'civil_status' && optSelect.value != '') {
        tableName.innerText = `MASTERLIST OF ${optSelect.value} RESIDENTS`.toUpperCase();
    } else if (catSelect.value == 'labor_status' && optSelect.value != '') {
        tableName.innerText = `MASTERLIST OF ${optSelect.value} RESIDENTS`.toUpperCase();
    } else if (catSelect.value == 'four_p' && optSelect.value != '') {
        tableName.innerText = `MASTERLIST OF RESIDENTS OF 4Ps BENEFICIARIES `;
    } else if (catSelect.value == 'pwd_status' && optSelect.value != '') {
        if (optSelect.value == 'Yes')
            tableName.innerText = `MASTERLIST OF PERSONS WITH DISABILITIES`;
    }
}

function addNewColumn(colName) {
    var printHeader = document.getElementById('printHeader');
    var tableHeader = document.getElementById('tableHeader');
    var headerRow = tableHeader.querySelector('tr'); // Get the header row
    var printHeaderRow = printHeader.querySelector('tr');

    // Create a new table header cell
    var newHeaderCell = document.createElement('th');
    newHeaderCell.textContent = `${colName}`; // Set the text for the new column
    var printNewHeaderCell = newHeaderCell.cloneNode(true);
    // Find the existing column you want to insert the new column before
    var existingColumn = headerRow.querySelector('th:nth-child(5)');
    var printExistingColumn = printHeaderRow.querySelector('th:nth-child(5)');
    // Insert the new header cell before the existing column
    headerRow.insertBefore(newHeaderCell, existingColumn);
    printHeaderRow.insertBefore(printNewHeaderCell, printExistingColumn);
}

function addNewRow(data, catSelect) {
    var tableBody = document.getElementById('tableBody'); // Get the table body
    var printBody = document.getElementById('printBody');
    var rows = tableBody.querySelectorAll('tr');
    var printRows = printBody.querySelectorAll('tr');

    for (let i = 0; i < data.length; i++) {
        if (i == 10)
            break;
        var cell = rows[i];
        var existingRow = cell.querySelector('td:nth-child(5)');
        var newRow = document.createElement('td');
        newRow.textContent = `${data[i][catSelect]}`;
        newRow.style.color = 'black';
        rows[i].insertBefore(newRow, existingRow);
    }
    for (let i = 0; i < data.length; i++) {
        var printCell = printRows[i];
        var printExistingRow = printCell.querySelector('td:nth-child(5)');
        var newRow = document.createElement('td');
        newRow.textContent = `${data[i][catSelect]}`;
        newRow.style.color = 'black';
        printRows[i].insertBefore(newRow, printExistingRow);
    }
}

function updateTableData(data, counts, catSelect) {
    var tableBody = document.getElementById('tableBody');
    const placeholder = document.querySelector('#placeholder');
    var printBody = document.getElementById('printBody');

    printBody.innerHTML = '';
    printHeader = '';
    tableBody.innerHTML = ''; // Clear existing rows
    tableHeader.innerHTML = '';

    if (Array.isArray(data)) {
        preview.style.backgroundColor = 'white';
        generateTableHeader();

        if (count == 0) {
            placeholder.remove();
            preview.style.justifyContent = '';
            preview.style.alignItems = '';
            count += 1;
        }
        for (let i = 0; i < data.length; i++) {
    if (i == 10) break;
    var newRow = '<tr class="table-light">';
    newRow += '<td style="color: black;">' + (i + 1) + '</td>'; // Add row number
    newRow += '<td style="color: black;">' + `${data[i].lname}, ${data[i].fname} ${data[i].mname}` + '</td>';
    newRow += '<td style="color: black;">' + data[i].sex + '</td>';
    newRow += '<td style="color: black;">' + calculateAge(data[i].bday) + '</td>';
    newRow += '<td style="color: black;">' + formatDate(data[i].bday) + '</td>';
    newRow += '<td style="color: black; text-align: left;" class="address-col">' +
        `${data[i].street}, ${data[i].zone}, ${data[i].brgy}, ${data[i].mun}, ${data[i].province}` +
        '</td>';
    newRow += '</tr>';
    tableBody.innerHTML += newRow;
}
// Generate the footer with the total number of rows
generateTableFooter(data.length);

for (let i = 0; i < data.length; i++) {
    var newRow = '<tr class="table-light">';
    newRow += '<td style="color: black;">' + (i + 1) + '</td>'; // Add row number
    newRow += '<td style="color: black;">' + `${data[i].lname}, ${data[i].fname} ${data[i].mname}` + '</td>';
    newRow += '<td style="color: black;">' + data[i].sex + '</td>';
    newRow += '<td style="color: black;">' + calculateAge(data[i].bday) + '</td>';
    newRow += '<td style="color: black;">' + formatDate(data[i].bday) + '</td>';
    newRow += '<td class="text-left" style="color: black;">' +
        `${data[i].street}, ${data[i].zone}, ${data[i].brgy}, ${data[i].mun}, ${data[i].province}` +
        '</td>';
    newRow += '</tr>';
    printBody.innerHTML += newRow;
}
// Add the footer row to the print table
var footerRow = '<tr>';
footerRow += '<td colspan="7" style="text-align: right; font-weight: bold; color: black;">Total Residents:</td>'; // Adjust colspan
footerRow += '<td style="font-weight: bold; color: black;">' + data.length + '</td>'; // Total count
footerRow += '</tr>';
printBody.innerHTML += footerRow; // Append the footer row


        if (catSelect.value == 'labor_status') {
            addNewColumn('Labor Force Status');
            addNewRow(data, catSelect.value);
        } else if (catSelect.value == 'educational') {
            addNewColumn('Educational Level');
            addNewRow(data, catSelect.value);
        } else if (catSelect.value == 'civil_status') {
            addNewColumn('Civil Status');
            addNewRow(data, catSelect.value);
        } else if (catSelect.value == 'voter_status') {
            addNewColumn('Voter Status');
            addNewRow(data, catSelect.value);
        } else if (catSelect.value == 'four_p') {
            addNewColumn('4Ps Beneficiary');
            addNewRow(data, catSelect.value);
        } else if (catSelect.value == 'pwd_status') {
            addNewColumn('PWD Status');
            addNewRow(data, catSelect.value);
        }

    } else {
        console.error('No data.');
    }
}

// Function to work with sql_data when it's available
function processData(sqlData, counts, catSelect) {
    updateTableData(sqlData, counts, catSelect);
}

// Wait for the document to be ready
document.addEventListener('DOMContentLoaded', function() {
    // Call the function when the document is ready
    processData(sql_data);
    generateTableName(sql_data, catSelect, optSelect, catSelect2, optSelect2);
});

function calculateAge(birthday) {
    var today = new Date();
    var birthDate = new Date(birthday);

    var years = today.getFullYear() - birthDate.getFullYear();
    var months = today.getMonth() - birthDate.getMonth();
    var days = today.getDate() - birthDate.getDate();

    // Check if the current date hasn't reached the birth date for this year
    if (months < 0 || (months === 0 && today.getDate() < birthDate.getDate())) {
        years--;
        months = 12 + months; // Add 12 months to the negative value
    }

    if (years === 0) {
        if (months === 0) {
            return days + ' days';
        } else {
            return months + ' months';
        }
    } else {
        return years;
    }
}
</script>