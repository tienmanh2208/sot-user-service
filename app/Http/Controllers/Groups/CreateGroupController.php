<?php

namespace App\Http\Controllers\Groups;

use App\Enums\GroupPrivacy;
use App\Http\Controllers\Controller;
use App\Models\Group;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CreateGroupController extends Controller
{
    protected $group;

    public function __construct(Group $group)
    {
        $this->group = $group;
    }

    /**
     * @param Request $request
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function main(Request $request)
    {
        $params = $this->getParams($request);

        $validation = Validator::make($params, $this->rules());

        if ($validation->fails()) {
            return [
                'code' => 400,
                'message' => $validation->errors()->first()
            ];
        }

        $this->group->createGroup($params);

        return response()->json([
            'code' => 203,
            'message' => trans('group.create_group_successfully')
        ]);
    }

    /**
     * @param Request $request
     * @return array
     */
    protected function getParams(Request $request)
    {
        return $request->only(['title', 'default_coin', 'privacy']);
    }

    protected function rules()
    {
        return [
            'title' => 'required|string',
            'default_coin' => 'required|integer|gte:0',
            'privacy' => ['required', new EnumValue(GroupPrivacy::class, false)],
        ];
    }
}
