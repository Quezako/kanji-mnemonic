<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\KanjiMeaningsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\KanjiMeaningsTable Test Case
 */
class KanjiMeaningsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\KanjiMeaningsTable
     */
    public $KanjiMeanings;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.KanjiMeanings'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('KanjiMeanings') ? [] : ['className' => KanjiMeaningsTable::class];
        $this->KanjiMeanings = TableRegistry::getTableLocator()->get('KanjiMeanings', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->KanjiMeanings);

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
