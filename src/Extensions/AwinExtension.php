<?php
namespace HobeaDe\Extensions;

use Plenty\Plugin\Templates\Extensions\Twig_Extension;
use Plenty\Plugin\Templates\Factories\TwigFactory;
use Plenty\Modules\Item\Item\Contracts\ItemRepositoryContract;


class AwinExtension extends Twig_Extension
{

    private $factory;

    public function __construct(TwigFactory $factory,  ItemRepositoryContract $contract  )
    {
        $this->factory = $factory;
    }

    public function getName(): string
    {
        return "HobeaDe_Awin";
    }

    public function getFunctions(): array
    {
      return [
        $this->factory->createSimpleFunction('trackAwin', [$this, 'trackAwin'])
      ];
    }

    public function trackAwin($orderData, $couponValue)
    {
      if( empty($couponValue) ){
        $couponValue = '';
      }
      if( !empty($orderData) ){
        $awc_cks=isset($_COOKIE['awc_cks']) ? $_COOKIE['awc_cks'] : ''; //read the cookie written by advertiser
        $url = "https://www.awin1.com/sread.php?tt=ss&tv=2&merchant=17349";
        $url .= "&amount=" . $orderData.amounts[0].netTotal;
        $url .= "&ch=";
        $url .= "aw"; // If the conversion does not belong to a specific channel according your measures
        if (isset($awc_cks)) {
        $url .= "&cks=" . $awc_cks; // Populate the Awin click checksum if one is associated with the conversion
        }
        $url .= "&cr=" . $orderData.amounts[0].currency;
        $url .= "&ref=" . $orderData.id;
        $url .= "&parts=S0001:" . $orderData.amounts[0].netTotal;
        $url .= "&testmode=0&vc=" . $couponValue;
        $c = curl_init();
        curl_setopt($c, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($c, CURLOPT_URL, $url);
        curl_exec($c);
        curl_close($c);

        return true;
      }
      return false;
    }
}