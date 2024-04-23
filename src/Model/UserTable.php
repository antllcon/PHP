<?php
declare(strict_types=1);

require_once __DIR__ . '/User.php';
require_once __DIR__ . '/Utils.php';
class UserTable
{
    private const MYSQL_DATETIME_FORMAT = 'Y-m-d H:i:s';
    public function __construct(private PDO $connection)
    {
    
    }
    
    public function saveUserDatabase(User $user): int
    {
        $query = <<<SQL
            INSERT INTO user
            (first_name, last_name, middle_name, gender, birth_date, email, phone, avatar_path)
            VALUES (:firstName, :lastName, :middleName, :gender, :birthDate, :email, :phone, :avatarPath)
        SQL;
        $statement = $this->connection->prepare($query);
        try {
            $statement->execute([
                ':firstName' => $user->getFirstName(),
                ':lastName' => $user->getLastName(),
                ':middleName' => $user->getMiddleName(),
                ':gender' => $user->getGender(),
                ':birthDate' => $this->convertDataTimeToString($user->getBirthDate()),
                ':email' => $user->getEmail(),
                ':phone' => $user->getPhone(),
                ':avatarPath' => $user->getAvatarPath()
            ]);
            return (int)$this->connection->lastInsertId();
            
        }
        catch (PDOException $exception)
        {
            throw new RuntimeException($exception->getMessage(), (int) $exception->getCode());
        }
    }
    private function convertDataTimeToString(?DateTimeImmutable $date): ?string
    {
        if ($date === null)
        {
            return null;
        }
        return $date->format(self::MYSQL_DATETIME_FORMAT);
    }
    
    public function find(int $id): ?User
    {
        $query = "SELECT user_id, first_name, last_name, middle_name, gender, birth_date, email, phone, avatar_path FROM user WHERE user_id = :id";
        $statement = $this->connection->prepare($query);
        $statement->execute([':id' => $id]);
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return $this->createUserFromRow($row);
        }
        return null;
    }
    
    private function createUserFromRow(array $row): User
    {
        return new User(
            (int)$row['user_id'],
            $row['first_name'],
            $row['last_name'],
            $row['middle_name'] ?? null,
            $row['gender'],
            Utils::parseDateTime($row['birth_date'], self::MYSQL_DATETIME_FORMAT),
            $row['email'] ?? null,
            ($row['phone'] ?? null),
            $row['avatar_path']
        );
    }
}
