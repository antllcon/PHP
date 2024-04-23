<?php
declare(strict_types=1);

require_once __DIR__ . '/../Infrastructure/Database/ConnectionProvider.php';
require_once __DIR__ . '/../Model/User.php';
require_once __DIR__ . '/../Model/UserTable.php';
require_once __DIR__ . '/../Model/Utils.php';

class UserController
{
    private const DATE_TIME_FORMAT = 'Y-m-d';
    
    private UserTable $table;
    
    public function __construct()
    {
         $connection = ConnectionProvider::connectDataBase();
         $this->table  = new UserTable($connection);
    }
    
    public function index(): void
    {
        require __DIR__. '/../view/register_user_form.php';
    }
    
    public function registerUser(array $data): void
    {
        $birthDate = Utils::parseDateTime($data['birth_date'], self::DATE_TIME_FORMAT);
        $birthDate = $birthDate->setTime(0, 0, 0);
        
        $user = new User(
            id: null,
            firstName: $data['first_name'],
            lastName:$data['last_name'],
            middleName: $data['middle_name'] ?? null,
            gender: $data['gender'],
            birthDate: $birthDate,
            email: $data['email'],
            phone: empty($data['phone']) ? null : $data['phone'],
            avatarPath: $data['avatar_path'] ?? null
        );
        
        $userId = $this->table->saveUserDatabase($user);
        $redirectUrl = "/view_user.php?id=$userId";
        header('Location: ' . $redirectUrl, true, 303);
        die();
    }
    
    public function viewUser(int $id): void
    {
        $user = $this->table->find($id);
        require __DIR__ . '/../view/view_user.php';
    }
}