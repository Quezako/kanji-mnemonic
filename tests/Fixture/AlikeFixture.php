<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * AlikeFixture
 *
 */
class AlikeFixture extends TestFixture
{

    /**
     * Table name
     *
     * @var string
     */
    public $table = 'alike';

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'reference' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'hanzi' => ['type' => 'binary', 'length' => 255, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        '_indexes' => [
            'references' => ['type' => 'index', 'columns' => ['reference'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'new_fk_constraint' => ['type' => 'foreign', 'columns' => ['reference'], 'references' => ['chmn', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
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
                'reference' => 1,
                'hanzi' => 'Lorem ipsum dolor sit amet'
            ],
        ];
        parent::init();
    }
}
