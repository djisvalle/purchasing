@extends('layouts.master')

@section('content')
        <head>
            @if(Session::has('po_new_check'))
                <meta http-equiv="refresh" content="0; url=/purchasing/public/transaction/purchase-order-pdf">
            @endif
        </head>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Transaction</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            @if(Session::has('po_add_success'))
            <div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-success alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>{!! session('po_add_success') !!}</strong>
                    </div>
                </div>
            </div>
            @endif

            @if(Session::has('po_add_fail'))
            <div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-danger alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>{!! session('po_add_fail') !!}</strong>
                    </div>
                </div>
            </div>
            @endif
            <div class="row">   
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <span style="font-size: 20px;">Purchase Order</span> 
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">

                        <div class="panel-body">
                            <div class="form-group" style="width: 100%">   
                                {!! Form::open(['class' => 'form-inline', 'method' => 'post', 'url' => 'transaction/purchase-order-search']) !!}

                                <div class="form-group" style="width: 100%">

                                    <div class="form-group" style="width: 100%">
                                        <label for="">Purchase Request Number:</label>
                                        <select style="margin-right: 20px;" class="selectpicker" name="select-pr-no" id="select-pr-no">
                                            <option value="" selected disabled>Select a PR No.</option>
                                            @foreach($pr_nos as $pr_no)
                                                <option value="{{ $pr_no->id }}" @if($selected_pr_no == $pr_no->id) selected @endif>{{ $pr_no->pr_number }}</option>
                                            @endforeach
                                        </select>     

                                        <label for="">Supplier:</label>
                                        <select class="selectpicker" name="add-supplier" id="add-supplier">
                                                <option disabled selected>Select a supplier</option>       
                                        </select> 

                                        <button class="form-control btn btn-success">Select</button> 
                                    </div>


                                {!! Form::close() !!}
                                </div>

                            {!! Form::open(['class' => 'form-inline', 'method' => 'post', 'url' => 'transaction/purchase-order']) !!}
                                <input type="hidden" name="hdn-pr-no" id="hdn-pr-no" value="{{ $selected_pr_no }}">
                                <input type="hidden" name="hdn-aq-no" id="hdn-aq-no" value="{{ $selected_aq_no }}">

                            </div>
                        </div>        

                               
                        </div>  
       

                         <div class="panel-body">
                            <div class="panel panel-default">
                                <div class="panel-heading"></div>
                                <div class="panel-body">
                                    <div class="form-group col-lg-12">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Stock No.</th>
                                                    <th style="width: 20%;">Item</th>
                                                    <th>Quantity</th>
                                                    <th>Unit</th>
                                                    <th>Unit Cost Amount</th>
                                                    <th>Amount</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($items as $i => $item)
                                                <input type="hidden" name="supplier-amount[]" id="supplier-amount{!! $i !!}">
                                                <tr>
                                                    <td>{{ $item->stock_no}}</td>
                                                    <td>{{ $item->item_name }}</td>
                                                    <td>{{ $item->quantity }}</td>
                                                    <td>{{ $item->unit_name }}</td>
                                                    <td id="amount{!! $i !!}"></td>
                                                    <td id="total-amount{!! $i !!}"></td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        
                                    </div>  
                                </div>             
                            </div>

                            <div style="margin: 50px 0"></div>
                            <div style="float: left; width: 100%;">
                                <div class="form-group col-lg-4">                                 
                                    <label for="" >Agency</label>
                                    <select class="form-control" name="add-agency" id="add-agency">
                                        @foreach($agencies as $agency)
                                            <option value="{{ $agency->id }}">{{ $agency->agency_name }}</option>
                                        @endforeach
                                    </select>                                      
                                </div>                                
                            </div>
                            <div style="float: left; width: 100%; margin-bottom: 30px">
                                <div class="form-group col-lg-5">
                                    <label for="">Address</label>
                                    <input type="text" class="form-control" name="add-address" id="add-address">
                                </div>
                                <div class="form-group col-lg-3">
                                    <label for="">TIN</label>
                                    <input type="text" class="form-control" name="add-tin" id="add-tin">
                                </div>  
                                <div class="form-group col-lg-2">
                                    <label for="add-birthday" >Date</label>         
                                    <input type="date" class="form-control" id="add-date" name="add-date" value="{{ date("Y-m-d") }}" required>
                                </div>
                                <div class="form-group col-lg-2">
                                    <label for="">Mode Of Procurement</label>
                                    <input type="text" class="form-control" name="add-mode-of-procurement" id="add-mode-of-procurement">
                                </div>

                                <div class="form-group col-lg-6">
                                    <label for="">Place Of Delivery</label>
                                    <input type="text" class="form-control" name="add-place-delivery" id="add-place-delivery">
                                </div>   
                                <div class="form-group col-lg-2">
                                    <label for="">Date Of Delivery</label>
                                    <input type="date" class="form-control" id="add-date-delivery" name="add-date-delivery" value="{{ date("Y-m-d") }}" required>
                                </div>   
                                <div class="form-group col-lg-2">
                                    <label for="">Delivery Term</label>
                                    <input type="text" class="form-control" name="add-delivery-term" id="add-delivery-term">
                                </div>
                                <div class="form-group col-lg-2">
                                    <label for="">Payment Term</label>
                                    <input type="text" class="form-control" name="add-payment-term" id="add-payment-term">
                                </div>

                                <div class="form-group col-lg-4">
                                    <label for="">Authorized Official</label>
                                    <select class="form-control" name="add-authorized-official" id="add-authorized-official">
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->middle_name }} {{ $user->last_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-lg-3">
                                    <label for="">Total Amount</label>
                                    <input type="text" class="form-control" name="add-total-amount" id="add-total-amount" readonly>
                                </div>
                                <div class="form-group col-lg-5">
                                    <label for="">ALOBS/BUB No.</label>
                                    <input type="text" class="form-control" name="add-alobs-no" id="add-alobs-no">
                                </div>                   
                            </div>

                            <button class="btn btn-success" style="float: right; width: 20%;">Submit PO</button> 
                            {!! Form::close() !!}
                        </div>
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
  
        </div>
        <!-- /#page-wrapper -->

@stop

@section('scripts')

    <script>
    $(document).ready(function() {
        $('#dt-designation').DataTable({
            responsive: true
        });

        var monthNames = [ "January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December" ];
        
        var dayNames= ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"]

        var newDate = new Date();
        newDate.setDate(newDate.getDate());    
        $('#Date').html(dayNames[newDate.getDay()] +" | " +" " + " " + newDate.getDate() + ' ' + monthNames[newDate.getMonth()] + "," + ' ' + newDate.getFullYear());
        $('#transaction_date').val(newDate.getFullYear() + "-" +  (newDate.getMonth()+1) + "-" + newDate.getDate());


    });


    $(document).ready(function(){

        $('#modal-close').click(function(){
            location.reload(true);
        });

        $('#add-supplier').change(function(){
            
            $.ajaxSetup({
                headers:
                { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') }
            });

            $.ajax({
                url: 'purchase-order/select-supplier',
                type: "post",
                data: {
                    'id': $('#add-supplier').find('option:selected').val(), 
                    'pr_no' : $('#hdn-pr-no').val()
                },
                dataType: 'json',
                success: function(data){
                    var items = {!! json_encode($items) !!};
                    var total_amount = 0;
                    var len = (data.amount).length;

                    console.log(data.amount);

                    for(var i = 0; i < items.length; i++)
                    {
                        if(data.amount[i] == null) $("td#amount" + i).html(0);
                        else $("td#amount" + i).html(data.amount[i]);
                    
                        $("input#supplier-amount" + i).val(data.amount[i]);
                        $("td#total-amount" + i).html((data.amount[i] * items[i].quantity));

                        
                        total_amount += (data.amount[i] * items[i].quantity);
                    }

                    $("#add-total-amount").val(total_amount);

                }

            });      
        }); 

        $('#select-pr-no').change(function(){
                    
                    $.ajaxSetup({
                        headers:
                        { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') }
                    });

                    $.ajax({
                        url: 'purchase-order/get-supplier',
                        type: "post",
                        data: {
                            'id': $('#select-pr-no').find('option:selected').val()
                        },
                        dataType: 'json',
                        success: function(data){

                            $("#add-supplier").find('option').remove();

                            var len = data.suppliers.length;

                            $('select#add-supplier').append('<option value="">Select a supplier</option>');

                            for(var i = 0; i < len; i++)
                            {
                                $('select#add-supplier').append('<option value="' + data.suppliers[i].id + '">' + data.suppliers[i].supplier_name + '</option>');
                            }

                            $('#add-supplier').selectpicker('refresh');
                        }

                    });      
            }); 
    
    });

    </script>

@stop