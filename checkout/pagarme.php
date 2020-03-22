<?php
require("vendor/autoload.php");
$pagarme = new PagarMe\Client('SUA_CHAVE_DE_API');

$subscription = $pagarme->subscriptions()->create([
  'plan_id' => 123456,
  'card_id' => 'card_abc123456',
  'payment_method' => 'credit_card',
  'postback_url' => 'http://www.pudim.com.br',
  'customer' => [
    'email' => 'time@unix.com',
    'name' => 'Unix Time',
    'document_number' => '75948706036',
    'address' => [
      'street' => 'Rua de Teste',
      'street_number' => '100',
      'complementary' => 'Apto 666',
      'neighborhood' => 'Bairro de Teste',
      'zipcode' => '88370801'
    ],
    'phone' => [
      'ddd' => '01',
      'number' => '923456780'
    ],
    'sex' => 'other',
    'born_at' => '1970-01-01',
  ],
  'amount' => 10000,
  'split_rules' => [
    [
      'recipient_id' => 're_abc1234abc1234abc1234abc1',
      'percentage' => 20,
      'liable' => true,
      'charge_processing_fee' => true,
    ],
    [
      'recipient_id' => 're_abc1234abc1234abc1234abc1',
      'percentage' => 80,
      'liable' => true,
      'charge_processing_fee' => true,
    ]
  ],
  'metadata' => [
    'foo' => 'bar'
  ]
]);