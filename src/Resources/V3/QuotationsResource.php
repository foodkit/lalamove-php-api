<?php

namespace Lalamove\Resources\V3;

use Lalamove\Resources\AbstractResource;
use Lalamove\Responses\QuotationResponse;

class QuotationsResource extends AbstractResource
{
    public function create()
    {
        // @todo: just for testing below, needs to be refactored
        $response = $this->send('POST', 'quotations', [
            'data' => [
                'serviceType' => 'MOTORCYCLE',
                'stops' => [
                    [
                        'coordinates' => [
                            'lat' => '13.735670897237226',
                            'lng' => '100.58139646034076',
                        ],
                        'address' => '105 Thong Lo 17 Alley, Khlong Tan Nuea, Watthana, Bangkok 10110',
                    ],
                    [
                        'coordinates' => [
                            'lat' => '13.724944769536547',
                            'lng' => '100.57959627957625',
                        ],
                        'address' => '97 99 Thong Lo Rd, Khlong Tan Nuea, Watthana, Bangkok 10110',
                    ],
                ],
                'language' => 'en_TH'
            ]
        ]);
        return new QuotationResponse($response);
    }
}