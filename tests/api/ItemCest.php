<?php

class ItemCest
{

    public function checkAuthNotValid(ApiTester $I) {
        $I->amHttpAuthenticated('test', 'test2');
        $I->sendPost(
            'api/item',
            [
                'name'            => 'test 1',
                'price'           => 5.99,
            ]
        );
        $I->seeResponseCodeIs(401);
        $I->seeResponseIsJson();
        $I->seeResponseIsValidOnJsonSchemaString('{"type":"object"}');
    }

    public function listItems(ApiTester $I) {
        $I->sendGet('api/items');
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseIsValidOnJsonSchemaString('{"type":"array"}');
        $validResponseJsonSchema = json_encode(
            [
                'properties' => [
                    'id'          => ['type' => 'integer'],
                    'name'        => ['type' => 'string'],
                ]
            ]
        );
        $I->seeResponseIsValidOnJsonSchemaString($validResponseJsonSchema);
    }

    public function createItem(ApiTester $I) {
        $I->amHttpAuthenticated('test', 'test');
        $I->sendPost(
            'api/item',
            [
                'name'            => 'test 1',
                'price'           => 5.99,
            ]
        );
        $I->seeResponseCodeIs(201);
        $I->seeResponseIsJson();
        $I->seeResponseIsValidOnJsonSchemaString('{"type":"object"}');
        $validResponseJsonSchema = json_encode(
            [
                'properties' => [
                    'id'          => ['type' => 'integer'],
                    'name'        => ['type' => 'string'],
                ]
            ]
        );
        $I->seeResponseIsValidOnJsonSchemaString($validResponseJsonSchema);
    }

    public function getItem(ApiTester $I) {
        $I->sendGet('api/item/1');
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseIsValidOnJsonSchemaString('{"type":"object"}');
        $validResponseJsonSchema = json_encode(
            [
                'properties' => [
                    'id'          => ['type' => 'integer'],
                    'name'        => ['type' => 'string'],
                ]
            ]
        );
        $I->seeResponseIsValidOnJsonSchemaString($validResponseJsonSchema);
    }

    public function UpdateItem(ApiTester $I) {
        $I->amHttpAuthenticated('test', 'test');
        $I->sendPut(
            'api/item/1',
            [
                'name'            => 'test 11',
                'price'           => 5.99,
            ]
        );
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseIsValidOnJsonSchemaString('{"type":"object"}');
        $validResponseJsonSchema = json_encode(
            [
                'properties' => [
                    'id'          => ['type' => 'integer'],
                    'name'        => ['type' => 'string'],
                ]
            ]
        );
        $I->seeResponseIsValidOnJsonSchemaString($validResponseJsonSchema);
    }

    public function DeleteItem(ApiTester $I) {
        $I->amHttpAuthenticated('test', 'test');
        $I->sendDelete('api/item/1');
        $I->seeResponseCodeIsSuccessful();
    }

}
