<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "obituary_platform";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Pagination settings
$limit = 10; // Number of records per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Retrieve data with pagination
$sql = "SELECT * FROM obituaries LIMIT ? OFFSET ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $limit, $offset);
$stmt->execute();
$result = $stmt->get_result();

// Get total number of records
$sql_total = "SELECT COUNT(*) AS total FROM obituaries";
$result_total = $conn->query($sql_total);
$total_records = $result_total->fetch_assoc()['total'];
$total_pages = ceil($total_records / $limit);

// Prepare meta tags
$meta_title = "Obituaries List - Your Site Name";
$meta_description = "Browse the list of obituaries to honor and remember loved ones.";
$meta_keywords = "obituaries, memorials, tributes";
$canonical_url = "http://yourdomain.com/view_obituaries.php?page=" . $page;
$image_url = "http://yourdomain.com/path/to/image.jpg"; // Replace with your image URL

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo htmlspecialchars($meta_description); ?>">
    <meta name="keywords" content="<?php echo htmlspecialchars($meta_keywords); ?>">
    <meta name="title" content="<?php echo htmlspecialchars($meta_title); ?>">
    <link rel="canonical" href="<?php echo htmlspecialchars($canonical_url); ?>">
    
    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="<?php echo htmlspecialchars($meta_title); ?>">
    <meta property="og:description" content="<?php echo htmlspecialchars($meta_description); ?>">
    <meta property="og:image" content="<?php echo htmlspecialchars($image_url); ?>">
    <meta property="og:url" content="<?php echo htmlspecialchars($canonical_url); ?>">
    <meta property="og:type" content="website">

    <title><?php echo htmlspecialchars($meta_title); ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: 20px auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .pagination {
            margin-top: 20px;
            text-align: center;
        }
        .pagination a {
            margin: 0 5px;
            padding: 8px 16px;
            border: 1px solid #ddd;
            border-radius: 4px;
            text-decoration: none;
            color: #007bff;
        }
        .pagination a:hover {
            background-color: #ddd;
        }
        .social-sharing {
            margin-top: 20px;
            text-align: center;
        }
        .social-sharing a {
            margin: 0 5px;
            padding: 8px 16px;
            border: 1px solid #ddd;
            border-radius: 4px;
            text-decoration: none;
            color: #007bff;
            background-color: #f4f4f4;
        }
        .social-sharing a:hover {
            background-color: #ddd;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Obituaries List</h2>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Date of Birth</th>
                    <th>Date of Death</th>
                    <th>Content</th>
                    <th>Author</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                    <td><?php echo htmlspecialchars($row['dob']); ?></td>
                    <td><?php echo htmlspecialchars($row['dod']); ?></td>
                    <td><?php echo htmlspecialchars($row['content']); ?></td>
                    <td><?php echo htmlspecialchars($row['author']); ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <div class="pagination">
            <?php if ($page > 1): ?>
            <a href="?page=<?php echo $page - 1; ?>">&laquo; Previous</a>
            <?php endif; ?>
            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
            <a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
            <?php endfor; ?>
            <?php if ($page < $total_pages): ?>
            <a href="?page=<?php echo $page + 1; ?>">Next &raquo;</a>
            <?php endif; ?>
        </div>

        <div class="social-sharing">
            <a href="https://twitter.com/share?url=<?php echo urlencode($canonical_url); ?>" target="_blank">Share on Twitter</a>
            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode($canonical_url); ?>" target="_blank">Share on Facebook</a>
            <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo urlencode($canonical_url); ?>" target="_blank">Share on LinkedIn</a>
        </div>
    </div>

    <?php
    // Close connections
    $stmt->close();
    $conn->close();
    ?>
</body>
</html>
