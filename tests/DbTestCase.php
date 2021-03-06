<?php

use Winter\Storm\Database\Model;
use Winter\Storm\Database\Pivot;
use Illuminate\Database\Capsule\Manager as CapsuleManager;
use Winter\Storm\Events\Dispatcher;

class DbTestCase extends TestCase
{
    public function setUp()
    {
        $this->db = new CapsuleManager;
        $this->db->addConnection([
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => ''
        ]);

        $this->db->setAsGlobal();
        $this->db->bootEloquent();

        Model::setEventDispatcher(new Dispatcher());
    }

    public function tearDown()
    {
        $this->flushModelEventListeners();
        parent::tearDown();
        unset($this->db);
    }

    /**
     * The models in Winter use a static property to store their events, these
     * will need to be targeted and reset ready for a new test cycle.
     * Pivot models are an exception since they are internally managed.
     * @return void
     */
    protected function flushModelEventListeners()
    {
        foreach (get_declared_classes() as $class) {
            // get_declared_classes() includes aliased classes, aliased classes are automatically lowercased
            // @https://bugs.php.net/bug.php?id=80180
            if ($class === Pivot::class || strtolower($class) === 'october\rain\database\pivot') {
                continue;
            }

            $reflectClass = new ReflectionClass($class);
            if (
                !$reflectClass->isInstantiable() ||
                !$reflectClass->isSubclassOf(Model::class) ||
                $reflectClass->isSubclassOf(Pivot::class)
            ) {
                continue;
            }

            $class::flushEventListeners();
        }

        Model::flushEventListeners();
    }
}
