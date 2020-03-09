<?php


use Wedepa\Api\WedepaClient;

class WedepaClientTest extends PHPUnit\Framework\TestCase
{

    public function testPaymentCreate()
    {
        try {
            $client = new WedepaClient('kejhcnu9', 'BK2eelRk3aR1TPpjXhkCSkDDK7yfRDIR');
            print_r($client->payments->create([
                'method' => 'afterpay',
                'order_id' => $this->generateRandomString(4),
                'description' => $this->generateRandomString(16),
                'amount' => [
                    'currency' => 'EUR',
                    'value' => 10.12
                ],
                'url' => [
                    'return_url' => 'https://wedepa-test.com'
                ],
                'ip_address' => '193.131.45.153',
                'locale' => 'nl',
                'info' => [
                    'dob' => '03041987',
                    'sex' => 'm'
                ],
                'billing' => [
                    'company' => '',
                    'firstName' => 'Mark',
                    'lastName' => 'van Haaren',
                    'address1' => 'de Molenbeemd 20',
                    'address2' => '',
                    'zip' => '5066 DZ',
                    'city' => 'Moergestel',
                    'state' => 'Noord-Brabant',
                    'country' => 'NL',
                    'phone' => '0646210127',
                    'email' => 'mark.vanhaaren@live.nl'
                ],
                'shipping' => [
                    'company' => '',
                    'firstName' => 'Mark',
                    'lastName' => 'van Haaren',
                    'address1' => 'de Molenbeemd 20',
                    'address2' => '',
                    'zip' => '5066 DZ',
                    'city' => 'Moergestel',
                    'state' => 'Noord-Brabant',
                    'country' => 'NL',
                    'phone' => '0646210127',
                    'email' => 'mark.vanhaaren@live.nl'
                ],
                'products' => [
                    [
                        'sku' => 'test',
                        'name' => 'Test product',
                        'quantity' => 2,
                        'price' => 5.06,
                        'tax' => 21
                    ]
                ]
            ]));
        }
        catch (\Wedepa\Api\Exceptions\WedepaException $ex){
            print_r($ex->getWedepaCode());
            echo ' - ';
            print_r($ex->getWedepaMessage());
            echo ' - ';
            print_r($ex->getWedepaErrors());
        }
    }

    public function testPaymentGet()
    {
        try {
            $client = new WedepaClient('kejhcnu9', 'BK2eelRk3aR1TPpjXhkCSkDDK7yfRDIR');
            $payment = $client->payments->get('9000a07d-88b9-4dd7-9af1-bfdb0a8f0844');

            $this->assertTrue($payment instanceof \Wedepa\Api\Resources\Payment);
        }
        catch (\Wedepa\Api\Exceptions\WedepaException $ex){
            print_r($ex->getWedepaCode());
            echo ' - ';
            print_r($ex->getWedepaMessage());
            echo ' - ';
            print_r($ex->getWedepaErrors());
        }
    }

    private function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
