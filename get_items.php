<?php
include 'db.php';

$status = $_POST['status'] ?? '';
$vendor = $_POST['vendor'] ?? '';

$query = "SELECT * FROM items WHERE 1";
if ($status) $query .= " AND status = '" . $db->real_escape_string($status) . "'";
if ($vendor) $query .= " AND vendor LIKE '%" . $db->real_escape_string($vendor) . "%'";

$result = $db->query($query);

if ($result->num_rows === 0) {
    echo "<tr><td colspan='6'>No items found.</td></tr>";
}

while ($row = $result->fetch_assoc()) {
    $badgeClass = match($row['status']) {
        'Active' => 'success',
        'Paused' => 'warning',
        'Discontinued' => 'secondary',
        default => 'light'
    };
    echo "<tr>
        <td>{$row['item_name']}</td>
        <td>{$row['vendor']}</td>
        <td><span class='badge bg-{$badgeClass}'>{$row['status']}</span></td>
        <td>{$row['start_date']} to {$row['end_date']}</td>
        <td>{$row['units_sold']}</td>
        <td>{$row['units_returned']}</td>
    </tr>";
}
