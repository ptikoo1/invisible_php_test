<?php
// In-memory data (replace with your actual data source)
$users = [
    [
        'id' => 1,
        'name' => 'John Doe',
        'email' => 'john.doe@example.com'
    ],
    [
        'id' => 2,
        'name' => 'Jane Doe',
        'email' => 'jane.doe@example.com'
    ],
    [
        'id' => 3,
        'name' => 'Alice Smith',
        'email' => 'alice.smith@example.com'
    ],
    [
        'id' => 4,
        'name' => 'Bob Johnson',
        'email' => 'bob.johnson@example.com'
    ]
];

// Function to sort the users array
function sortUsers(&$users, $sortBy, $sortOrder) {
    usort($users, function($a, $b) use ($sortBy, $sortOrder) {
        if ($a[$sortBy] == $b[$sortBy]) {
            return 0;
        }
        if ($sortOrder == 'asc') {
            return ($a[$sortBy] < $b[$sortBy]) ? -1 : 1;
        } else {
            return ($a[$sortBy] > $b[$sortBy]) ? -1 : 1;
        }
    });
}

// Get sorting parameters from the URL
$sortBy = $_GET['sort_by'] ?? 'id'; // Default sort by id
$sortOrder = $_GET['sort_order'] ?? 'asc'; // Default sort order ascending

// Toggle sort order
$newSortOrder = ($sortOrder == 'asc') ? 'desc' : 'asc';

// Sort the users array
sortUsers($users, $sortBy, $sortOrder);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title>
    <style>
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            cursor: pointer;
        }
        th a {
            display: block;
            text-decoration: none;
            color: black;
        }
    </style>
</head>
<body>

    <h2>User List</h2>

    <table>
        <thead>
            <tr>
                <th><a href="?sort_by=id&sort_order=<?php echo ($sortBy == 'id') ? $newSortOrder : 'asc'; ?>">ID</a></th>
                <th><a href="?sort_by=name&sort_order=<?php echo ($sortBy == 'name') ? $newSortOrder : 'asc'; ?>">Name</a></th>
                <th><a href="?sort_by=email&sort_order=<?php echo ($sortBy == 'email') ? $newSortOrder : 'asc'; ?>">Email</a></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?php echo $user['id']; ?></td>
                    <td><?php echo $user['name']; ?></td>
                    <td><?php echo $user['email']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>
</html>
