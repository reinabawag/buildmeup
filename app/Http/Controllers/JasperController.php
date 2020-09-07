<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JasperPHP;

class JasperController extends Controller
{
    public function generateReport($id)
    {
        $filename = 'reports\itemBuildUp_' . date('mdYHis');
        // JasperPHP::compile(base_path('\reports\itemBuildUp.jrxml'))->execute();
        JasperPHP::process(
            base_path('/reports/itemBuildUp.jrxml'),
            base_path($filename),
            array("pdf"),
            array('id' => $id),
            array(
                'driver' => 'mysql',
                'username' => 'root',
                'host' => 'localhost',
                'database' => 'misencode',
                'port' => '3306',
            )
        )->execute();

        return response()->file(base_path($filename).'.pdf');
    }
}
