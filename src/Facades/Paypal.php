<?php
namespace XSTech\L5Paypal\Facades;

use Illuminate\Support\Facades\Facade;

class Paypal extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'l5paypal';
    }
}
?>
