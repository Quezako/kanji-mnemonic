<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\KanjiCodesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\KanjiCodesTable Test Case
 */
class KanjiCodesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\KanjiCodesTable
     */
    public $KanjiCodes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.KanjiCodes'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('KanjiCodes') ? [] : ['className' => KanjiCodesTable::class];
        $this->KanjiCodes = TableRegistry::getTableLocator()->get('KanjiCodes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->KanjiCodes);

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
