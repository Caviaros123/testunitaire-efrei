<?php

namespace  Prince\Testunit;

use PHPUnit\Framework\TestCase;
use SebastianBergmann\CodeCoverage\InvalidArgumentException;
use PHPUnit\Framework\Exception;
use PDO;

class UserManagerTest extends TestCase
{
    private UserManager $userManager;
    private PDO $pdo;

    protected function setUp(): void
    {
        $this->pdo = new PDO("mysql:host=localhost:8888;dbname=user_management;charset=utf8", "root", "root", [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);

        // Nettoyage de la table avant chaque test
        $this->pdo->exec("DELETE FROM users");

        $this->userManager = new UserManager();
    }

    public function testAddUser(): void
    {
        $this->userManager->addUser("John Doe", "john.doe@example.com");

        $stmt = $this->pdo->query("SELECT * FROM users WHERE email = 'john.doe@example.com'");
        $user = $stmt->fetch();

        $this->assertNotEmpty($user);
        $this->assertEquals("John Doe", $user['name']);
        $this->assertEquals("john.doe@example.com", $user['email']);
    }

    public function testAddUserEmailException(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->userManager->addUser("Jane Doe", "invalid-email");
    }

    public function testRemoveUser(): void
    {
        $this->pdo->exec("INSERT INTO users (id, name, email) VALUES (1, 'Test User', 'test@example.com')");
        $this->userManager->removeUser(1);

        $stmt = $this->pdo->query("SELECT * FROM users WHERE id = 1");
        $user = $stmt->fetch();

        $this->assertEmpty($user);
    }

    public function testGetUsers(): void
    {
        $this->pdo->exec("INSERT INTO users (name, email) VALUES ('Alice', 'alice@example.com')");
        $this->pdo->exec("INSERT INTO users (name, email) VALUES ('Bob', 'bob@example.com')");

        $users = $this->userManager->getUsers();

        $this->assertCount(2, $users);
    }

    public function testGetUser(): void
    {
        $this->pdo->exec("INSERT INTO users (id, name, email) VALUES (1, 'Charlie', 'charlie@example.com')");
        $user = $this->userManager->getUser(1);

        $this->assertEquals("Charlie", $user['name']);
        $this->assertEquals("charlie@example.com", $user['email']);
    }

    public function testInvalidUpdateThrowsException(): void
    {
        $this->expectException(Exception::class);
        $this->userManager->updateUser(999, "New Name", "new@example.com");
    }

    public function testInvalidDeleteThrowsException(): void
    {
        $this->expectException(Exception::class);
        $this->userManager->removeUser(999);
    }
}
