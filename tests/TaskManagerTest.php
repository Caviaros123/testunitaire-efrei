<?php

namespace Prince\Testunit;

use PHPUnit\Framework\TestCase;
use OutOfBoundsException;

class TaskManagerTest extends TestCase
{
    private $taskManager;

    protected function setUp(): void
    {
        $this->taskManager = new TaskManager();
    }

    /**
     * Test de l'ajout d'une tâche
     */
    public function testAddTask(): void
    {
        $this->taskManager->addTask('Tâche 1');
        $tasks = $this->taskManager->getTasks();

        $this->assertCount(1, $tasks);
        $this->assertSame('Tâche 1', $tasks[0]);
    }

    /**
     * Test de suppression d'une tâche
     */
    public function testRemoveTask(): void
    {
        $this->taskManager->addTask('Tâche 1');
        $this->taskManager->addTask('Tâche 2');

        $this->taskManager->removeTask(0);
        $tasks = $this->taskManager->getTasks();

        $this->assertCount(1, $tasks);
        $this->assertSame('Tâche 2', $tasks[0]);
    }

    /**
     * Test de récupération de toutes les tâches
     */
    public function testGetTasks(): void
    {
        $this->taskManager->addTask('Tâche 1');
        $this->taskManager->addTask('Tâche 2');

        $tasks = $this->taskManager->getTasks();
        $this->assertCount(2, $tasks);
        $this->assertSame('Tâche 1', $tasks[0]);
        $this->assertSame('Tâche 2', $tasks[1]);
    }

    /**
     * Test de récupération d'une tâche
     */
    public function testGetTask(): void
    {
        $this->taskManager->addTask('Tâche 1');

        $task = $this->taskManager->getTask(0);
        $this->assertSame('Tâche 1', $task);
    }

    /**
     * Test de suppression avec un index invalide
     */
    public function testRemoveInvalidIndexThrowsException(): void
    {
        $this->expectException(OutOfBoundsException::class);
        $this->taskManager->removeTask(10); // Index invalide
    }

    /**
     * Test de récupération d'une tâche avec un index invalide
     */
    public function testGetInvalidIndexThrowsException(): void
    {
        $this->expectException(OutOfBoundsException::class);
        $this->taskManager->getTask(10); // Index invalide
    }

    /**
     * Test de l'ordre des tâches après suppression
     */
    public function testTaskOrderAfterRemoval(): void
    {
        $this->taskManager->addTask('Tâche 1');
        $this->taskManager->addTask('Tâche 2');
        $this->taskManager->addTask('Tâche 3');

        // Suppression de la tâche à l'index 1  
        $this->taskManager->removeTask(1);
        $tasks = $this->taskManager->getTasks();

        // Vérification de l'ordre des tâches après suppression
        $this->assertSame('Tâche 1', $tasks[0]);
        $this->assertSame('Tâche 3', $tasks[1]);
    }
}
