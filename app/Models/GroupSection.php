<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class GroupSection extends Model
{
    protected $table = 'group_sections';

    protected $fillable = [
        'group_infos_id',
        'name',
        'description',
        'question_count'
    ];

    /**
     * Create sections for group
     * 
     * @param array $sections
     * @param integer $groupId
     */
    public function createSectionsForGroup(array $sections, int $groupId)
    {
        $currentTime = Carbon::now();
        $defaultDescriptionForSection = 'This section does not have description yet';
        $queryCreateSections = [];

        for ($i = 0; $i < count($sections); ++$i) {
            array_push($queryCreateSections, [
                'group_infos_id' => $groupId,
                'name' => $sections[$i],
                'description' => $defaultDescriptionForSection,
                'created_at' => $currentTime,
                'updated_at' => $currentTime,
            ]);
        }

        $this->insert($queryCreateSections);
    }

    /**
     * Get list section of a group
     * 
     * @param integer $groupId
     */
    public function getListSection(int $groupId)
    {
        return $this->where('group_infos_id', $groupId)
            ->get([
                'id',
                'group_infos_id',
                'name',
                'description',
            ])
            ->toArray();
    }
}
