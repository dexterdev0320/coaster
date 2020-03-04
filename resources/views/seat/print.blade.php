<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container app">
        <div class="row mb-5">
            <div class="col-lg-12 d-flex justify-content-between">
                <div>
                    <label> {{ date('l, F j, Y') }}</label>
                </div>
                <div>
                    <label>PMC - Coaster Booking System</label>
                </div>
            </div>
            <div class="col-lg-12 mt-2">
                <div>
                    <h3 style="color: blue">PHILSAGA MINING CORPORATION</h3>
                    <h5>Purok 1-A, Bayugan 3, Rosario, Agusan Del Sur</h5>
                </div>
            </div>
            <div class="col-lg-12 text-center mt-2">
                <div><strong>SHUTTLE BUS MANIFEST</strong></div>
                <div><strong>Date Prepared: {{ date('l, F j, Y') }}</strong></div>
            </div>
            <div class="col-lg-12 d-flex justify-content-between mt-3">
                <div>
                    Departure from Mill Site to Davao
                </div>
                <div>
                    <label class="mr-5">Date: <u>{{ date('l, F j, Y', strtotime($schedule->date)) }}</u></label>
                    <label>Time: <u>12:30 PM</u></label>
                </div>
            </div>
            <div class="col-lg-12 mt-2">
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr style="color: blue">
                        <th scope="col">Seat No.</th>
                        <th scope="col">Employee ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Code</th>
                        <th scope="col">Destination</th>
                        <th scope="col">Signature</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php $count_seat = 0 ?>
                        @foreach ($seats as $seat)
                            <?php ($seat->status == 'Occupied') ? $count_seat++ : $count_seat; ?>  
                            <tr>
                                <th scope="row">{{ $seat->seat_no }}</th>
                                <td>{{ ($seat->emp_id) ? $seat->employee->emp_id : '' }}</td>
                                <td>{{ ($seat->emp_id) ? $seat->employee->name : '' }}</td>
                                <td>{{ ($seat->emp_id) ? $seat->code : '' }}</td>
                                <td>{{ ($seat->dest_id) ? $seat->destination->place : '' }}</td>
                                <td></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-lg-12">
                <h3><strong>OUTGOING: {{ $count_seat }}</strong></h3>
            </div>
            <div class="col-lg-12 d-flex justify-content-between">
                <div class="mt-5">
                    <label>Prepared by:</label>
                    <h5  class="mt-4"><u>Princess Mae E. Tano</u></h5>
                    <h6>Records Property Custodian</h6>
                </div>
                <div class="mt-5">
                    <label>Approved by:</label>
                    <h5 class="mt-4"><u>Claire A. Amarillento</u></h5>
                    <h6>GSD Manager</h6>
                </div>
            </div>
        </div>
    </div>
</body>
</html>