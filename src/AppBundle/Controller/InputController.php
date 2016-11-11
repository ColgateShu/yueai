<?php
/**
 * Created by PhpStorm.
 * User: colgate
 * Date: 2016-11-09
 * Time: 17:26
 */

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;

class InputController
{
    protected $input;
    protected $data;

    /**
     * InputController constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->input = $request->getContent(false);
        return $this->handsData();
    }

    /**
     * @return mixed
     */
    public function getInput()
    {
        return $this->input;
    }

    /**
     * @return $this
     */
    private function handsData()
    {
        $this->data = (array)json_decode($this->input, true);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    public function input($key = '', $default = '', $func = '')
    {
        $ret = '';
        if(!$key)
            return $this->data;
        if (isset($this->data[$key])) {
            $ret = $this->data[$key];
        } else {
            return $default;
        }
        if (is_string($func)) {
            if (in_array($func, ['int', 'string', 'array'])) {
                settype($ret, $func);
                return $ret;
            }
            if ($func)
                #字符串时用该参数运行，以即将得到的
                $ret = call_user_func($func, $ret);
        } elseif (is_array($func)) {
            if ($func)
                $ret = call_user_func_array($func, [$ret]);
        }
        if (!$ret)
            return $default;
        return $ret;
    }

}