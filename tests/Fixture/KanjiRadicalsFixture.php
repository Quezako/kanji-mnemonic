<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * KanjiRadicalsFixture
 *
 */
class KanjiRadicalsFixture extends TestFixture
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
        'radical_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'kanji_grade' => ['type' => 'integer', 'length' => 4, 'unsigned' => false, 'null' => true, 'default' => '0', 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'kanji_strokes' => ['type' => 'integer', 'length' => 4, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'kanji_radicals_idx_ucs' => ['type' => 'index', 'columns' => ['ucs'], 'length' => []],
            'kanji_radicals_index_on_kanji_radical_grade' => ['type' => 'index', 'columns' => ['ucs', 'radical_id', 'kanji_grade'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'kanji_radicals_ucs_radical_id' => ['type' => 'unique', 'columns' => ['ucs', 'radical_id'], 'length' => []],
            'kanji_radicals_fk_ucs' => ['type' => 'foreign', 'columns' => ['ucs'], 'references' => ['kanji', 'ucs'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
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
                'radical_id' => 1,
                'kanji_grade' => 1,
                'kanji_strokes' => 1
            ],
        ];
        parent::init();
    }
}
