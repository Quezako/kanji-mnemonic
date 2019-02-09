<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\KanjiReadingsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\KanjiReadingsTable Test Case
 */
class KanjiReadingsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\KanjiReadingsTable
     */
    public $KanjiReadings;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.KanjiReadings'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('KanjiReadings') ? [] : ['className' => KanjiReadingsTable::class];
        $this->KanjiReadings = TableRegistry::getTableLocator()->get('KanjiReadings', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->KanjiReadings);

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
