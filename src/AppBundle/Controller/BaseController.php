<?php
/**
 * Created by PhpStorm.
 * User: colgate
 * Date: 2016-11-09
 * Time: 17:22
 */

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class BaseController extends Controller
{
    protected $new_token;
    /**
     * @return mixed
     */
    public function input()
    {
        return call_user_func_array([$this->get('input'), 'input'], func_get_args());
    }

    /**
     * @return bool
     */
    public function isLogin()
    {
        $token = $this->get('input')->input('token', '');
        if (!$token)
            return false;
        $redis = $this->get('redis')->get('token:' . $token);
        if (is_null($redis)) {
            return false;
        }
        return true;
    }

    protected function Rjson($code, $arr=array())
    {
        $output['code'] = (int)$code;

        if ($this->new_token) {
            $output['token'] = $this->new_token;
        }
        if (isset($arr['msg'])) {
            $output['msg'] = $arr['msg'];
            unset($arr['msg']);
        }
        if (is_string($arr)) {
            $output['msg'] = $arr;
        }
        if (!empty($arr) && is_array($arr)) {
            $output['data'] = (array)$arr;
        }
        /*array_unshift($post, $this->request);
        F('post', $post);
        if (SOURCE == 3) {
            cors();
            echo json_encode($output, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
            exit;
        }*/
//        header("Content-type: application/json");
//        echo json_encode($output, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
//        exit;
        return $this->json($output);
    }
}