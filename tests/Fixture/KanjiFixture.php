<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * KanjiFixture
 *
 */
class KanjiFixture extends TestFixture
{

    /**
     * Table name
     *
     * @var string
     */
    public $table = 'kanji';

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'ucs' => ['type' => 'string', 'length' => 6, 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'kanji' => ['type' => 'string', 'length' => 8, 'null' => false, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'jlpt' => ['type' => 'integer', 'length' => 4, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'grade' => ['type' => 'integer', 'length' => 4, 'unsigned' => false, 'null' => true, 'default' => '0', 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'strokes' => ['type' => 'integer', 'length' => 4, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'data' => ['type' => 'text', 'length' => null, 'null' => false, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'comment' => '', 'precision' => null],
        '_indexes' => [
            'kanji_index_on_kanji' => ['type' => 'index', 'columns' => ['kanji'], 'length' => []],
            'kanji_index_on_jlpt' => ['type' => 'index', 'columns' => ['jlpt'], 'length' => []],
            'kanji_index_on_grade' => ['type' => 'index', 'columns' => ['grade'], 'length' => []],
            'kanji_index_on_jlpt_grade' => ['type' => 'index', 'columns' => ['jlpt', 'grade'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['ucs'], 'length' => []],
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
                'ucs' => 'f3490ffe-f646-4715-adcb-a1ec1b8f543e',
                'kanji' => 'Lorem ',
                'jlpt' => 1,
                'grade' => 1,
                'strokes' => 1,
                'data' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.'
            ],
        ];
        parent::init();
    }
}
