<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Kanji Entity
 *
 * @property string $ucs
 * @property string $kanji
 * @property int|null $jlpt
 * @property int|null $grade
 * @property int|null $strokes
 * @property string $data
 */
class Kanji extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'kanji' => true,
        'jlpt' => true,
        'grade' => true,
        'strokes' => true,
        'data' => true
    ];
}
