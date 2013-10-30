<?php

class TestCase extends Illuminate\Foundation\Testing\TestCase {

    /**
     * Set up the test and initialize test migrations
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->setUpDatabase();
    }

    /**
     * Creates the application.
     *
     * @return Symfony\Component\HttpKernel\HttpKernelInterface
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
    public function setUpDatabase()
    {
        Artisan::call('migrate');
        Artisan::call('db:seed');
    }

}
