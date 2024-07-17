<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Competition Entity
 *
 * @property int $id
 * @property int $area_id
 * @property string $name
 * @property string $code
 * @property string $type
 * @property string $emblem
 * @property string $plan
 * @property int $current_season_id
 * @property int $number_of_available_seasons
 * @property \Cake\I18n\FrozenTime $last_updated
 *
 * @property \App\Model\Entity\Area $area
 * @property \App\Model\Entity\CurrentSeason $current_season
 */
class Competition extends Entity
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
        'area_id' => true,
        'name' => true,
        'code' => true,
        'type' => true,
        'emblem' => true,
        'plan' => true,
        'current_season_id' => true,
        'number_of_available_seasons' => true,
        'last_updated' => true,
        'area' => true,
        'current_season' => true,
    ];
}
