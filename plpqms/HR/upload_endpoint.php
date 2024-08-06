<?php
session_start();
header('Content-Type: application/json');

$response = ['success' => false];

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_FILES["file"]) && isset($_POST["formname"]) && isset($_POST["department"])) {
    $file = $_FILES["file"];
    $formname = $_POST["formname"];
    $department = $_POST["department"];
    $uploadDir = 'uploads/';

    // Ensure the uploads directory exists
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // Define the target file path
    $uploadFile = $uploadDir . basename($file["name"]);

    // Move uploaded file to the target directory
    if (move_uploaded_file($file["tmp_name"], $uploadFile)) {
        // Define the path to the Python script
        // Rename the python_path variable into your python 3.11 interpreter
        //$python_path = 'C:/Users/sktui/AppData/Local/Microsoft/WindowsApps/PythonSoftwareFoundation.Python.3.11_qbz5n2kfra8p0/python.exe';
        $python_path = '../PythonExec3.12/python.exe';
        $python_script = '../HR/practice/deploy.py';

        // Command to execute the Python script with the target file as an argument
        $command = "\"$python_path\" \"$python_script\" \"$uploadFile\" \"$formname\" \"$department\" 2>&1";  // Redirect stderr to stdout for error logging
        //$output = $command;
        // Execute the Python script and capture the output
        $output = shell_exec($command);

        if ($output === null) {
            $response['message'] = "Error executing Python script. Check Python script logs for details.";
        } else {
            // Log output for debugging
            file_put_contents('python_script_output.log', $output, FILE_APPEND);

            $lines = explode("\n", trim($output));
            $result = [];

            foreach ($lines as $line) {
                if (stripos($line, 'Predicted signature:') !== false) {
                    $result['predicted_class'] = trim(explode(":", $line)[1]);
                }
                if (stripos($line, 'Predicted person:') !== false) {
                    $result['predicted_label'] = trim(explode(":", $line)[1]);
                }
            }

            if (!empty($result['predicted_class']) && !empty($result['predicted_label'])) {
                $_SESSION['predicted_class'] = $result['predicted_class'];  // Store predicted class in session
                $_SESSION['predicted_label'] = $result['predicted_label'];  // Optionally store predicted label in session for debugging
                $response['success'] = true;
                $response['data'] = $result;
                $response['message'] = 'File successfully uploaded and processed.';
            } else {
                $response['message'] = 'Invalid script output. Check Python script logs for details.';
            }
        }
    } else {
        $response['message'] = 'File upload failed.';
    }
} else {
    $response['message'] = 'Invalid request.';
}

echo json_encode($response);
?>
