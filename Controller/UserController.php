<?php

namespace Controller;

use UserFactory;

class UserController extends BaseController
{

    public function register()
    {

    }

    public function listall()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $arrQueryStringParams = $this->getQueryStringParams();
        if (strtoupper($requestMethod) == 'GET') {
            try {
                $userFactory = new UserFactory();
                $intLimit = 10;
                if (isset($arrQueryStringParams['limit']) && $arrQueryStringParams['limit']) {
                    $intLimit = $arrQueryStringParams['limit'];
                }
                $arrUsers = $userFactory->getAllUsers($intLimit);
                $responseData = json_encode($arrUsers);
            } catch (Error $e) {
                $strErrorDesc = $e->getMessage() . 'Something went wrong! Please contact support.';
                $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
            }
        } else {
            $strErrorDesc = 'Method not supported';
            $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
        }
        // send output
        if (!$strErrorDesc) {
            $this->sendOutput(
                $responseData,
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        } else {
            $this->sendOutput(json_encode(array('error' => $strErrorDesc)),
                array('Content-Type: application/json', $strErrorHeader)
            );
        }
    }

    public function signup()
    {


    }

    public function public()
    {
        $this->sendOutput(
            json_encode(['public']),
            array('Content-Type: application/json', 'HTTP/1.1 200 OK')
        );
    }

    public function user()
    {
        $this->sendOutput(
            json_encode(['user']),
            array('Content-Type: application/json', 'HTTP/1.1 200 OK')
        );
    }

    public function captain()
    {
        $this->sendOutput(
            json_encode(['captain']),
            array('Content-Type: application/json', 'HTTP/1.1 200 OK')
        );
    }

}
