<?php
// Connect to the database
$conn = new mysqli("localhost", "root", "", "file_management");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch document from the database based on the controlNumber or id
if (isset($_GET['controlNumber'])) {
    $controlNumber = $conn->real_escape_string($_GET['controlNumber']);
    $sql = "SELECT NAME, DEPARTMENT FROM upload_files WHERE controlNumber = '$controlNumber'";
    $result = mysqli_query($conn, $sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $file_name = $row['NAME'];
        $department = $row['DEPARTMENT'];
        $file_path = "../uploads/$department/$file_name";

        if (file_exists($file_path)) {
            // Set the appropriate Content-Type header
            header('Content-Type: application/pdf');
            header('Content-Disposition: inline; filename="' . basename($file_path) . '"');
            header('Content-Transfer-Encoding: binary');
            header('Accept-Ranges: bytes');
            // Output the document content
            @readfile($file_path);
        } else {
            echo "File not found.";
        }
    } else {
        echo "Document not found.";
    }
}

// Close the connection
$conn->close();
?>
