<?php

namespace Acme\SmscodeBundle\Controller;

use AppBundle\Controller\BaseController;
use Curl\Curl;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends BaseController
{
    protected $code;
    /**
     * @Route("/reg", name="acme_smscode")
     */
    public function regAction()
    {
        if (!$this->isLogin())
            return $this->Rjson(101, 'no login');
        $data['mobile'] = $this->input('phone');
        $sms_params = $this->container->getParameter('sms');
        $data['apikey'] = $sms_params['key'];
        $content = $this->createContent($sms_params['reg']);
        $data['text'] = $content;
        $curl = $this->get('curl');
//        $curl->post($sms_params['url'], $data);
//        if($curl->error_code !== 0)
//            return $this->Rjson(100, 'send faild');
        dump($curl);
        $sms_key = 'smscode:reg:'.$data['mobile'];
        $this->container->get('help')->saveRedis($sms_key, $this->code);
        return $this->Rjson(200);
    }

    private function send()
    {

    }

    /**
     * @return int
     */
    private function createRand()
    {
        return rand(1000, 9999);
    }

    private function createContent($content)
    {
        return str_replace("#code", $this->code = $this->createRand(), $content);
    }

}
