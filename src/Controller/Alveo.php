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

    public function __construct(Container $container)
    {
        $this->container = $container;
        $db = $this->container->get('db');
        $this->alveoexport = new AlveoExport($db);
    }

    public function import(Request $request, Response $response): Response
    {
        // Get the POST data
        $data = $request->getParsedBody();

        // Split the data into an array
        $fields = explode("\t", $data);

        // Define the property names
        $keys = array(
            'dashmin',
            'link',
            'account',
            'account_created_on',
            'account_label',
            'first_name',
            'last_name',
            'phone',
            'email',
            'beeline',
            'start_balance',
            'current_balance',
            'difference',
            'lowest_balance',
            'highest_balance',
            'daily_return',
            'num_trades',
            'num_win_trades',
            'num_loss_trades',
            'amt_win_trades',
            'amt_loss_trades',
            'avg_win_trade_days',
            'avg_loss_trade_days',
            'avg_win_trade_amt',
            'avg_loss_trade_amt',
            'avg_win_trades_total',
            'avg_loss_trades_total',
            'expectancy',
            'sharpe_ratio',
            'report_date',
            'processing_date'
            );

        // Map the properties to an associative array
        $result = array_combine($keys, $fields);

        // Encode the array as JSON
        $json = json_encode($result);

        var_dump($json);

        // Call the importData method on the AlveoExport instance
        $result = $this->alveoexport->save($data['alveoimport']);

        // Create a response with the import result
        $response->getBody->write(json_encode($result));
        return $response->withHeader('Content-Type', 'application/json');
    }

}
