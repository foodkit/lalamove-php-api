<?php

declare(strict_types=1);

namespace LalamoveTests;

use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Lalamove\Requests\V3\Contact;
use Lalamove\Requests\V3\Item;
use Lalamove\Requests\V3\Order;
use Lalamove\Requests\V3\Quotation;
use LalamoveTests\Integration\UsesLalamoveApi;
use PHPUnit\Framework\TestCase;

abstract class BaseTest extends TestCase
{
    use UsesLalamoveApi;

    public function prepareQuotation(): Quotation
    {
        $item = new Item('3', 'LESS_THAN_3KG', [Item::CATEGORY_FOOD_DELIVERY], [Item::HANDLING_INSTRUCTIONS_KEEP_UPRIGHT]);
        $scheduledAt = (new Carbon())->addMinute(5);

        $quotation = Quotation::make($scheduledAt, 'en_TH', [
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
            [
                'coordinates' => [
                    'lat' => '13.728620407973413',
                    'lng' => '100.58076539679806',
                ],
                'address' => 'Staybridge Suites Bangkok Thonglor, an IHG Hotel',
            ]
        ], $item);

        return $quotation;
    }

    public function prepareOrder(): Order
    {
        $client = $this->getClient();

        $quotation = $this->prepareQuotation();

        $response = $client->quotations()->create($quotation);

        $sender = new Contact('test', '+6627460847', $response->getSenderStop()->stopId);
        
        $recipients = array_map(function ($stop) {
            return [
                'stopId' => $stop->stopId,
                'name' => 'name',
                'phone' => '+6622164978'
            ];
        }, $response->getRecipientStops());

        $order = new Order($response->quotationId, $sender, $recipients);

        return $order;
    }

    public function createClientMock($responseJSONFile): Client
    {
        // Create a mock and queue two responses.
        $mock = new MockHandler([
            new Response(200, ['X-Foo' => 'Bar'], json_encode(json_decode(file_get_contents(__DIR__ . "/{$responseJSONFile}.json"), true))),
        ]);

        $handlerStack = HandlerStack::create($mock);

        return new Client(['handler' => $handlerStack]);
    }
}