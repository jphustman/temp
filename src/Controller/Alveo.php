<?php

declare(strict_types=1);

namespace App\Controller;

use App\CustomResponse as Response;
use DI\Container;
use DI\DependencyException;
use DI\NotFoundException;
use Psr\Http\Message\ServerRequestInterface as Request;

use App\Models\AlveoExport;

final class Alveo
{
    private Container $container;
    private AlveoExport $alveoexport;
    private $db;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function import(Request $request, Response $response): Response
    {
        // Get the POST data
        $data = (array)$request->getParsedBody();

        // Split the data into an array of rows
        $rows = explode("\n", $data['data']);

        // Define the property names
        $keys = array(
            'dashmin',
            'link',
            'account',
            'accountCreatedOn',
            'accountLabel',
            'firstName',
            'lastName',
            'phone',
            'email',
            'beeline',
            'startBalance',
            'currentBalance',
            'difference',
            'lowestBalance',
            'highestBalance',
            'dailyReturn',
            'numTrades',
            'numWinTrades',
            'numLossTrades',
            'amtWinTrades',
            'amtLossTrades',
            'avgWinTradeDays',
            'avgLossTradeDays',
            'avgWinTradeAmt',
            'avgLossTradeAmt',
            'expectancy',
            'sharpeRatio',
            'reportDate',
            'processingDate'
        );

        // Get the database instance from the container
        $db = $this->container->get('db');

        // Loop through each row of data
        foreach ($rows as $row) {

            // Split the row into an array
            $fields = explode("\t", $row);

            // Map the properties to an associative array
            $dataArray = array_combine($keys, $fields);

            // Instantiate the AlveoExport Class
            $alveoExport = new AlveoExport($db, $dataArray);

            // Call the save method on the AlveoExport instance
            $result = $alveoExport->save();

            // Create a response with the import result
            $response->getBody()->write(json_encode($result));
        }

        return $response->withHeader('Content-Type', 'application/json');
    }

}
