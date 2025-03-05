<?php
namespace App\Controllers;

use App\Models\User;
use Core\Controller;

class UserController extends Controller {

    private $basePath;

    public function __construct() {
        // Dynamically get the base path
        $this->basePath = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])), '/');
    }

    // Read all users
    public function index() {
        $userModel = new User();
        $users = $userModel->getAll();
        $this->view('users/index', ['users' => $users]);
    }

    // Create a user (Form)
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'first_name' => $_POST['first_name'],
                'last_name' => $_POST['last_name'],
                'email' => $_POST['email'],
                'password' => $_POST['password'],
                'birth_date' => $_POST['birth_date'],
                'role' => $_POST['role'] ?? 'user', // Default to 'user'
                'phone' => $_POST['phone']
            ];

            // Validate data
            $errors = $this->validateUserData($data);
            if (empty($errors)) {
                // Hash the password
                $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
                $data['created_at'] = date('Y-m-d H:i:s'); // Set created_at

                $userModel = new User();
                if ($userModel->create($data)) {
                    header('Location: ' . $this->basePath . '/users');
                    exit;
                }
            }

            // Handle errors (you can pass them to the view)
            $this->view('users/create', ['errors' => $errors, 'data' => $data]);
        }

        $this->view('users/create');
    }

    // Edit a user (Form)
    public function edit($id) {
        $userModel = new User();
        $user = $userModel->getById($id);
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'first_name' => $_POST['first_name'],
                'last_name' => $_POST['last_name'],
                'email' => $_POST['email'],
                'birth_date' => $_POST['birth_date'],
                'role' => $_POST['role'] ?? 'user', // Default to 'user'
                'phone' => $_POST['phone']
            ];

            // Validate data
            $errors = $this->validateUserData($data, $id);
            if (empty($errors)) {
                // Hash the password only if provided
                if (!empty($_POST['password'])) {
                    $data['password'] = password_hash($_POST['password'], PASSWORD_BCRYPT);
                } else {
                    unset($data['password']); // Don't update password if it's empty
                }

                if ($userModel->update($data, $id)) {
                    header('Location: ' . $this->basePath . '/users');
                    exit;
                }
            }

            // Handle errors (you can pass them to the view)
            $this->view('users/edit', ['user' => $user, 'errors' => $errors, 'data' => $data]);
        }

        // Render edit page
        $this->view('users/edit', ['user' => $user]);
    }

    // Validate user data
    private function validateUserData($data, $userId = null) {
        $errors = [];

        // Validate email
        if (empty($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'البريد الإلكتروني غير صحيح.';
        } else {
            $userModel = new User();
            if ($userModel->emailExists($data['email'], $userId)) {
                $errors['email'] = 'البريد الإلكتروني موجود بالفعل.';
            }
        }

        // Validate password (only if provided)
        if (!empty($data['password']) && strlen($data['password']) < 6) {
            $errors['password'] = 'يجب أن تكون كلمة المرور مكونة من 6 أحرف على الأقل.';
        }

        // Validate birth date
        if (empty($data['birth_date']) || !$this->isValidBirthDate($data['birth_date'])) {
            $errors['birth_date'] = 'يجب أن يكون تاريخ الميلاد صحيحًا ويجب أن يكون عمر المستخدم 18 سنة على الأقل.';
        }

        // Validate role
        if (!in_array($data['role'], ['admin', 'user'])) {
            $errors['role'] = 'يجب أن يكون الدور إما "admin" أو "user".';
        }

        // Validate phone
        if (empty($data['phone']) || !$this->isValidPhone($data['phone'])) {
            $errors['phone'] = 'رقم الهاتف يجب أن يتكون من 9 أرقام ويجب أن يبدأ بأحد الأكواد: "71"، "77"، "78"، "73"، "70".';
        }

        return $errors;
    }

    // Check if the birth date is valid and the user is at least 18 years old
    private function isValidBirthDate($birthDate) {
        $date = \DateTime::createFromFormat('Y-m-d', $birthDate);
        if (!$date || $date->format('Y-m-d') !== $birthDate) {
            return false; // Invalid date format
        }

        $age = (new \DateTime())->diff($date)->y;
        return $age >= 18; // Must be at least 18 years old
    }

    // Validate phone number
    private function isValidPhone($phone) {
        return preg_match('/^(71|77|78|73|70)\d{7}$/', $phone);
    }

    // Delete a user
    public function delete($id) {
        $userModel = new User();
        if ($userModel->delete($id)) {
            header('Location: ' . $this->basePath . '/users');
            exit;
        }
    }
}
