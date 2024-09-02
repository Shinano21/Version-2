<script>
let dataToSend = '';
const categoryOptions = {
    "zone": [
        "Purok 1",
        "Purok 2",
        "Purok 3",
        "Purok 4",
        "Purok 5",
        "Purok 6"
    ],
    "sex": ["Female", "Male"],
    "bday": [
        "0-11 Months",
        "1-5",
        "6-12",
        "13-19",
        "20-29",
        "30-39",
        "40-49",
        "50-59",
        "60-69",
        "70-79",
        "80+"
    ],
    "educational": [
        "Preschool",
        "Elementary",
        "Elementary Graduate",
        "Junior High School",
        "Junior High School Graduate",
        "Senior High School",
        "Senior High School Graduate",
        "Undergraduate",
        "Some College Units",
        "College Degree",
        "Some Masteral Units",
        "Master's Degree",
        "Some Doctoral Units",
        "Doctoral Degree",
        "No Formal Education",
        "Not Applicable"
    ],
    "civil_status": ["Single", "Married", "Separated", "Divorced", "Widowed"],
    "labor_status": [
        "Employed",
        "Unemployed",
        "Not in the Labor Force",
        "Not Applicable",
    ],
    "four_p": ["Yes", "No"],
    "voter_status": ["Yes", "No", "Not Applicable"],
    "pwd_status": ["Yes", "No"]

};

const catSelect = document.getElementById('selectCategory1');
const optSelect = document.getElementById('selectOption1');
const defaultCatSelect = document.getElementById('selectCategory1');
const defaultOptSelect = document.getElementById('selectOption1');
const filterSelect = document.getElementById('selectFilter');
let counts = 0;
var sql_data;

function updateOptions(category, select) {
    const selectedCategory = category.value;
    const options = categoryOptions[selectedCategory] || [];
    while (select.childNodes.length > 0) {
        select.removeChild(select.lastChild);
    }

    const defaultOption = document.createElement('option');
    defaultOption.value = '';
    defaultOption.textContent = 'Select an option';
    select.appendChild(defaultOption);
    // Add new options based on the selected category
    options.forEach(option => {
        const optionElement = document.createElement('option');
        optionElement.value = option;
        optionElement.textContent = option;
        select.appendChild(optionElement);
    });
}

function jquery_data(data) {
    $.ajax({
        url: 'reports_func/preview_reports.php',
        type: 'POST',
        contentType: 'application/x-www-form-urlencoded',
        data: data,
        success: function(response) {
            console.log('Data sent successfully');
            sql_data = response.data;
            processData(sql_data, counts, catSelect);
            generateTableName(sql_data, catSelect, optSelect, catSelect2, optSelect2);
        },
        error: function(xhr, status, error) {
            console.log('Error: ', error);
        }
    });
}


function handleOptionSelectChange(filter, catSelect, optSelect, catSelect2 = '', optSelect2 =
    '') {
    let dataToSend = '';

    if (filter == '') {
        dataToSend =
            `category1=${encodeURIComponent(catSelect.value)}&option1=${encodeURIComponent(optSelect.value)}`;
    } else if (filter === '1') {
        dataToSend =
            `filter=${encodeURIComponent(filter)}&category1=${encodeURIComponent(catSelect.value)}&option1=${encodeURIComponent(optSelect.value)}`;
    } else {
        dataToSend =
            `filter=${encodeURIComponent(filter)}&category1=${encodeURIComponent(catSelect.value)}&option1=${encodeURIComponent(optSelect.value)}&category2=${encodeURIComponent(catSelect2.value)}&option2=${encodeURIComponent(optSelect2.value)}`;
    }
    jquery_data(dataToSend);
}

function handleDefaultChange() {
    handleOptionSelectChange('', catSelect, optSelect);
}

function createAdditionalFilter() {
    const div = document.createElement('div');
    const div2 = document.createElement('div');
    const filterDiv = document.createElement('div');

    const divP = document.createElement('p');
    const div2P = document.createElement('p');
    const filterParagraph = document.createElement('p');

    div.classList.add('options');
    div2.classList.add('options');
    filterDiv.classList.add('filterTitles');

    div.setAttribute('id', 'catDiv');
    div2.setAttribute('id', 'optDiv');

    // Creating a paragraph for the 2nd filter
    filterParagraph.textContent = '2nd Filter';
    filterParagraph.classList.add('filterTitle');
    filterDiv.append(filterParagraph);

    divP.textContent = "Categories";
    div2P.textContent = "Options";
    div.append(divP);
    div2.append(div2P);

    // Inserting the paragraph before the additional dropdowns
    const filterTitlesContainer = document.querySelector('.filterTitles');
    filterTitlesContainer.parentNode.insertBefore(filterDiv, filterTitlesContainer.nextSibling);

    const select = document.createElement('select');
    const select2 = document.createElement('select');
    select.setAttribute('id', 'selectCategory2')
    select2.setAttribute('id', 'selectOption2')
    select.innerHTML = `<option value="">Choose a 1st category</option>`;
    select2.innerHTML = '<option value="">Select an option</option>';

    div.appendChild(select);
    div2.appendChild(select2);
    document.querySelector('.reportButtons').appendChild(div);
    document.querySelector('.reportButtons').appendChild(div2);



}
let catSelect2 = '';
let optSelect2 = '';
let selectedValue = '';


function handleOptionChange() {
    if (filterSelect.value === '1') {
        handleOptionSelectChange(selectedValue, catSelect, optSelect);
    } else {
        handleOptionSelectChange(selectedValue, catSelect, optSelect,
            catSelect2,
            optSelect2)
    }

}

filterSelect.addEventListener('change', function() {
    selectedValue = filterSelect.value;
    counts += 1;
    const additionalSelectCategories = document.querySelectorAll('#catDiv');
    const additionalSelectOptions = document.querySelectorAll('#optDiv');
    const additionalFilterTitles = document.querySelectorAll('.filterTitles');

    defaultOptSelect.removeEventListener('change', handleDefaultChange);
    defaultCatSelect.removeEventListener('change', handleDefaultChange);
    if (selectedValue === '1') {
        optSelect.removeEventListener('change', handleOptionChange);

        optSelect2.removeEventListener('change', handleOptionChange);

        additionalSelectCategories.forEach((select, index) => {
            select.remove();
        });
        additionalSelectOptions.forEach((select, index) => {
            select.remove();
        });
        additionalFilterTitles[1].remove();
        optSelect.addEventListener('change', handleOptionChange);
        catSelect.addEventListener('change', handleOptionChange);
    } else if (selectedValue === '2') {
        optSelect.removeEventListener('change', handleOptionChange);
        catSelect.addEventListener('change', handleOptionChange);
        // Reset the selected category for the first filter
        catSelect.value = ''; // Clear the value
        optSelect.value = '';
        optSelect2.value = '';
        if (additionalSelectCategories.length < 2) {
            createAdditionalFilter();

            catSelect2 = document.getElementById('selectCategory2');
            optSelect2 = document.getElementById('selectOption2');

            catSelect2.addEventListener('change', function() {
                updateOptions(catSelect2, optSelect2);
            });
            optSelect.addEventListener('change', handleOptionChange);
            optSelect2.addEventListener('change', handleOptionChange);
        }
    }
});


// Listen for change events on the category select
catSelect.addEventListener('change', function() {
    if (filterSelect.value == 2) {
        // Clear the options in the second category
        catSelect2.innerHTML = '<option value="">Select 2nd category</option>';
        // Generate options for the second category based on the selection in the first category
        <?php foreach($categories as $category): ?>
        if ("<?php echo $category['value']; ?>" !== catSelect.value) {
            // Add options except for the selected value in the first category
            const option = document.createElement('option');
            option.value = "<?php echo $category['value']; ?>";
            option.textContent = "<?php echo $category['name']; ?>";
            catSelect2.appendChild(option);
        }
        <?php endforeach; ?>
    }
    updateOptions(catSelect, optSelect);
});


// Initially populate options based on the default selected category
updateOptions(catSelect, optSelect);
if (counts == 0) {
    defaultOptSelect.addEventListener('change', handleDefaultChange);
    defaultCatSelect.addEventListener('change', handleDefaultChange);
}
</script>