<?php
/**
 * Created by PhpStorm.
 * User: Sarfraz
 * Date: 7/12/2019
 * Time: 2:47 PM
 */

namespace Sarfraznawaz2005\ServerMonitor\Console;

use Illuminate\Console\Command;

abstract class BaseCommand extends Command
{

    /**
     * Outputs check results on console.
     *
     * @param array $results
     */
    protected function outputResults(array $results)
    {
        $data = [];

        foreach ($results as $type => $checks) {
            foreach ($checks as $check) {
                $name = $check['name'];
                $error = '';

                if ($check['status']) {
                    $result = '<fg=green>PASSED</fg=green>';
                } else {
                    $error = $check['error'];
                    $result = '<fg=red>FAILED</fg=red>';
                }

                $data[] = [$type, $name, $result, $error];
            }
        }

        $headers = ['Check Type', 'Check Name', 'Status', 'Error'];

        $this->table($headers, $data);
    }
}