@extends('layouts.app')
@section('title', 'Daily Check Up Entry')

@section('content')

<div class="row justify-content-center mt-5" >
    <p hidden id="getUid"></p>
    <div class="col mb-3 mt-5">
        <div class="h-100 p-5 bg-white rounded-3 text-center shadow">
            <img class="img-fluid" src="{{asset('img/Pertamina_Logo.svg')}}" width="550px" alt="">
            <h4>Pertamina Fuel Terminal Ujung Berung</h4>
            <div class="mt-5">
                <img id="img_access" class="img-fluid" src="{{asset('img/tap.png')}}" width="360px" alt="">
                <p id="text_access" class="blink">Tempelkan kartu anda pada reader</p>
            </div>
            <div class="mt-2">
              <div class="card shadow">
                <div class="card-body">
                  <div class="row justify-content-center text-start">
                      <div class="col-md-auto">
                          <p class="h3">Nama Pegawai</p>
                          <p class="h3">Nomor Pegawai</p>
                          <p class="h3">Bagian/Fungsi</p>
                          <p class="h3">Status</p>
                      </div>
                      <div class="col-md-auto">
                          <p class="h3">:</p>
                          <p class="h3">:</p>
                          <p class="h3">:</p>
                          <p class="h3">:</p>
                      </div>
                      <div class="col-md-auto">
                          <p class="h3" id="name">-----</p>
                          <p class="h3" id="employee_number">-----</p>
                          <p class="h3" id="department">-----</p>
                          <p class="h3" id="fit_status">-----</p>
                      </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
    </div>

</div>


@endsection

@push('scripts')
    <script>

        $(document).ready(function(){
            var uid_paragraph = $('#getUid');
            uid_paragraph.load("{{URL::to('/storage/container/getUID.php')}}");
            setInterval(function(){
                uid_paragraph.load("{{URL::to('/storage/container/getUID.php')}}");
            }, 1000);

            // this.observer= new MutationObserver(function(mutations) {
            //     console.log(uid_paragraph.text());
            // }.bind(this));
            // this.observer.observe(uid_paragraph.get(0), {characterData:true, childList: true});

            var myVar = setInterval(myTimer, 200);
            var myVar1 = setInterval(myTimer1, 200);
            var uid = "";
            clearInterval(myVar1);

            function myTimer(){
            var getID = $('#getUid').text();
            uid = getID;
                if(getID != ""){
                    // myVar1 = setInterval(myTimer1, 1000);
                    getData(getID);
                    clearInterval(myVar);
                }
            }

            function myTimer1(){
              var getID = $('#getUid').text();
              if(uid != getID){
                myVar = setInterval(myTimer, 200);
                clearInterval(myVar1);
              }else{
                $('#employee_number').text("-----");
                $('#name').text("-----");
                $('#department').text("-----");
                $('#fit_status').text("-----").removeClass('text-warning text-bold').removeClass('text-primary text-bold');
                $('#img_access').attr('src', "{{asset('img/tap.png')}}");
                $('#text_access').text('Tempelkan kartu anda pada reader').removeClass('blink-danger').removeClass('blink-success').addClass('blink');
              }
            }


            function getData(str){
              if(str !== ""){
                $.ajax({
                  type: 'GET',
                  url: "{{URL::to('/data/dcu/employee')}}",
                  data: {'uuid_card': str},
                  dataType: 'json',
                  success: function(data){
                    if(data.status == 404 ){
                        $('#text_access').text(data.message).removeClass('blink').addClass('blink-danger');
                        $('#img_access').attr('src', "{{asset('img/tap-denied.png')}}");
                        myVar1 = setInterval(myTimer1, 3000);
                    }else if(data.status == 200){
                        console.log(data);
                        if(data.data.daily_check_ups.length !== 0){
                            if(data.access.status == 0 ){
                                $('#employee_number').text(data.data.employee_number);
                                $('#name').text(data.data.name);
                                $('#department').text(data.data.departments.department);
                                $('#img_access').attr('src', "{{asset('img/tap-denied.png')}}");
                                $('#text_access').text('Pegawai belum melakukan Daily Check Up dan/atau Safety Talk').removeClass('blink').removeClass('blink-success').addClass('blink-danger');
                                $('#fit_status').text("------").removeClass('text-primary text-bold text-warning');

                                myVar1 = setInterval(myTimer1, 3000);

                            }else if(data.access.status == 1 ){
                                $('#employee_number').text(data.data.employee_number);
                                $('#name').text(data.data.name);
                                $('#department').text(data.data.departments.department);
                                $('#img_access').attr('src', "{{asset('img/tap-success.png')}}");
                                $('#text_access').text('Akses Diterima').removeClass('blink').addClass('blink-success');
                                if(data.data.daily_check_ups[0].fit_status == 1){
                                    $('#fit_status').text("Fit").addClass('text-primary text-bold');
                                }else if(data.data.daily_check_ups[0].fit_status == 0){
                                    $('#fit_status').text("Unfit").addClass('text-warning text-bold');
                                }
                                myVar1 = setInterval(myTimer1, 3000);

                            }
                        }else{
                            $('#employee_number').text(data.data.employee_number);
                            $('#name').text(data.data.name);
                            $('#department').text(data.data.departments.department);
                            $('#img_access').attr('src', "{{asset('img/tap-denied.png')}}");
                            $('#text_access').text('Pegawai belum melakukan Daily Check Up dan/atau Safety Talk').removeClass('blink').removeClass('blink-success').addClass('blink-danger');
                            $('#fit_status').text("------").removeClass('text-primary text-bold text-warning');
                            myVar1 = setInterval(myTimer1, 3000);

                        }
                    }

                  },
                  error: function(response){
                    console.log(response.responseJSON.message);
                  }
                });
              }
            }
        });
    </script>
@endpush

@push('styles')
<style>
    .blink {
      animation: blinker 0.9s linear infinite;
      color: #1c87c9;
      font-size: 30px;
      font-weight: bold;
      font-family: sans-serif;
    }

    .blink-success {
      /* animation: blinker 2s linear infinite; */
      color: #9cbb21;
      font-size: 30px;
      font-weight: bold;
      font-family: sans-serif;
    }

    .blink-danger {
      /* animation: blinker 2s linear infinite; */
      color: #ED1B2F;
      font-size: 30px;
      font-weight: bold;
      font-family: sans-serif;
    }

    @keyframes blinker {
      50% {
        opacity: 0;
      }
    }

  </style>
@endpush
