<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Team Entity
 *
 * @property int $id
 * @property string $name
 * @property string $shortName
 * @property string $tla
 * @property string $crest
 * @property string $address
 * @property string $website
 * @property int $founded
 * @property string $clubColors
 * @property string $venue
 * @property \Cake\I18n\FrozenTime $lastUpdated
 */
class Team extends Entity
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
        'name' => true,
        'shortName' => true,
        'tla' => true,
        'crest' => true,
        'address' => true,
        'website' => true,
        'founded' => true,
        'clubColors' => true,
        'venue' => true,
        'lastUpdated' => true,
    ];
}
