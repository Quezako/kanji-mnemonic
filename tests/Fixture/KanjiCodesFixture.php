<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * KanjiCodesFixture
 *
 */
class KanjiCodesFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'ucs' => ['type' => 'string', 'length' => 6, 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'section' => ['type' => 'string', 'length' => 16, 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'type' => ['type' => 'string', 'length' => 16, 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'value' => ['type' => 'string', 'length' => 16, 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        '_indexes' => [
            'kanji_codes_idx_ucs' => ['type' => 'index', 'columns' => ['ucs'], 'length' => []],
            'kc_index_on_type_value' => ['type' => 'index', 'columns' => ['type', 'value'], 'length' => []],
            'kc_index_on_section_type_value' => ['type' => 'index', 'columns' => ['section', 'type', 'value'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'kanji_codes_fk_ucs' => ['type' => 'foreign', 'columns' => ['ucs'], 'references' => ['kanji', 'ucs'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'latin1_swedish_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Init method
     *
     * @return void
     */
    public function init()
    {
        $this->records = [
            [
                'id' => 1,
                'ucs' => 'Lore',
                'section' => 'Lorem ipsum do',
                'type' => 'Lorem ipsum do',
                'value' => 'Lorem ipsum do'
            ],
        ];
        parent::init();
    }
}
