<?php

use App\Task\Task;
use App\Task\TaskList;
use PHPUnit\Framework\TestCase;

class TaskListTest extends TestCase
{
    private Task $task1;
    private Task $task2;
    private Task $task3;
    private TaskList $taskList;

    protected function setUp(): void
    {
        $this->task1 = new Task();
        $this->task2 = new Task();
        $this->task3 = new Task();
        $this->taskList = new TaskList();
    }

    protected function tearDown(): void
    {
        unset($this->task1, $this->task2, $this->task3, $this->taskList);
    }

    public function testNullReturnedFromGetWhenEmpty(): void
    {
        $this->assertNull($this->taskList->get(0));
    }

    public function testSameTaskAddedAndReturnedFromTaskList(): void
    {
        $this->taskList->add($this->task1);

        $this->assertSame($this->task1, $this->taskList->get(0));
    }

    public function testSameThreeTaskAddedAndReturnedFromTaskList(): void
    {
        $this->taskList->add($this->task1);
        $this->taskList->add($this->task2);
        $this->taskList->add($this->task3);

        $this->assertSame($this->task1, $this->taskList->get(0));
        $this->assertSame($this->task2, $this->taskList->get(1));
        $this->assertSame($this->task3, $this->taskList->get(2));
    }

    public function testNullReturnedFromGetByIdWhenIdNotInTaskList(): void
    {
        $this->task1->id = 0;
        $this->task2->id = 1;

        $this->taskList->add($this->task1);
        $this->taskList->add($this->task2);

        $this->assertNull($this->taskList->getById(2));
    }

    public function testSameThreeTaskAddedAndReturnedByIdFromTaskList(): void
    {
        $this->task1->id = 0;
        $this->task2->id = 1;

        $this->taskList->add($this->task1);
        $this->taskList->add($this->task2);

        $this->assertSame($this->task1, $this->taskList->getById(0));
        $this->assertSame($this->task2, $this->taskList->getById(1));
    }

    public function testExceptionThrownFromGetWhenIndexIsNegative(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("The index cannot be negative");

        $this->taskList->get(-1);
    }

    public function testSortByNameAscendingOrder(): void
    {
        $this->task1->name = "Ironing the clothes"; // 1. in order
        $this->task1->id = 22;
        
        $this->task2->name = "Loading the washing machine"; // 2. in order
        $this->task2->id = 2;
        
        $this->task3->name = "Mopping the floor"; // 3. in order
        $this->task3->id = 222;

        $this->taskList->add($this->task3);
        $this->taskList->add($this->task2);
        $this->taskList->add($this->task1);

        $this->taskList->sortByName();

        $this->assertSame($this->task1, $this->taskList->get(0));
        $this->assertSame($this->task2, $this->taskList->get(1));
        $this->assertSame($this->task3, $this->taskList->get(2));
    }

    public function testSortByIdAscendingOrder(): void
    {
        $this->task1->name = "Write test";
        $this->task1->id = 4; // 1. in order
        
        $this->task2->name = "Run test";
        $this->task2->id = 17; // 2. in order
        
        $this->task3->name = "Write code";
        $this->task3->id = 34; // 3. in order

        $this->taskList->add($this->task2);
        $this->taskList->add($this->task3);
        $this->taskList->add($this->task1);

        $this->taskList->sortById();

        $this->assertSame($this->task1, $this->taskList->get(0));
        $this->assertSame($this->task2, $this->taskList->get(1));
        $this->assertSame($this->task3, $this->taskList->get(2));
    }

    public function testExceptionThrownFromSortByWhenColumnInvalid(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("The column does not exist");

        $this->taskList = new TaskList();
        $this->taskList->sortBy("category");
    }

    public function testSortByWhenColumnIsValid(): void
    {
        $this->task1->name = "Write test"; // 3. NAME in order
        $this->task1->id = 3; // 1. ID in order

        $this->task2->name = "Run test"; // 1. NAME in order
        $this->task2->id = 16; // 2. ID in order

        $this->task3->name = "Write code";// 2. NAME in order
        $this->task3->id = 33; // 3. ID in order

        $this->taskList->add($this->task3);
        $this->taskList->add($this->task2);
        $this->taskList->add($this->task1);

        $this->taskList->sortBy("id");

        $this->assertSame($this->task1, $this->taskList->get(0));
        $this->assertSame($this->task2, $this->taskList->get(1));
        $this->assertSame($this->task3, $this->taskList->get(2));

        $this->taskList->sortBy("name");

        $this->assertSame($this->task2, $this->taskList->get(0));
        $this->assertSame($this->task3, $this->taskList->get(1));
        $this->assertSame($this->task1, $this->taskList->get(2));
    }
}