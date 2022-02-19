<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Establishment</title>
    <style>
        #main {
            font-family: "Times New Roman", Times, serif;
        }
        .text-center {
            text-align: center;
        }
        .table {
            border-collapse: collapse;
            width: 100%;
        }

        .table td,
        .table th {
            border: 1px solid #ddd;
            padding: 8px;
        }
        .table tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .table th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: center;
        }
        .center-text{
            text-align: center;
        }
        .right-text{
            text-align: right;
        }
    </style>

    
   
</head>
<body style="background-color: #fff">
    

    <main id="main" class="container-fluid">
        <div class="container-fluid pt-5">
            <div class="row">
                <p class="text-center">
                    Municipality of La Trinidad <br>
                    <strong>Office of the Tourism</strong>
                </p>
            </div>
            <div class="row">
                <div class="col">
                    <span>Date: {{\Carbon\Carbon::parse()->now()->format('F j, Y')}}</span>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <h5 class="text-center">List of Establishments with Visitors for {{\Carbon\Carbon::parse()->now()->format('F')}}</h5>
                    @php
                        $ctr = 1;
                    @endphp
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Type of Establishment</th>
                                <th scope="col">Name</th>
                                <th scope="col">Total Male</th>
                                <th scope="col">Total Female</th>
                                <th scope="col">Total LGBTQ</th>
                                <th scope="col">Sum Visitors</th>
                   
                            </tr>
                        </thead>
                        <tbody>
                            
                            @foreach ($estabData as $item)
                                <tr scope="row" >
                                    <td>{{$ctr}}</td>
                                    <td>{{$item->type_of_establishment}}</td>
                                    <td>{{$item->establishment_name}}</td>
                                    <td class="center-text">{{$item->pwym}}</td>
                                    <td class="center-text">{{$item->pwyf}}</td>
                                    <td class="center-text">{{$item->pwylgbtq}}</td>
                                    <td class="center-text">{{$item->pwym + $item->pwyf + $item->pwylgbtq}}</td>
                                </tr>
                                @php
                                    $ctr++;
                                @endphp
                                
                            @endforeach
                                <tr>
                                    <td class="right-text" colspan="3">Total</td>

                                    <td class="center-text">{{$estabData[0]->totalmale}}</td>
                                    <td class="center-text">{{$estabData[0]->totalfemale}}</td>
                                    <td class="center-text">{{$estabData[0]->totallgbtq}}</td>
                                    <td class="center-text">{{$estabData[0]->totalvisitors}}</td>
                                </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
    
    
  

   
    
    <!-- Template Main JS File -->
    <script src="{{asset('assets/js/main.js')}}"></script>
    
    <script src="{{ asset('js/app.js') }}" defer></script>
    
    
</body>
</html>