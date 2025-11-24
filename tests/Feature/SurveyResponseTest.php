<?php

namespace Tests\Feature;

use Tests\TestCase;

class SurveyResponseTest extends TestCase
{

    public function test_external_survey_endpoint_returns_400_on_empty_body_request(): void
    {
        $response = $this->post('/api/external/survey-responses/system-a');
        $response->assertStatus(400);
    }
}
