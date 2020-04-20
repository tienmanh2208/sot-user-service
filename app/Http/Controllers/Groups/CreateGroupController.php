<?php

namespace App\Http\Controllers\Groups;

use App\Enums\GroupPrivacy;
use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\GroupSection;
use App\Models\UserGroup;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CreateGroupController extends Controller
{
    protected $group;
    protected $userGroup;
    protected $groupSection;

    public function __construct(
        Group $group,
        UserGroup $userGroup,
        GroupSection $groupSection
    ) {
        $this->group = $group;
        $this->userGroup = $userGroup;
        $this->groupSection = $groupSection;
    }

    /**
     * @param Request $request
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function main(Request $request)
    {
        try {
            $params = $this->getParams($request);

            $validation = Validator::make($params, $this->rules());

            if ($validation->fails()) {
                return [
                    'code' => 400,
                    'message' => $validation->errors()->first()
                ];
            }

            DB::beginTransaction();
            $this->createGroup($params);
            DB::commit();

            return response()->json([
                'code' => 203,
                'message' => trans('group.create_group_successfully')
            ]);
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'code' => 400,
                'message' => trans('server_response.server_error'),
            ], 200);
        }
    }

    /**
     * Create group and all relevant info
     * 
     * @param array $params [
     *  'title',
     *  'default_coin',
     *  'privacy',
     *  'sections'
     * ]
     */
    protected function createGroup(array $params)
    {
        $groupInfo = $this->group->createGroup($params);
        $this->userGroup->createUserGroupForAdmin($groupInfo->id);
        $this->groupSection->createSectionsForGroup($params['sections'], $groupInfo->id);
    }

    /**
     * @param Request $request
     * @return array
     */
    protected function getParams(Request $request)
    {
        return $request->only(['title', 'default_coin', 'privacy', 'sections']);
    }

    protected function rules()
    {
        return [
            'title' => 'required|string',
            'default_coin' => 'required|integer|gte:0',
            'privacy' => ['required', new EnumValue(GroupPrivacy::class, false)],
            'sections' => 'array',
            'sections.*' => 'string',
        ];
    }
}
