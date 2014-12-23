<?php

class TestCase extends Illuminate\Foundation\Testing\TestCase {

    /**
     * Creates the application.
     *
     * @return \Symfony\Component\HttpKernel\HttpKernelInterface
     */
    public function createApplication()
    {
        $unitTesting = true;
        $testEnvironment = 'testing';
        return require __DIR__.'/../../bootstrap/start.php';
    }

    /**
     * Set up database for tests
     *
     * @return void
     */
    public function setUp()
    {
        Artisan::call('migrate');
        Artisan::call('db:seed');
    }

    protected function insertFood()
    {
        $food = new Food();
        $food->name = 'AllowedFood';
        $food->description = 'AllowedFood';
        $food->allowed = true;
        $food->allowed_moderation = true;
        $food->food_group_id = 4;
        $food->createdby = 1;
        $food->save();
    }

    protected function insertFoodInModeration()
    {
        $food = new Food();
        $food->name = 'AllowedInModerationFood';
        $food->description = 'AllowedInModerationFood';
        $food->allowed = false;
        $food->allowed_moderation = true;
        $food->food_group_id = 4;
        $food->createdby = 1;
        $food->save();
    }
}
