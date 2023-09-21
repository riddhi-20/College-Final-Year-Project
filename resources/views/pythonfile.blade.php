<!-- @if (auth()->user()->is_admin == 1) -->
    @extends('layouts.app')

    @section('content')
        <!-- <iframe src="{{url('/pythonfile') }}" width="100%" height="600"></iframe> -->
            
        <?php
            $output = system("python C:/xampp/htdocs/psychometric_test/public/pydata/demo.py");
            echo $output;
        ?>
        
    @endsection
<!-- @endif -->
