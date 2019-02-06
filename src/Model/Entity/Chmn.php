<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Chmn Entity
 *
 * @property int $id
 * @property string $number
 * @property string $hanzi
 * @property string $simplified
 * @property string $mnemonics
 * @property string $alike
 * @property bool $mine
 * @property string $meaning
 * @property string $reference
 * @property bool $remnant
 */
class Chmn extends Entity
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
        'number' => true,
        'hanzi' => true,
        'simplified' => true,
        'mnemonics' => true,
        'alike' => true,
        'mine' => true,
        'meaning' => true,
        'reference' => true,
        'remnant' => true
    ];
}
