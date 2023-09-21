@if (auth()->user()->is_admin == 0)
    @extends('layouts.app')
    @section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col col-md-8"><b>CRT Score List</b></div>
                                <div class="col col-md-4">
                                    <a href="{{ route('userhome') }}" class="btn btn-success btn-sm float-end">Home</a>
                                    <button class="btn btn-sm btn-primary" id="downloadPdf">Download PDF</button>
                                </div>
                            </div>
                        </div>

                        <div class="card-body" id="reportPage">

                            <h5><b>Test Report of: {{ Auth::user()->name }}</b></h5>

                            <div class="row">
                                <div class="col-lg-12 col-md-12">
                                    <table id="example" class="display table table-bordered data-table">
                                        <thead>
                                            <tr>
                                                <th>Test Id</th>
                                                <th>Test Date</th>
                                                <th>Topics Name</th>
                                                <th>Quiz Score</th>
                                                <th>Skipped Ques.</th>
                                                <th>Total Ques.</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            {{-- @dd($test_data) --}}
                                            @if (!empty($test_data))
                                                @foreach ($test_data as $row)
                                                    <tr>
                                                        <td>{{ $row[0]->test_id }}</td>
                                                        <td>{{ date('d/M/Y', strtotime($row[0]->created_at)) }}</td>
                                                        <td>{{ $row[0]->topic_name }}</td>
                                                        @if ($row[0]->total_opt_count == 0 || $row[0]->total_opt_count == null)
                                                            <td>{{ $row[0]->total_corr_ans }}</td>
                                                        @else
                                                            <td>Score : {{ $row[0]->total_corr_ans }}<br />
                                                                {{ $row[0]->total_opt_count }}</td>
                                                        @endif
                                                        <td>{{ $row[0]->total_skip }}</td>
                                                        <td>{{ $row[0]->total_ques }}</td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="5" class="text-center">No Data Found</td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div> <br />
                            <div class="row justify-content-center">
                                <div class="chart-container chart col-lg-6 col-md-12">
                                    <canvas id="bar_chart"></canvas>
                                </div>
                            </div> <br />
                            <div class="html2pdf__page-break"></div>
                            <div class="row justify-content-center">
                                <div class="chart-container chart col-lg-6 col-md-12">
                                    <canvas id="pie_chart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.0/html2canvas.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#example').DataTable({
                    searching: false,
                    paging: false,
                    info: false
                });


                var piedata = @json($piedata);
                var language = [];
                var total = [];
                var color = [];

                for (let count_arr = 0; count_arr < piedata.length; count_arr++) {
                    language.push(piedata[count_arr].language);
                    total.push(piedata[count_arr].total);
                    color.push(piedata[count_arr].color);
                }

                var chart_data = {
                    labels: language,
                    datasets: [{
                        label: 'CRT Score',
                        backgroundColor: color,
                        color: '#fff',
                        data: total
                    }]
                };

                var options = {
                    responsive: true,
                    legend: {
                        display: true,
                        position: 'right',
                        align: 'center',
                        labels: {
                            boxWidth: 20,
                            padding: 8
                        }
                    }
                };

                var group_chart1 = $('#pie_chart');

                var graph1 = new Chart(group_chart1, {
                    type: "pie",
                    data: chart_data,
                    options: options
                });


                var group_chart3 = $('#bar_chart');

                var graph3 = new Chart(group_chart3, {
                    type: 'bar',
                    data: chart_data,
                    options: options
                });

            });

            document.getElementById('downloadPdf').addEventListener("click", function() {
                var divHeight = $('#reportPage').height();
                var divWidth = $('#reportPage').width();
                var ratio = divHeight / divWidth;

                html2canvas(document.getElementById('reportPage')).then(function(canvas) {
                    var imgdata = canvas.toDataURL("image/jpg");
                    var doc = new jspdf.jsPDF();

                    var width = doc.internal.pageSize.getWidth();
                    var height = doc.internal.pageSize.getHeight();

                    height = ratio * width;
                    doc.addImage(imgdata, 'JPG', 10, 10, width - 20, height - 10);
                    doc.save("{{ Auth::user()->name }} report.pdf");
                });
            });
        </script>
    @endsection
@endif
