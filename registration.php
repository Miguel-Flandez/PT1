<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit-no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Registration Details</title>

    <!-- Custom fonts and styles -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body class="bg-gradient-primary">
    <div class="container">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"
                        style="background-image: url('https://images.unsplash.com/photo-1690229689642-c85a2373e2ff?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1974&q=80');"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Registration Details</h1>
                            </div>

                            <?php
                            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                $firstName = sanitizeInput($_POST["firstName"]);
                                $lastName = sanitizeInput($_POST["lastName"]);
                                $gender = sanitizeInput($_POST["gender"]);
                                $dob = sanitizeInput($_POST["dob"]);
                                $address = sanitizeInput($_POST["address"]);
                                $country = sanitizeInput($_POST["country"]);
                                $username = sanitizeInput($_POST["username"]);
                                $password = sanitizeInput($_POST["password"]);
                                $confirmPassword = sanitizeInput($_POST["confirmPassword"]);

                                // Validate the inputs
                                $errors = array();

                                // First Name and Last Name are valid if not empty
                                if (empty($firstName) || empty($lastName)) {
                                    $errors[] = "First Name and Last Name are required";
                                }

                                // Validate the Gender
                                if (empty($gender)) {
                                    $errors[] = "Gender is required";
                                }

                                // Validate Date of Birth
                                if (empty($dob) || strtotime($dob) >= strtotime('today') || date("Y") - date("Y", strtotime($dob)) < 18) {
                                    $errors[] = "You must at least be 18 years of age.";
                                }

                                // Validate the Address
                                if (empty($address)) {
                                    $errors[] = "Address is required";
                                }

                                // Allowed Countries
                                $allowedCountries = array("USA", "Canada", "UK", "Australia", "Germany", "France", "Spain", "Japan", "Philippines", "India");
                                if (empty($country) || !in_array($country, $allowedCountries)) {
                                    $errors[] = "Invalid Country";
                                }

                                // Username must contain at least one letter and one number
                                if (empty($username) || !preg_match("/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{2,}$/", $username)) {
                                    $errors[] = "Username must contain at least one letter and one number";
                                }

                                // Password and Confirm Password
                                if (empty($password) || strlen($password) < 6) {
                                    $errors[] = "Password is required and must be at least 6 characters long";
                                }

                                if ($password !== $confirmPassword) {
                                    $errors[] = "Passwords do not match";
                                }

                                if (empty($errors)) {
                                    // Display the registration details without password and confirm password
                                    echo "<p><strong>First Name:</strong> $firstName</p>";
                                    echo "<p><strong>Last Name:</strong> $lastName</p>";
                                    echo "<p><strong>Gender:</strong> $gender</p>";
                                    echo "<p><strong>Date of Birth:</strong> $dob</p>";
                                    echo "<p><strong>Address:</strong> $address</p>";
                                    echo "<p><strong>Country:</strong> $country</p>";
                                    echo "<p><strong>Username:</strong> $username</p>";
                                } else {
                                    echo "<p><strong>Validation Errors:</strong></p>";
                                    echo "<ul>";
                                    foreach ($errors as $error) {
                                        echo "<li>$error</li>";
                                    }
                                    echo "</ul>";
                                }
                            } else {
                                echo "<p>Invalid request method.</p>";
                            }

                            function sanitizeInput($input) {
                                return htmlspecialchars(stripslashes(trim($input))  );
                            }
                            ?>





                            <hr>
                            <div class="text-center">
                                <a class="small" href="register.html">Back to Registration Form</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
</body>

</html>
