<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * KanjiRadical Entity
 *
 * @property int $id
 * @property string $ucs
 * @property int $radical_id
 * @property int|null $kanji_grade
 * @property int|null $kanji_strokes
 *
 * @property \App\Model\Entity\Radical $radical
 */
class KanjiRadical extends Entity
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
        'ucs' => true,
        'radical_id' => true,
        'kanji_grade' => true,
        'kanji_strokes' => true,
        'radical' => true
    ];
}
