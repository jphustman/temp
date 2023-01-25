<?php

namespace Controller;

use StipItemFundingModel;

class ConstController extends BaseController
{
    public function getStipYear()
    {
        $stipModel = new StipItemFundingModel();
        $stipYear = $stipModel->getStipYear();

        return $stipYear[0]['STIP_YEAR'];
    }

    public function getFFY()
    {
        $stipModel = new StipItemFundingModel();
        $stipFFY = $stipModel->getFFY();

        return $stipFFY[0]['FFY'];
    }
}
