<?php

namespace App\Services;

class QuestionService
{
    protected $logService;
    protected $guzzleService;

    public function __construct(LogService $logService, GuzzleService $guzzleService)
    {
        $this->logService = $logService;
        $this->guzzleService = $guzzleService;
    }

    /**
     * Get newest question
     */
    public function getNewestQuestion($fieldId)
    {
        if (is_null($fieldId)) {
            $uri = '/api/questions/all';
        } else {
            $uri = '/api/questions/all?field_id=' . $fieldId;
        }

        $response = $this->guzzleService->get($uri);

        if ($response->code != 200) {
            return [
                'code' => 400,
                'message' => trans('server_response.server_error'),
            ];
        }

        return [
            'code' => 200,
            'data' => $response->data,
        ];
    }
}
