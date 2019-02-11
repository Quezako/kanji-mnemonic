<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\IdsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\IdsTable Test Case
 */
class IdsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\IdsTable
     */
    public $Ids;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Ids'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Ids') ? [] : ['className' => IdsTable::class];
        $this->Ids = TableRegistry::getTableLocator()->get('Ids', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Ids);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
