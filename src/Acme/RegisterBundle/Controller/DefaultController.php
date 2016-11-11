<?php

namespace Acme\RegisterBundle\Controller;

use AppBundle\Controller\BaseController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends BaseController
{
    /**
     * @Route("/", name="register")
     */
    public function indexAction()
    {
        $account = $this->input('account', '', 'strip_tags');
        $passwd = $this->input('passwd', '', 'string');

        return $this->Rjson(200, 'heheda');
    }
}