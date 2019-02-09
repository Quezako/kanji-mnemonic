<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AlikeTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AlikeTable Test Case
 */
class AlikeTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\AlikeTable
     */
    public $Alike;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Alike'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Alike') ? [] : ['className' => AlikeTable::class];
        $this->Alike = TableRegistry::getTableLocator()->get('Alike', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Alike);

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
