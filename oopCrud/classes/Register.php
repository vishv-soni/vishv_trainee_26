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
        $first_name = $data['first_name'];
        $last_name = $data['last_name'];
        $email = $data['email'];
        $password = $data['password'];
        $confirm_password = $data['confirm_password'];

        $profile_image = $file['profile_image']['name'];
        $tmp_name = $file['profile_image']['tmp_name'];
        $path = "upload/" . $profile_image;
        move_uploaded_file($tmp_name, $path);

        $address = $data['address'];
        $phone = $data['phone'];
        $gender  = $data['gender'] ?? null;
        $hobby   = !empty($data["hobby"]) ? implode(",", $data['hobby']) : null;
        $country = $data['country'];

        if ($password !== $confirm_password) {
            return "Password do not match!";
        }
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO users 
        (first_name,last_name,email,password,profile_image,address,phone,gender,hobby,country)
        VALUES 
        ('$first_name','$last_name','$email','$hashed_password','$profile_image','$address','$phone','$gender','$hobby','$country')";

        $result = $this->db->insert($query);

        if ($result) {
            header("Location: index.php");
        } else {
            echo "Registration failed.";
        }
    }

    public function allUsers()
    {
        $query = "SELECT * FROM users ORDER BY id DESC";
        $result = $this->db->select($query);
        return $result;
    }

    public function getUser()
    {
        $query = "SELECT * FROM users ORDER BY id DESC";
        $result = $this->db->select($query);
        return $result;
    }
}
