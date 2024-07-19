<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Prediction Entity
 *
 * @property int $id
 * @property int $matchId
 * @property string|null $over2
 * @property string|null $under2
 * @property string|null $over0
 * @property string|null $under0
 */
class Prediction extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected $_accessible = [
        'matchId' => true,
        'over2' => true,
        'under2' => true,
        'over0' => true,
        'under0' => true,
        'over1' => true,
        'under1' => true,
        'over0FirstHalf' => true,
        'under0FirstHalf' => true,
        'gg' => true,
    ];
}
