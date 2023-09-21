<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Symfony\Component\Process\Exception\ProcessFailedException;
// use Symfony\Component\Process\Process;

class RunpythonController extends Controller
{
    public function pythonfile()
    {

        // $process = system("python C:/xampp/htdocs/psychometric_test/public/pydata/demo.py");

        // $output = system('python C:/xampp/htdocs/psychometric_test/public/pydata/demo.py');

        // echo $output = $process;

        return view('pythonfile');
    }
}
