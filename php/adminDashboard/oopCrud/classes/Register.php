<?php
include_once './db.php';

class Register
{
    public $db;

    public function __construct()
    {
        $this->db = new db();
    }

    public function addRegister($data, $file)
    {
        $fname = $data['first_name'];
        $lname = $data['last_name'];
        $email = $data['email'];
        $password = $data['password'];
        $confirmPassword = $data['confirmPassword'];

        $profileImage = $file['profile_image']['name'];
        $tmp_name = $file['profile_image']['tmp_name'];
        $path = __DIR__ . "/../upload/" . $profileImage;
        move_uploaded_file($tmp_name, $path);

        $address = $data['address'];
        $phone = $data['phone'];
        $gender  = $data['gender'] ?? null;
        $hobby   = !empty($data["hobby"]) ? implode(",", $data['hobby']) : '';
        $country = $data['country'];
        $passwordErrors = [];
        $confirmPasswordError = '';
        $generalErrors = [];

        if (empty($fname)) {
            $generalErrors['firstName'] = "First name is required.";
        }
        if (empty($lname)) {
            $generalErrors['lastName'] = "Last name is required.";
        }
        if (empty($address)) {
            $generalErrors['address'] = "address is required.";
        }
        if (empty($email)) {
            $generalErrors['email'] = "Email is required";
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $generalErrors['email'] = "Invalid email format.";
        }
        if (empty($phone)) {
            $generalErrors['phone'] = "Phone is required";
        } else if (!preg_match('/^[0-9]{10}+$/', $phone)) {
            $generalErrors['phone'] = "Invalid Phone Number format.";
        }
        if ($_FILES['profile_image']['error'] === UPLOAD_ERR_NO_FILE) {
            $generalErrors['pImg'] = " No file selected. The file field is required.";
        }
        if (!isset($data['hobby']) || empty($data['hobby'])) {
            $generalErrors['hobby'] = "please select at least one hobby.";
        }
        if (!isset($data['gender']) || empty($data['gender'])) {
            $generalErrors['gender'] = "please select at least one gender.";
        }
        if (!isset($data['country']) || empty($data['country'])) {
            $generalErrors['country'] = "please select at least one country.";
        }
        // Check if email already exists
        $query = "SELECT id FROM users WHERE email='$email'";
        $result = $this->db->select($query);
        if ($result) {
            $generalErrors[] = "Email already exists.";
        }
        // Validate password strength
        if (!empty($password)) {
            if (strlen($password) < 8 || !preg_match("#[A-Z]+#", $password) || !preg_match("#[a-z]+#", $password) || !preg_match("#[0-9]+#", $password) || !preg_match("/[\W]+/", $password)) {
                $passwordErrors[] = "Password must be at least 8 characters long, 1 uppercase letter, 1 lowercase letter, 1 special character.";
            } else if (empty($confirmPassword)) {
                $confirmPasswordError = "Confirm passwords is required!";
            } else if ($password !== $confirmPassword) {
                $confirmPasswordError = "Passwords do not match!";
            }
        } else {
            $passwordErrors[] = "Password is required.";
        }

        if (empty($passwordErrors) && empty($confirmPasswordError) && empty($generalErrors)) {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $query = "INSERT INTO users 
        (first_name,last_name,email,password,profile_image,address,phone,gender,hobby,country)
        VALUES 
        ('$fname','$lname','$email','$hashedPassword','$profileImage','$address','$phone','$gender','$hobby','$country')";

            $result = $this->db->insert($query);

            if ($result) {
?>
                <script>
                    window.location.href = "/vishv_trainee_26/php/adminDashboard/oopCrud/index.php";
                </script>
            <?php
            }
        } else {
            $_SESSION['errors'] = [
                'old' => $data,
                'general' => $generalErrors,
                'password' => $passwordErrors,
                'confirmPassword' => $confirmPasswordError
            ];
            ?>
            <script>
                window.location.href = "/vishv_trainee_26/php/adminDashboard/oopCrud/addUser.php";
            </script>
        <?php
        }
    }

    public function allUsers()
    {
        $query = "SELECT * FROM users ORDER BY id DESC";
        $result = $this->db->select($query);
        return $result;
    }

    public function getOneUser($id)
    {
        $query = "SELECT * FROM users WHERE id='$id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function editRegister($id, $data, $file)
    {
        session_start();
        $fname   = $data['first_name'];
        $lname   = $data['last_name'];
        $address = $data['address'];
        $phone   = $data['phone'];
        $gender  = $data['gender'];
        $hobby = !empty($data['hobby']) ? implode(",", $data['hobby']) : '';
        $country = $data['country'];
        $pass = $data['password'];
        $cpass = $data['confirmPassword'];
        $email = $data['email'];
        $oopPasswordErrors = [];
        $oopConfirmPasswordError = '';
        $oopGeneralErrors = [];

        if (empty($fname)) {
            $oopGeneralErrors['firstName'] = "First name is required.";
        }
        if (empty($lname)) {
            $oopGeneralErrors['lastName'] = "Last name is required.";
        }
        if (empty($address)) {
            $oopGeneralErrors['address'] = "address is required.";
        }
        if (empty($email)) {
            $oopGeneralErrors['email'] = "Email is required";
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $oopGeneralErrors['email'] = "Invalid email format.";
        }
        if (!isset($data['hobby']) || empty($data['hobby'])) {
            $_SESSION["hobbies"] = "hobbies";
            $oopGeneralErrors['hobby'] = "please select at least one hobby.";
        }
        if (!isset($data['gender']) || empty($data['gender'])) {
            $oopGeneralErrors['gender'] = "please select at least one gender.";
        }
        if (!isset($data['country']) || empty($data['country'])) {
            $oopGeneralErrors['country'] = "please select at least one country.";
        }
        $query = "SELECT id FROM users WHERE email='$email' AND id != $id";
        $result = $this->db->select($query);
        if ($result) {
            $oopGeneralErrors['email'] = "Email already exists.";
        }

        if (empty($phone)) {
            $oopGeneralErrors['phone'] = "Phone is required";
        } else if (!preg_match('/^[0-9]{10}+$/', $phone)) {
            $oopGeneralErrors['phone'] = "Invalid Phone Number format.";
        }

        $query = "UPDATE users SET 
        first_name='$fname',
        last_name='$lname',
        email='$email',
        address='$address',
        phone='$phone',
        gender='$gender',
        hobby='$hobby',
        country='$country'";

        if (!empty($file['profile_image']['name'])) {
            $profileImage = time() . '_' . $file['profile_image']['name'];
            $tmpName = $file['profile_image']['tmp_name'];
            $path = __DIR__ . "/../upload/" . $profileImage;

            if (move_uploaded_file($tmpName, $path)) {
                $query .= ", profile_image='$profileImage'";
            }
        }
        //password validation
        if (!empty($pass)) {
            if (empty($cpass)) {
                $oopConfirmPasswordError = "Confirm passwords is required!";
            } else if ($pass !== $cpass) {
                $oopConfirmPasswordError = "Passwords do not match!";
            }
            if (strlen($pass) < 8 || !preg_match("#[A-Z]+#", $pass) || !preg_match("#[a-z]+#", $pass) || !preg_match("#[0-9]+#", $pass) || !preg_match("/[\W]+/", $pass)) {
                $oopPasswordErrors[] = "Password must be at least 8 characters long, 1 uppercase letter, 1 lowercase letter, 1 special character.";
            }
            if (empty($oopPasswordErrors) && empty($oopConfirmPasswordError)) {
                $password = password_hash($pass, PASSWORD_DEFAULT);
                $query .= ", password='$password'";
            }
        }
        if (!empty($oopPasswordErrors) || !empty($oopConfirmPasswordError) || !empty($oopGeneralErrors)) {
            $_SESSION['flash'] = [
                'old' => $data,
                'generalError' => $oopGeneralErrors,
                'errors' => [
                    'password' => $oopPasswordErrors,
                    'confirmPassword' => $oopConfirmPasswordError
                ]
            ];
        ?>
            <script>
                window.location.href = "/vishv_trainee_26/php/adminDashboard/oopCrud/edit.php?id=<?php echo intval($id); ?>";
            </script>
        <?php
            exit;
        }

        $query .= " WHERE id='$id'";
        $result = $this->db->insert($query);

        if ($result) {
        ?>
            <script>
                window.location.href = "/vishv_trainee_26/php/adminDashboard/oopCrud/index.php";
            </script>
<?php
            exit;
        }
    }

    public function deleteUser($id)
    {
        $query = "DELETE FROM users WHERE id='$id'";
        $result = $this->db->insert($query);

        if ($result) {
            header("Location: index.php");
            exit();
        }
    }
}
