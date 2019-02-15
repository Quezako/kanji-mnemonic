<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MnemonicsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MnemonicsTable Test Case
 */
class MnemonicsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\MnemonicsTable
     */
    public $Mnemonics;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Mnemonics'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Mnemonics') ? [] : ['className' => MnemonicsTable::class];
        $this->Mnemonics = TableRegistry::getTableLocator()->get('Mnemonics', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Mnemonics);

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
