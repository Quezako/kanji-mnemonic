<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ChmnTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ChmnTable Test Case
 */
class ChmnTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ChmnTable
     */
    public $Chmn;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Chmn'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Chmn') ? [] : ['className' => ChmnTable::class];
        $this->Chmn = TableRegistry::getTableLocator()->get('Chmn', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Chmn);

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
