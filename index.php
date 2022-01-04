<?php

use neha0921\SubstrateInterfacePackage\SubstrateInterface;

require_once __DIR__.'/vendor/autoload.php';

$testClass = new SubstrateInterface("http://127.0.0.1:8000");

echo "Name :: ". $testClass->rpc->system->name().'<br>';

echo "chain :: ". $testClass->rpc->system->chain().'<br>';

$responseData = json_decode($testClass->rpc->keypair->create([12]),true);

$ss58_address = $responseData['data']['ss58_address'];
$menemonic = $responseData['data']['mnemonic'];
$message = "Test my Keypair";
$FetchSign = json_decode($testClass->rpc->keypair->sign([$menemonic, $message]),true);

$signature = $FetchSign['data']['signature'];

$params = array($ss58_address,$message,$signature);

$isVerify = json_decode($testClass->rpc->keypair->verify($params),true);

print_r($isVerify);

?>