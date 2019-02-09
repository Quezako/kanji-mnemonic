<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\KanjiTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\KanjiTable Test Case
 */
class KanjiTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\KanjiTable
     */
    public $Kanji;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Kanji'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Kanji') ? [] : ['className' => KanjiTable::class];
        $this->Kanji = TableRegistry::getTableLocator()->get('Kanji', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Kanji);

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
