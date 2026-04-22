<?php
class Model_Core_Url
{
    public function getUrl($action = null, $controller = null, $params = [], $reset = false)
    {
        $request = Mage::getModel('core/request');
        $finalParams = [];

        if (!$reset) {
            parse_str($_SERVER['QUERY_STRING'], $finalParams);
        }

        $controller = $controller ?: $request->get('c');
        $action = $action ?: $request->get('a');

        if ($params) {
            foreach ($params as $key => $value) {
                $finalParams[$key] = $value;
            }
        }

        $finalParams['c'] = $controller;
        $finalParams['a'] = $action;
        foreach ($finalParams as $key => $value) {

            if ($value === null) {
                unset($finalParams[$key]);
            }
        }
        $url = $this->getBaseUrl("index.php?" . http_build_query($finalParams));
        return $url;
    }

    public function getBaseUrl($subpath = null)
    {
        return Mage::getBaseUrl($subpath);
    }


}
?>