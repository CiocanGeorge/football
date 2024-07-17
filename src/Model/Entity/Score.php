<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Score Entity
 *
 * @property int $id
 * @property int $match_id
 * @property string|null $winner
 * @property string|null $duration
 * @property int|null $full_time_home
 * @property int|null $full_time_away
 * @property int|null $half_time_home
 * @property int|null $half_time_away
 *
 * @property \App\Model\Entity\Match $match
 */
class Score extends Entity
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
        'match_id' => true,
        'winner' => true,
        'duration' => true,
        'full_time_home' => true,
        'full_time_away' => true,
        'half_time_home' => true,
        'half_time_away' => true,
        'match' => true,
    ];
}
