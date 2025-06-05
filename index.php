<?php
include 'db.php';
$pageTitle = "Item Tracker Demo";
$bodyClass = "bg-light"; // optional
include '../partials/header.php';
?>

<div class="container py-5">
    <h1 class="text-center mb-4">Item Tracker</h1>

    <!-- Filters -->
    <div class="row mb-3">
        <div class="col-md-4">
            <select id="statusFilter" class="form-select">
                <option value="">All Statuses</option>
                <option value="Active">Active</option>
                <option value="Paused">Paused</option>
                <option value="Discontinued">Discontinued</option>
            </select>
        </div>
        <div class="col-md-4">
            <input type="text" id="vendorFilter" class="form-control" placeholder="Filter by vendor...">
        </div>
        <div class="col-md-4 text-end">
            <button class="btn btn-secondary" id="resetFilters">Reset Filters</button>
        </div>
    </div>

    <!-- Table -->
    <table class="table table-bordered bg-white shadow-sm">
        <thead>
            <tr>
                <th>Item</th>
                <th>Vendor</th>
                <th>Status</th>
                <th>Date Range</th>
                <th>Units Sold</th>
                <th>Units Returned</th>
            </tr>
        </thead>
        <tbody id="itemsTable">
            <tr><td colspan="6">Loading...</td></tr>
        </tbody>
    </table>
</div>

<script>
function loadItems() {
    const status = $('#statusFilter').val();
    const vendor = $('#vendorFilter').val();
    localStorage.setItem('status', status);
    localStorage.setItem('vendor', vendor);

    $.post('get_items.php', { status, vendor }, function(data) {
        $('#itemsTable').html(data);
    });
}

$('#statusFilter, #vendorFilter').on('change keyup', loadItems);
$('#resetFilters').click(() => {
    $('#statusFilter').val('');
    $('#vendorFilter').val('');
    localStorage.clear();
    loadItems();
});

$(document).ready(() => {
    $('#statusFilter').val(localStorage.getItem('status') || '');
    $('#vendorFilter').val(localStorage.getItem('vendor') || '');
    loadItems();
});
</script>
