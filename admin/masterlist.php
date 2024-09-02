<?php include "categories.php"; ?>

<div class="reportCont">
    <div class="card">
        <p class="title">Masterlist</p>
        <div class="masterlists">
            <div class="options">
                <p>Number of Filters</p>
                <select id="selectFilter">
                    <option value="1">One Filter</option>
                    <option value="2">Two Filters</option>
                </select>
            </div>
            <form action="" method="post" id="selectForm">
                <div class="titleContainer">
                    <div class="filterTitles">
                        <p class="filterTitle">1st Filter</p>
                    </div>
                </div>
                <div class="reportButtons">
                    <div class="options">
                        <p>Categories</p>
                        <select id="selectCategory1">
                            <option value="">Select 1st category</option>
                            <?php foreach($categories as $category): ?>
                            <option value="<?php echo $category['value']; ?>"><?php echo $category['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="options">
                        <p>Options</p>
                        <select id="selectOption1">
                            <option value="">Select an option</option>
                        </select>
                    </div>
                </div>
                <?php include 'reports_func/preview_reports.php' ?>
                <div class="reportPreview" id="preview">
                    <div id="placeholder">
                        <h4>Preview Not Available</h4>
                        <h6>Select in the filter the data you want to generate</h6>
                    </div>
                    <table class="table table-bordered">
                        <thead id="tableHeader">

                        </thead>
                        <tbody id="tableBody">

                        </tbody>
                    </table>
                    <table class="table table-bordered" id="printTable" style="display: none;">
                        <h6 id="tableName" style="display: none;"></h6>
                        <thead id="printHeader">

                        </thead>
                        <tbody id="printBody">

                        </tbody>
                    </table>
                </div>
                <?php include 'reports_func/table_reports.php' ?>
                <div class="button">
                    <button type="submit" onclick="printTable('printTable')" id="printCSVBtn"
                        style="background-color:rgb(106,182,96);color:white;border:none;box-shadow:0px 0px 2px gray;padding:10px 20px 10px 20px;border-radius:10px;">
                        <span class="fa fa-print">&nbsp;&nbsp;</span>Print Preview
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include "reports_func/filter_reports.php" ?>
<style>
.text-left {
    text-align: left;
}
</style>
<script>
function printTable(tableName) {
    let printContents = document.getElementById(tableName).innerHTML;
    let tableLabel = document.getElementById('tableName').innerHTML;
    let newTab = window.open(
        `reports_func/print_reports.php?tableName=${encodeURIComponent(tableLabel)}&content=${encodeURIComponent(printContents)}`,
        '_blank',
        'noopener,noreferrer');
    if (newTab) {
        newTab.focus();
    }
}
$(document).ready(function() {
    $('#selectForm').submit(function(event) {
        event.preventDefault(); // Prevent the default form submission behavior
    });
});
</script>