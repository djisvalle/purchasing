@extends('layouts.master')

@section('title', 'SLSU - Disbursement Voucher')

@if(Auth::check())
    @if(Auth::user()->user_type == 1)
        @section('content')
                <head>
                    @if(Session::has('dv_new_check'))
                        <meta http-equiv="refresh" content="0; url=/purchasing/public/transaction/disbursement-voucher-pdf">
                    @endif
                </head>

                <div id="page-wrapper">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">Transaction</h1>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    @if(Session::has('dv_add_success'))
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="alert alert-success alert-dismissable">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong>{!! session('dv_add_success') !!}</strong>
                                <a href="{{ URL::to('transaction/disbursement-voucher-pdf') }}" class="btn-sm btn-info">Save PDF</a>
                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="row">   
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <span style="font-size: 20px;">Disbursement Voucher</span> 
                                </div>
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                {!! Form::open(['method' => 'post', 'url' => 'transaction/disbursement-voucher']) !!}
                                <div class="panel-body">
                                        <div class="form-group col-lg-12">
                                            <label for="">Mode Of Payment:&nbsp&nbsp&nbsp&nbsp</label>
                                            <label class="radio-inline"><input type="radio" name="add-mode-of-payment" value="1">MDS Check</label>
                                            <label class="radio-inline"><input type="radio" name="add-mode-of-payment" value="2">Commercial Check</label>
                                            <label class="radio-inline"><input type="radio" name="add-mode-of-payment" value="3">ADA</label>
                                            <label class="radio-inline"><input type="radio" name="add-mode-of-payment" value="4">Others</label>
                                        </div>


                                        <div class="form-group col-lg-4">
                                            <label for="">Payee</label>
                                            <select class="form-control" name="add-payee" required>
                                                @foreach($users as $user)
                                                    <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->last_name }}</option>
                                                @endforeach
                                            </select>    
                                        </div>
                                        <div class="form-group col-lg-4">
                                            <label for="">TIN/Employee No.</label>
                                            <input type="text" class="form-control" name="add-tin">
                                        </div>
                                        <div class="form-group col-lg-4">
                                            <label for="">OR/BUR No.</label>
                                            <input type="text" class="form-control" name="add-or-bur-no">
                                        </div>

                                        <div class="form-group col-lg-6">
                                            <label for="">Address</label>
                                            <input type="text" class="form-control" name="add-address">
                                        </div>
                                        <div class="form-group col-lg-4">
                                            <label for="">Office/Unit/Project</label>
                                            <input type="text" class="form-control" name="add-office">
                                        </div>
                                        <div class="form-group col-lg-2">
                                            <label for="">Code</label>
                                            <input type="text" class="form-control" name="add-code">
                                        </div>

                                </div>

                                <div class="panel-body">
                                    <div class="panel panel-default">
                                        <div class="panel-heading"> 
                                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#add-item-particulars">Add New Item</button>
                                        </div>
                                        <div class="panel-body">
                                            <div class="form-group col-lg-12">
                                                <table class="table table-bordered" id="dv-detail">
                                                    <thead>
                                                        <tr>
                                                            <th style="width: 40%;">Particulars</th>
                                                            <th>Responsibility Center</th>
                                                            <th>MFO/PAP</th>
                                                            <th>Amount</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                </table>
                                                
                                            </div>  
                                        </div>             
                                    </div>
                                </div>
                                    
                                <div class="panel-body">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <label for="">A. Certified: Expenses/Cash Advance necessary, lawful and incurred under my direct supervision.</label>
                                        </div>
                                        <div class="panel-body">
                                            <div class="form-group col-lg-6">
                                                <label>Certifier:</label>
                                                <select class="form-control" name="add-certifier-expense" required>
                                                    @foreach($users as $user)
                                                        <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->last_name  }}</option>
                                                    @endforeach
                                                </select> 
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label>Designation:</label>
                                                <select class="form-control" id="add-certifier-expense-designation" name="add-certifier-expense-designation"> 
                                                    @foreach($designations as $designation) 
                                                        <option id="{{ $designation->id }}">{{ $designation->designation_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="panel-body">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <label>B. Accounting Entry</label> 
                                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#add-item-accounting">Add New Item</button>
                                        </div>
                                        <div class="panel-body">
                                            <div class="form-group col-lg-12">
                                                <table class="table table-bordered" id="dv-accounting">
                                                    <thead>
                                                        <tr>
                                                            <th style="width: 50%;">Accounting Title</th>
                                                            <th>UACS Code</th>
                                                            <th>Debit</th>
                                                            <th>Credit</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                </table>
                                                
                                            </div>  
                                        </div>             
                                    </div>
                                </div>

                                <div class="panel-body">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <label>C. Certified</label> 
                                        </div>
                                        <div class="panel-body">
                                            <div class="form-group col-lg-12">
                                                <label class="radio-inline"><input type="radio" name="add-certified" value="1">Cash Available</label>
                                                <label class="radio-inline"><input type="radio" name="add-certified" value="2">Subject to Authority to Debit Account (when applicable)</label>
                                                <label class="radio-inline"><input type="radio" name="add-certified" value="3">Supporting documents complete</label>
                                            </div>
                                            <div class="form-group col-lg-4">
                                                <label>Certifier:</label>
                                                <select class="form-control" name="add-certifier" required>
                                                    @foreach($users as $user)
                                                        <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->last_name  }}</option>
                                                    @endforeach
                                                </select> 
                                            </div>
                                            <div class="form-group col-lg-4">
                                                <label>Designation:</label>
                                                <select class="form-control" name="add-certifier-designation" required>
                                                    @foreach($designations as $designation) 
                                                        <option id="{{ $designation->id }}">{{ $designation->designation_name }}</option>
                                                    @endforeach
                                                </select> 
                                            </div>
                                            <div class="form-group col-lg-4">
                                                <label>Date:</label>
                                                <input type="date" class="form-control" name="add-certified-date" value="{{ date("Y-m-d") }}" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="panel-body">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <label for="">D. Approved For Payment:</label>
                                        </div>
                                        <div class="panel-body">
                                            <div class="form-group col-lg-12">
                                                <textarea type="text" class="form-control" rows="2" name="add-approved-for-payment"></textarea>
                                            </div>
                                            <div class="form-group col-lg-4">
                                                <label>Approver:</label>
                                                <select class="form-control" name="add-approver" required>
                                                    @foreach($users as $user)
                                                        <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->last_name  }}</option>
                                                    @endforeach
                                                </select> 
                                            </div>
                                            <div class="form-group col-lg-4">
                                                <label>Designation:</label>
                                                <select class="form-control" name="add-approver-designation" required>
                                                    @foreach($designations as $designation) 
                                                        <option id="{{ $designation->id }}">{{ $designation->designation_name }}</option>
                                                    @endforeach
                                                </select> 
                                            </div>
                                            <div class="form-group col-lg-4">
                                                <label>Date:</label>
                                                <input type="date" class="form-control" id="add-approved-date" name="add-approved-date" value="{{ date("Y-m-d") }}" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="panel-body">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <label for="">E. Receipt Payment:</label>
                                        </div>
                                        <div class="panel-body">
                                            <div class="form-group col-lg-5">
                                                <label for="">Check/ADA No.</label>
                                                <input type="text" class="form-control" name="add-check-ada">
                                            </div>
                                            <div class="form-group col-lg-2">
                                                <label>Date:</label>
                                                <input type="date" class="form-control" id="add-check-date" name="add-check-date" value="{{ date("Y-m-d") }}" required>
                                            </div>
                                            <div class="form-group col-lg-5">
                                                <label for="">Bank Name</label>
                                                <input type="text" class="form-control" name="add-bank">
                                            </div>
                                            <div class="form-group col-lg-5">
                                                <label for="">Printed Name</label>
                                                <select class="form-control" name="add-printed-name" required>
                                                    @foreach($users as $user)
                                                        <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->last_name  }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-lg-2">
                                                <label>Date:</label>
                                                <input type="date" class="form-control" id="add-printed-name-date" name="add-printed-name-date" value="{{ date("Y-m-d") }}" required>
                                            </div>

                                            <div class="form-group col-lg-5">
                                                <label for="">JEV No.</label>
                                                <input type="text" class="form-control" name="add-jev-no">
                                            </div>         

                                            <div class="form-group col-lg-12">
                                                <label for="">Official Receipt/Other Documents</label>
                                                <input type="text" class="form-control" name="add-documents">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                        <div id="submit-iss" class="modal fade" role="dialog">
             
                                            <div class="modal-dialog">
                                        
                                                <!-- Modal content-->
                                                <div class="modal-content ">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Save Disbursement Voucher Request?</h4>
                                                    </div>
                                                    <div class="modal-body container-fluid">
                                                        <div class="form-group col-lg-12">   
                                                            <label for="add-department">
                                                                Are you sure you want to save your Disbursement Voucher Request? Changes cannot be made after it is sent.
                                                            </label>         
                                                        </div>  
                                                        <div class="form-group col-lg-12">
                                                            <span><i>A PDF will automatically be downloaded after saving.</i></span>
                                                        </div>    
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-success">Save</button>
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>

                                            </div>
                                        
                                        </div>

                                {!! Form::close() !!}
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#submit-iss" style="float: right; width: 20%;">Submit Disbursement Voucher</button>  
                                </div> 

                                <div id="add-item-particulars" class="modal fade" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Add New Item</h4>
                                            </div>
                                            <div class="modal-body container-fluid">
                                                {!! Form::open(['id' => 'frm-add-particulars']) !!}
                                                <div class="col-lg-12">
                                                    <div class="form-group col-lg-12">
                                                        <label for="">Particulars</label>
                                                        <input class="form-control" name="add-particulars" id="add-particulars" required>
                                                    </div>        
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-group col-lg-5">
                                                        <label for="">Responsibility Center</label>
                                                        <input class="form-control" name="add-responsibility-center" id="add-responsibility-center" required>
                                                    </div>    
                                                    <div class="form-group col-lg-4">
                                                        <label for="">MFO/PAP</label>
                                                        <input type="text" class="form-control" name="add-mfo-pap" id="add-mfo-pap">
                                                    </div> 
                                                    <div class="form-group col-lg-3">
                                                        <label for="">Amount</label>
                                                        <input type="number" class="form-control" name="add-amount" id="add-amount">
                                                    </div>        
                                                </div>
                                                {!! Form::close() !!}

                                            </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-success" id="btn-add-particulars">Add</button>
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                </div>
                                        </div>
                                    </div>
                                </div>     

                                <div id="add-item-accounting" class="modal fade" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Add New Item</h4>
                                            </div>
                                            <div class="modal-body container-fluid">
                                                {!! Form::open(['id' => 'frm-add-accounting']) !!}
                                                <div class="col-lg-12">
                                                    <div class="form-group col-lg-12">
                                                        <label for="">Accounting Title</label>
                                                        <input class="form-control" name="add-accounting-title" id="add-accounting-title" required>
                                                    </div>        
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-group col-lg-4">
                                                        <label for="">UACS Code</label>
                                                        <input class="form-control" name="add-uacs" id="add-uacs" required>
                                                    </div>    
                                                    <div class="form-group col-lg-4">
                                                        <label for="">Debit</label>
                                                        <input type="text" class="form-control" name="add-debit" id="add-debit">
                                                    </div> 
                                                    <div class="form-group col-lg-4">
                                                        <label for="">Credit</label>
                                                        <input type="number" class="form-control" name="add-credit" id="add-credit">
                                                    </div>        
                                                </div>
                                                {!! Form::close() !!}
                                            </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-success" id="btn-add-accounting">Add</button>
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                </div>
                                        </div>
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

            });

            $('#btn-add-particulars').click(function(){
                
                var tbl_len = $("#dv-detail tr").length;

                $('#dv-detail tbody').append(
                        '<tr id="' + tbl_len + '">' +
                            '<td>' + $("#add-particulars").val() + '</td>' +
                            '<td>' + $("#add-responsibility-center").val() + '</td>' +
                            '<td>' + $("#add-mfo-pap").val() + '</td>' +
                            '<td>' + $("#add-amount").val() + '</td>' +
                            '<td>' +
                                '<a data-toggle="modal" href="#edit-det' + tbl_len + '"><span class="glyphicon glyphicon-edit"></span></a>' +
                                '<a data-toggle="modal" href="#del-det' + tbl_len + '"><span class="glyphicon glyphicon-trash"></span></a>' +
                            '</td>' +
                            '<input type="hidden" name="hdn-particulars[]' + '" value="' + $("#add-particulars").val() + '">' +
                            '<input type="hidden" name="hdn-responsibility-center[]' + '" value="' + $("#add-particulars").val() + '">' +
                            '<input type="hidden" name="hdn-mfo-pap[]' + '" value="' + $("#add-mfo-pap").val() + '">' +
                            '<input type="hidden" name="hdn-amount[]' + '" value="' + $("#add-amount").val() + '">' +
                        '</tr>'
                    );

                createModal(tbl_len);
                $("#add-item-particulars").modal("hide");
                $("#add-item-particulars").find('form').trigger('reset');
            }); 

            
            $('#btn-add-accounting').click(function(){
                         
                var tbl_len = $("#dv-accounting tr").length;

                $('#dv-accounting tbody').append(
                        '<tr id="' + tbl_len + '">' +
                            '<td>' + $("#add-accounting-title").val() + '</td>' +
                            '<td>' + $("#add-uacs").val() + '</td>' +
                            '<td>' + $("#add-debit").val() + '</td>' +
                            '<td>' + $("#add-credit").val() + '</td>' +
                            '<input type="hidden" name="hdn-accounting-title[]' + '" value="' + $("#add-accounting-title").val() + '">' +
                            '<input type="hidden" name="hdn-uacs[]' + '" value="' + $("#add-uacs").val() + '">' +
                            '<input type="hidden" name="hdn-debit[]' + '" value="' + $("#add-debit").val() + '">' +
                            '<input type="hidden" name="hdn-credit[]' + '" value="' + $("#add-credit").val() + '">' +
                        '</tr>'
                    );

                $("#add-item-accounting").modal("hide");
                $("#add-item-accounting").find('form').trigger('reset');
            }); 

            function createModal(id)
            {

            }
            </script>

        @stop
    @else
        @section('content')
            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            <div class="alert" style="background-color: #f2f2f2">
                                <strong style="color: #565656;">You have no permission to access this page.</strong>
                            </div>
                        </h1>
                    </div>
                </div>
            </div>
        @stop
    @endif
    @else
        @section('content')
            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            <div class="alert" style="background-color: #f2f2f2">
                                <strong style="color: #565656;">You have no permission to access this page.</strong>
                            </div>
                        </h1>
                    </div>
                </div>
            </div>
        @stop
@endif