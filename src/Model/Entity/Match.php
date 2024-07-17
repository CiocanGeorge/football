<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Match Entity
 *
 * @property int $id
 * @property \Cake\I18n\FrozenTime $utc_date
 * @property string $status
 * @property int|null $matchday
 * @property string|null $stage
 * @property \Cake\I18n\FrozenTime $last_updated
 * @property int $home_team_id
 * @property int $away_team_id
 * @property int $area_id
 * @property int $competition_id
 * @property int $season_id
 *
 * @property \App\Model\Entity\Area $area
 * @property \App\Model\Entity\Competition $competition
 */
class Matches extends Entity
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
        'utcDate' => true,
        'status' => true,
        'matchday' => true,
        'stage' => true,
        'lastUpdated' => true,
        'homeTeamId' => true,
        'awayTeamId' => true,
        'areaId' => true,
        'competitionId' => true,
        'seasonId' => true,
        'homeName' => true,
        'awayName' => true,
        'homeLogo' => true,
        'awayLogo' => true,
    ];
}
