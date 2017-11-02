<?php
namespace XSTech\L5Paypal;

use Illuminate\Support\Facades\URL;
use PayPal\Api\Address;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Authorization;
use PayPal\Api\Capture;
use PayPal\Api\CreditCard;
use PayPal\Api\CreditCardToken;
use PayPal\Api\FundingInstrument;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Links;
use PayPal\Api\Payee;
use PayPal\Api\Payer;
use PayPal\Api\PayerInfo;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\PaymentHistory;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Refund;
use PayPal\Api\RelatedResources;
use PayPal\Api\Sale;
use PayPal\Api\ShippingAddress;
use PayPal\Api\Transaction;
use PayPal\Api\Transactions;
use PayPal\Core\PayPalConfigManager;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;

use PayPal\Api\Agreement;
use PayPal\Api\Plan;
use PayPal\Api\PaymentDefinition;
use PayPal\Api\Currency;
use PayPal\Api\ChargeModel;
use PayPal\Api\MerchantPreferences;
use PayPal\Api\Patch;
use PayPal\Api\PatchRequest;
use PayPal\Common\PaypalModel;

class Paypal
{
    /**
     * @return \PayPal\Api\Agreement
     */
    public function Agreement()
    {
        return new Agreement;
    }

    public function Plan()
    {
        return new Plan;
    }

    public function PaymentDefinition()
    {
        return new PaymentDefinition;
    }

    public function Currency()
    {
        return new Currency;
    }

    public function ChargeModel()
    {
        return new ChargeModel;
    }

    public function MerchantPreferences()
    {
        return new MerchantPreferences;
    }

    public function Patch()
    {
        return new Patch;
    }

    public function PaypalModel($arguments)
    {
        return new PaypalModel($arguments);
    }

    public function PatchRequest()
    {
        return new PatchRequest;
    }

    /**
     * @return \PayPal\Api\Address
     */
    public function address()
    {
        return new Address;
    }

    /**
     * @return \PayPal\Api\Amount
     */
    public function amount()
    {
        return new Amount;
    }

    /**
     * @return \PayPal\Api\Details
     */
    public  function details()
    {
        return new Details;
    }

    /**
     * @return \PayPal\Api\Authorization
     */
    public  function authorization()
    {
        return new Authorization;
    }

    /**
     * @return \PayPal\Api\Capture
     */
    public  function capture()
    {
        return new Capture;
    }

    /**
     * @return \PayPal\Api\CreditCard
     */
    public  function creditCard()
    {
        return new CreditCard;
    }

    /**
     * @return \PayPal\Api\CreditCardToken
     */
    public  function creditCardToken()
    {
        return new CreditCardToken;
    }

    /**
     * @return \PayPal\Api\FundingInstrument
     */
    public  function fundingInstrument()
    {
        return new FundingInstrument;
    }

    /**
     * @return \PayPal\Api\Item
     */
    public  function item()
    {
        return new Item;
    }

    /**
     * @return \PayPal\Api\ItemList
     */
    public  function itemList()
    {
        return new ItemList;
    }

    /**
     * @return \PayPal\Api\Links
     */
    public  function links()
    {
        return new Links;
    }

    /**
     * @return \PayPal\Api\Payee
     */
    public  function payee()
    {
        return new Payee;
    }

    /**
     * @return \PayPal\Api\Payer
     */
    public  function payer()
    {
        return new Payer;
    }

    /**
     * @return \PayPal\Api\PayerInfo
     */
    public  function payerInfo()
    {
        return new PayerInfo;
    }

    /**
     * @return \PayPal\Api\Payment
     */
    public  function payment()
    {
        return new Payment;
    }

    /**
     * @return \PayPal\Api\PaymentExecution
     */
    public  function paymentExecution()
    {
        return new PaymentExecution;
    }

    /**
     * @return \PayPal\Api\PaymentHistory
     */
    public  function paymentHistory()
    {
        return new PaymentHistory;
    }

    /**
     * @return \PayPal\Api\RedirectUrls
     */
    public  function redirectUrls()
    {
        return new RedirectUrls;
    }

    /**
     * @return \PayPal\Api\Refund
     */
    public  function refund()
    {
        return new Refund;
    }

    /**
     * @return \PayPal\Api\RelatedResources
     */
    public  function relatedResources()
    {
        return new RelatedResources;
    }

    /**
     * @return \PayPal\Api\Sale
     */
    public  function sale()
    {
        return new Sale;
    }

    /**
     * @return \PayPal\Api\ShippingAddress
     */
    public  function shippingAddress()
    {
        return new ShippingAddress;
    }

    /**
     * @return \PayPal\Api\Transactions
     */
    public  function transactions()
    {
        return new Transactions;
    }

    /**
     * @return \PayPal\Api\Transaction
     */
    public function transaction()
    {
        return new Transaction;
    }

    /**
     * Create Paypal Restful ApiContext
     *
     * @param string|null $client_id
     * @param string|null $client_secret
     * @param string|null $request_id
     * @return \PayPal\Rest\ApiContext
     **/
    public function apiContext($client_id = null, $client_secret = null, $request_id = null)
    {
        $cred = null;
        if ($client_id || $client_secret) {
            $cred = new OAuthTokenCredential($client_id, $client_secret);
        }
        else {
            $cred = new OAuthTokenCredential(
                config('paypal.account.client_id'),
                config('paypal.account.client_secret')
            );
        }

        // Create context & load config automatically
        $context = new ApiContext($cred, $request_id);
        $context->setConfig([
            'mode' => config('paypal.mode'),
            'service.EndPoint' => config('paypal.mode') == 'sandbox' ? 'https://api.sandbox.paypal.com' : 'https://api.paypal.com',
            'http.ConnectionTimeOut' => config('paypal.http.timeout'),
            'log.LogEnabled' => config('paypal.log.enabled'),
            'log.FileName' => config('paypal.log.filename'),
            'log.LogLevel' => strtoupper(config('paypal.log.level')),
        ]);
        return $context;
    }

    /**
     * Get the base URL
     * @return mixed
     */
    public function getBaseUrl()
    {
        return URL::to('/');
    }

    /**
     * grape payment details using the paymentId
     * @param $paymentId
     * @param null $apiContext
     * @return \PayPal\Api\Payment
     */
    public static function getById($paymentId, $apiContext = null)
    {
        if (isset($apiContext)) {
            return Payment::get($paymentId, $apiContext);
        }
        return Payment::get($paymentId);
    }

    /**
     * grape all payment details
     * @param $param
     * @param null $apiContext
     * @return \PayPal\Api\Payment
     */
    public static function getAll($param, $apiContext = null)
    {
        if (isset($apiContext)) {
            return Payment::all($param, $apiContext);
        }
        return Payment::all($param);
    }
}
?>
