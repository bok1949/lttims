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
                    <h5 class="text-center">List of Establishments</h5>
                    @php
                        $ctr = 1;
                    @endphp
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Mobile Number</th>
                                <th scope="col">Phone Number</th>
                                <th scope="col">Email</th>
                                <th scope="col">FB Account</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            @foreach ($estabData as $item)
                                <tr scope="row">
                                    <td>{{$ctr}}</td>
                                    <td>{{$item->establishment_name}}</td>
                                    <td>{{$item->establishment_mobilenum}}</td>
                                    <td>{{$item->establishment_phonenum}}</td>
                                    <td>{{$item->establishment_email}}</td>
                                    <td>{{$item->establishment_fb_account}}</td>
                                </tr>
                                @php
                                    $ctr++;
                                @endphp
                                
                            @endforeach
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