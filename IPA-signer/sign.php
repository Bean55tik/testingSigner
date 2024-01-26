<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

$ipa = $_GET['ipa'];
$p12 = $_GET['p12'];
$mobileprovision = $_GET['mobileprovision'];
$password = $_GET['pass'];

// Upload IPA
$curl = curl_init('https://api.starfiles.co/upload/upload_file');
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: multipart/form-data'));
curl_setopt($curl, CURLOPT_POSTFIELDS, array('upload' => $ipa));
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$output = curl_exec($curl);
$output_decoded = json_decode($output, true);
if(!isset($output_decoded['file']))
    die('Failed ' . __LINE__ . ': ' . $output);
$ipa_output = $output_decoded['file'];
curl_close($curl);

// Upload P12
$curl = curl_init('https://api.starfiles.co/upload/upload_file');
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: multipart/form-data'));
curl_setopt($curl, CURLOPT_POSTFIELDS, array('upload' => $p12));
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$output = curl_exec($curl);
$output_decoded = json_decode($output, true);
if(!isset($output_decoded['file']))
    die('Failed ' . __LINE__ . ': ' . $output);
$p12_output = $output_decoded['file'];
curl_close($curl);

// Upload Mobileprovision
$curl = curl_init('https://api.starfiles.co/upload/upload_file');
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: multipart/form-data'));
curl_setopt($curl, CURLOPT_POSTFIELDS, array('upload' => $mobileprovision));
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$output = curl_exec($curl);
$output_decoded = json_decode($output, true);
if(!isset($output_decoded['file']))
    die('Failed ' . __LINE__ . ': ' . $output);
$mobileprovision_output = $output_decoded['file'];
curl_close($curl);

// Sign
header('Location: ' . file_get_contents('https://sign.starfiles.co?ipa=' . $ipa_output . '&p12=' . $p12_output . '&mobileprovision=' . $mobileprovision_output . '&password=' . $password));
