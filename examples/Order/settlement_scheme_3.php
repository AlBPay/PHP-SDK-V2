<?php
require_once '../configuration.php';
require_once SDK_ROOTPATH . '/../vendor/autoload.php';


//Split order
try {
    \Cloudipsp\Configuration::setMerchantId(600001);
    //Generating pcidss order to capture see more https://documentation.albpay.io/docs/page/4/
    $TestOrderData = [
        'order_id' => 'settelment_' . time(),
        'card_number' => '4444555511116666',
        'cvv2' => '333',
        'expiry_date' => '1232',
        'currency' => 'USD',
        'preauth' => 'Y',
        'amount' => 1000,
        'client_ip' => '127.2.2.1'
    ];
    //Call method to generate order for capture
    $captured_order_data = Cloudipsp\Pcidss::start($TestOrderData); //next order will be captured
    //Minimal data set, all other required params will generated automatically
    $data = [
        'currency' => 'USD',
        'amount' => 1000, // convert to 10.00$
        'order_desc' => 'tests SDK',
        'operation_id' => $TestOrderData['order_id']
    ];
    //some other params
    $receiver = [
        [
            'requisites' => [
                'amount' => 500,
                'merchant_id' => 600001
            ],
            'type' => 'merchant'
        ],
        [
            'requisites' => [
                'amount' => 500,
                'merchant_id' => 700001
            ],
            'type' => 'merchant'
        ]
    ];
    $data['receiver'] = $receiver;
    //Call method to generate url
    \Cloudipsp\Configuration::setApiVersion('2.0');
    $url = Cloudipsp\Order::settlement($data);
    //getting returned data
    ?>
    <!doctype html>
    <html lang="en-US">
    <head>
        <meta charset="UTF-8">
        <title>Capture pre-purchase</title>
        <style>
            table tr td, table tr th {
                padding: 10px;
            }
        </style>
    </head>
    <body>
    <table style="margin: auto;" border="1">
        <thead>
        <tr>
            <th style="text-align: center" colspan="2">Request Data</th>
        </tr>
        <tr>
            <th style="text-align: left"
                colspan="2"><?php printf("<pre>%s</pre>", json_encode(['request' => $data], JSON_PRETTY_PRINT)) ?></th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>Normal Response:</td>
            <td>
                <pre><?php print_r($url->getData()) ?></pre>
            </td>
        </tr>
        </tbody>
    </table>
    </body>
    </html>
    <?php
} catch (\Exception $e) {
    echo "Fail: " . $e->getMessage();
}
