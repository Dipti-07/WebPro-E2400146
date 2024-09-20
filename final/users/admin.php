<?php
require 'connect.php';
session_start();

// Check if user is an admin
if (!isset($_SESSION['username']) || $_SESSION['usertype'] !== 'admin') {
    header('location: ../login.php');
    exit();
}

// Add Service
if (isset($_POST['add_service'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    // Handle image upload
    $image = $_FILES['image']['name'];
    $img_type = $_FILES['image']['type'];
    $img_size = $_FILES['image']['size'];
    $temp_name = $_FILES['image']['tmp_name'];

    if ($img_type !== 'image/jpeg' && $img_type !== 'image/png' && $img_type !== 'image/gif') {
        die("Invalid file format!");
    }
    if ($img_size > (1024 * 1024)) {
        die("File size limit exceeds! (Max size is 1MB)");
    }

    $qry = "INSERT INTO services (title, description, price, image) VALUES ('$title', '$description', '$price', '$image')";

    if (!$conn->query($qry)) {
        die('Error: ' . $conn->error);
    }

    move_uploaded_file($temp_name, '../images/' . $image);
    $_SESSION['message'] = 'Service added successfully';
    header('Location: admin.php');
    exit();
}

// Update Service
if (isset($_GET['sid'])) {
    $sid = intval($_GET['sid']); // Sanitize input
    $qry = "SELECT * FROM services WHERE id=" . $sid;
    $service_data = $conn->query($qry);
    if ($service_data) {
        $service = $service_data->fetch_assoc();
    } else {
        die('Error: ' . $conn->error);
    }
}

if (isset($_POST['update_service'])) {
    $title = $conn->real_escape_string($_POST['title']);
    $description = $conn->real_escape_string($_POST['description']);
    $price = $conn->real_escape_string($_POST['price']);

    if ($_FILES['image']['name'] !== '') {
        $image = $_FILES['image']['name'];
        $img_type = $_FILES['image']['type'];
        $img_size = $_FILES['image']['size'];
        $temp_name = $_FILES['image']['tmp_name'];

        if (!in_array($img_type, ['image/jpeg', 'image/png', 'image/gif'])) {
            die("Invalid file format!");
        }
        if ($img_size > (1024 * 1024)) {
            die("File size limit exceeds! (Max size is 1MB)");
        }

        // Move the uploaded file
        move_uploaded_file($temp_name, '../images/' . $image);
    } else {
        $image = isset($service['image']) ? $service['image'] : ''; // Preserve existing image
    }

    $qry = "UPDATE services SET title='$title', description='$description', price='$price', image='$image' WHERE id=" . intval($_GET['sid']);

    if (!$conn->query($qry)) {
        die('Error: ' . $conn->error);
    }

    $_SESSION['message'] = 'Service updated successfully';
    header('Location: admin.php');
    exit();
}

// Delete Service
if (isset($_GET['did'])) {
    $qry = "DELETE FROM services WHERE id=" . $_GET['did'];
    if (!$conn->query($qry)) {
        die('Error: ' . $conn->error);
    }

    $_SESSION['message'] = 'Service deleted successfully';
    header('Location: admin.php');
    exit();
}

// Fetch all services
$qry_select = "SELECT * FROM services";
$services = $conn->query($qry_select);
?>
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Services</title>
     
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
     
    <link rel="stylesheet" href="../styles/admin.css">
    <script>
        function showAlert(message) {
            alert(message);
        }
    </script>
</head>
<body>
    <!-- Header Section -->
    <header>
        <h1>Admin Dashboard</h1>
        <nav>
            <ul>
                <li><a href="admin.php">Admin</a></li>
                <li><a href="users.php">Users</a></li>
                <li><a href="booking.php">Bookings</a></li>
                 
            </ul>
        </nav>
        <button class="logout" onclick="window.location.href='../index.php'">Logout</button>
    </header>

    <main>
        <h2 style="text-align: center;">Manage Services</h2>

        <!-- Display message -->
        <?php if (isset($_SESSION['message'])): ?>
        <script>
            showAlert('<?php echo addslashes($_SESSION['message']); ?>');
        </script>
        <?php unset($_SESSION['message']); endif; ?>

        <!-- Add Service Form -->
        <form action="admin.php" method="post" enctype="multipart/form-data" style="width: 100%; max-width: 600px; margin: 0 auto;">
            <h3>Add Service</h3>
            <input type="text" name="title" placeholder="Service Title" required>
            <textarea name="description" placeholder="Service Description" required></textarea>
            <input type="text" name="price" placeholder="Service Price" required>
            <input type="file" name="image" accept="image/jpeg, image/png, image/gif" required>
            <input type="submit" name="add_service" value="Add Service" style="width: auto; display: block; margin: 1rem auto;">
        </form>

        <!-- Update Service Form -->
        <?php if (isset($service)): ?>
        <form action="admin.php?sid=<?php echo $service['id']; ?>" method="post" enctype="multipart/form-data" style="width: 100%; max-width: 600px; margin: 0 auto;">
            <h3>Update Service</h3>
            <input type="text" name="title" value="<?php echo htmlspecialchars($service['title']); ?>" required>
            <textarea name="description" required><?php echo htmlspecialchars($service['description']); ?></textarea>
            <input type="text" name="price" value="<?php echo htmlspecialchars($service['price']); ?>" required>
            <input type="file" name="image" accept="image/jpeg, image/png, image/gif">
            <input type="submit" name="update_service" value="Update Service" style="width: auto; display: block; margin: 1rem auto;">
        </form>
        <?php endif; ?>
        <br>

        <!-- Services List -->
        <h3 style="text-align: center;">Services List</h3>
        <table style="width: 100%; border-collapse: collapse; margin: 1rem auto;">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($service = $services->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($service['title']); ?></td>
                    <td><?php echo htmlspecialchars($service['description']); ?></td>
                    <td><?php echo htmlspecialchars($service['price']); ?></td>
                    <td><img src="../images/<?php echo htmlspecialchars($service['image']); ?>" alt="<?php echo htmlspecialchars($service['title']); ?>" width="100"></td>
                    <td>
                        <a href="admin.php?sid=<?php echo $service['id']; ?>" class="action-button edit-button">Edit</a>
                        <a href="admin.php?did=<?php echo $service['id']; ?>" class="action-button delete-button" onclick="return confirm('Are you sure you want to delete this service?')">Delete</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </main>

    <!-- Footer Section -->
    <footer style="text-align: center; padding: 1rem; background-color: #333; color: #fff;">
        <p>&copy; 2024 D&C Beauty Salon. All rights reserved.</p>     
    </footer>
</body>
</html>
