<?php
namespace Pensoft\Restcoast\Models;

use Model;

class SiteThreatImpactEntry extends Model
{
    // Enable timestamps if needed
    public $timestamps = true;

    // The database table used by the model
    public $table = 'restcoast_site_threat_impact_entries';


    public $rules = [
        'name' => 'required',
    ];

    public $jsonable = ['content_blocks', 'outcomes'];

    public $translatable = [
        'name',
        'short_description',
        'content_blocks',
    ];

    protected $fillable = [
        'name',
        'short_description',
        'content_blocks',
    ];

    // Define the relationship
    public $belongsTo = [
        'site' => [
            Site::class,
            'key' => 'site_id'
        ],
        'threat_definition' => [
            ThreatDefinition::class,
            'key' => 'threat_definition_id'
        ]
    ];

    public $hasMany = [
        'measure_impact_entries' => [
            ThreatMeasureImpactEntry::class,
            'key' => 'site_threat_impact_id'
        ]
    ];

    public function listRelatedMeasureImpactEntries() {
        return $this->measure_impact_entries->pluck('name', 'id')
            ->toArray();
    }

}