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
        $confirmPassword = $data['confirm_password'];

        $profileImage = $file['profile_image']['name'];
        $tmp_name = $file['profile_image']['tmp_name'];
        $path = "upload/" . $profileImage;
        move_uploaded_file($tmp_name, $path);

        $address = $data['address'];
        $phone = $data['phone'];
        $gender  = $data['gender'] ?? null;
        $hobby   = !empty($data["hobby"]) ? implode(",", $data['hobby']) : null;
        $country = $data['country'];
        $passwordErrors = [];
        $confirmPasswordError = '';
        $generalErrors = [];

        if (!preg_match('/^[0-9]{10}+$/', $phone)) {
            $generalErrors[] = "Invalid Phone Number format.";
        }
        // Check if email already exists
        $query = "SELECT id FROM users WHERE email='$email'";
        $result = $this->db->select($query);
        if ($result) {
            $generalErrors[] = "Email already exists.";
        }
        // Validate password strength
        if (empty($password)) {
            $passwordErrors[] = "Password is required.";
        } else {
            // If the password is not empty, check individual constraints
            if (strlen($password) < 8) {
                $passwordErrors[] = "Password must be at least 8 characters long.";
            }
            if (!preg_match("#[A-Z]+#", $password)) {
                $passwordErrors[] = "Password must contain at least 1 uppercase letter.";
            }
            if (!preg_match("#[a-z]+#", $password)) {
                $passwordErrors[] = "Password must contain at least 1 lowercase letter.";
            }
            if (!preg_match("#[0-9]+#", $password)) {
                $passwordErrors[] = "Password must contain at least 1 number.";
            }
            if (!preg_match("/[\W]+/", $password)) {
                $passwordErrors[] = "Password must contain at least 1 special character.";
            }
        }
        if (empty($passwordErrors) && !empty($password) && !empty($confirmPassword)) {
            if ($password !== $confirmPassword) {
                $confirmPasswordError = "Passwords do not match!";
            }
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
        $cpass = $data['confirm_password'];
        $email = $data['email'];
        $oopPasswordErrors = [];
        $oopConfirmPasswordError = '';
        $oopGeneralErrors = [];

        if (!preg_match('/^[0-9]{10}+$/', $phone)) {
            $oopGeneralErrors[] = "Invalid Phone Number format.";
        }
        if (!empty($pass)) {
            // If the password is not empty, check individual constraints
            if (strlen($pass) < 8) {
                $oopPasswordErrors[] = "Password must be at least 8 characters long.";
            }
            if (!preg_match("#[A-Z]+#", $pass)) {
                $oopPasswordErrors[] = "Password must contain at least 1 uppercase letter.";
            }
            if (!preg_match("#[a-z]+#", $pass)) {
                $oopPasswordErrors[] = "Password must contain at least 1 lowercase letter.";
            }
            if (!preg_match("#[0-9]+#", $pass)) {
                $oopPasswordErrors[] = "Password must contain at least 1 number.";
            }
            if (!preg_match("/[\W]+/", $pass)) {
                $oopPasswordErrors[] = "Password must contain at least 1 special character.";
            }
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
            $profileImage = $file['profile_image']['name'];
            $tmpName = $file['profile_image']['tmp_name'];
            $path = "upload/" . $profileImage;
            if (move_uploaded_file($tmpName, $path)) {
                $query .= ", profile_image='$profileImage' ";
            }
        }
        if (empty($oopPasswordErrors) && !empty($pass) && !empty($cpass)) {
            if ($pass !== $cpass) {
                $oopConfirmPasswordError = "Passwords do not match!";
            }
        }
        if (empty($oopPasswordErrors) && empty($oopConfirmPasswordError) && empty($oopGeneralErrors)) {
            $password = password_hash($pass, PASSWORD_DEFAULT);
            $query .= ", password='$password'";
        } else {
            $_SESSION['flash'] = [
                'old' => $data,
                'errors' => [
                    'general' => $oopGeneralErrors,
                    'password' => $oopPasswordErrors,
                    'confirmPassword' => $oopConfirmPasswordError
                ]
            ];
            ?>
            <script>
                window.location.href = "/vishv_trainee_26/php/adminDashboard/oopCrud/edit.php?id=<?php echo intval($id); ?>";
            </script>
        <?php
        }
        $query .= " WHERE id='$id'";
        $result = $this->db->insert($query);

        if ($result) {
        ?>
            <script>
                window.location.href = "/vishv_trainee_26/php/adminDashboard/oopCrud/index.php";
            </script>
<?php
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
