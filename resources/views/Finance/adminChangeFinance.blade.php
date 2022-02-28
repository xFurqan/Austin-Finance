<!DOCTYPE html>
<html dir="ltr" lang="en">
@include('includes.head')


<body>
<!-- ============================================================== -->
<!-- Preloader - style you can find in spinners.css -->
<!-- ============================================================== -->
<div class="preloader">
    <div class="lds-ripple">
        <div class="lds-pos"></div>
        <div class="lds-pos"></div>
    </div>
</div>
<!-- ============================================================== -->
<!-- Main wrapper - style you can find in pages.scss -->
<!-- ============================================================== -->
<div id="main-wrapper">
    <!-- ============================================================== -->
    <!-- Topbar header - style you can find in pages.scss -->
    <!-- ============================================================== -->
@include('includes.header')
<!-- ============================================================== -->
    <!-- End Topbar header -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Left Sidebar - style you can find in sidebar.scss  -->
    <!-- ============================================================== -->
    <aside class="left-sidebar">
        <!-- Sidebar scroll-->
        <div class="scroll-sidebar">
            <!-- User profile -->
            <div class="user-profile position-relative" style="background: url(../public/assets/images/background/user-info.jpg) no-repeat;">
                <!-- User profile image -->
                <div class="profile-img"> <img src="{{URL::asset('public/assets/images/users/profile.png')}}" alt="user" class="w-100" /> </div>
                <!-- User profile text-->
                <div class="profile-text pt-1">
                    <a href="#" class="text-white d-block position-relative" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">{{Auth::user()->name}}</a>
                </div>
            </div>
            <!-- End User profile text-->
            <!-- Sidebar navigation-->
        @include('includes.nav')
        <!-- End Sidebar navigation -->
        </div>
        <!-- End Sidebar scroll-->
       
    </aside>
    <!-- ============================================================== -->
    <!-- End Left Sidebar - style you can find in sidebar.scss  -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Page wrapper  -->
    <!-- ============================================================== -->
    <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="row page-titles">
            <div class="col-md-5 col-12 align-self-center">
                <h3 class="text-themecolor mb-0">Admin Finance</h3>
                <ol class="breadcrumb mb-0 p-0 bg-transparent">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Admin Finance</li>
                </ol>
            </div>
        </div>

        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">
                <!-- ============================================================== -->
            <!-- Start Page Content -->
            <!-- ============================================================== -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Finance</h4>
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                         

                        </div>
                        <hr class="mt-0">
                        <form method="POST" action="{{url('finance' , $data->id)}}" class="form-horizontal striped-rows b-form">
                            @csrf
                            <div class="card-body">
                                <input type="hidden" name="country" value="{{$data->country}}">

                                <div class="form-group row border-bottom mb-0 py-3">
                                    <div class="col-sm-3">
                                        <div class="d-flex align-items-center justify-content-end">
                                            <label for="inputEmail3" class="control-label col-form-label">Account Selected</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" value="{{$data->account_number}}" name="account_number" class="form-control" disabled>
                                    </div>
                                </div>
                                <div class="form-group row border-bottom mb-0 py-3 bg-light">
                                    <div class="col-sm-3">
                                        <div class="d-flex align-items-center justify-content-end">
                                            <label for="inputEmail3" class="control-label col-form-label">Account Title</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" value="{{$data->account_title}}" name="account_title"  class="form-control" readonly  >
                                    </div>
                                </div>
                                <div class="form-group row border-bottom mb-0 py-3">
                                    <div class="col-sm-3">
                                        <div class="d-flex align-items-center justify-content-end">
                                            <label for="inputEmail3"  class="control-label col-form-label">Amount ($)</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control"  name="amount" >
                                    </div>
                                </div>
                                <div class="form-group row mb-0 py-3 bg-light">


                                    <div class="col-sm-3">
                                        <div class="d-flex align-items-center justify-content-end">
                                            <label for="inputEmail3" class="control-label col-form-label">Type</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-9">
                                        <select id="account_type" name="account_type" class="form-control">
                                            <option value="0">--SELECT--</option>
                                            <option value="1">Deposit</option>
                                            <option value="2">Interest Changed</option>
                                            <option value="3">Withdrawal</option>
                                        </select>
                                        
                                    </div>
                                </div>

                                <div class="form-group row border-bottom mb-0 py-3">
                                    <div class="col-sm-3">
                                        <div class="d-flex align-items-center justify-content-end">
                                            <label for="inputEmail3" class="control-label col-form-label">Current Amount ($)</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-9">
                                      <input type="text" value="" name="current_amount" class="form-control" readonly>
                                    </div>
                                </div>

                                <div class="form-group row border-bottom mb-0 py-3 bg-light">
                                    <div class="col-sm-3">
                                        <div class="d-flex align-items-center justify-content-end">
                                            <label for="inputEmail3" class="control-label col-form-label">Select Date</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="datetime-local" name="date" class="form-control"  >
                                    </div>
                                </div>


                            <div class="card-body">
                                <div class="form-group mb-0 text-right">
                                    <button type="submit" class="btn btn-info waves-effect waves-light">Save</button>
                                    <button type="submit" class="btn btn-dark waves-effect waves-light">Cancel</button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
        <div class="container">
            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
            @endif
            @if($message = Session::get('error'))
                <div class="alert alert-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
            @endif
            <button class="btn-success" id="show">View Details</button>
            <button class="btn-danger" id="hide">Hide</button>
            @if(isset($dataFinance[0]->id))
            <button class="btn-info" id="hide"> <a style="color:white;" href="{{url('client-details' , $data->id)}}">Client Page</a></button>
            @else
            <button class="btn-info" id="hide" disabled="disabled">Client Page</button>
            @endif
             <div class="form-group mb-0 text-right">
                <select name="currencyConversion" id="currencyConversion" class="form-select btn-secondary btn btn-dark waves-effect waves-light text-right" aria-label="Default select example">
                    @foreach($currency as $cur)
                    <option id="{{$data->id}}"  value="{{$cur->id}}">{{$cur->name}}</option>
                    @endforeach
                </select>                                    
            </div>
            <table id="demo-foo-addrow" class="table table-bordered m-t-30 table-hover contact-list" data-paging="true"data-paging-size="7">
                <thead>
                <tr>
                    <th>No</th>
                    <!-- <th>Country</th> -->
                    <th>Date</th>
                    <th>Deposit</th>
                    <th>Withdrawl</th>
                    <th>Comments</th>
                    <th>Gained Interest</th>
                    <th>Total Amount</th>

                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @php $count = 0 @endphp
                @foreach($dataFinance as $finance)
                    <tr>
                        <td>{{++$count}}</td>
                        <!-- <td>{{$finance->country}}</td> -->
                        <td>{{$finance->date}}</td>
                        <td>{{$finance->amount ? '$'.$finance->amount : NULL}}</td>
                        <td>{{$finance->withdrawal ? '$'.$finance->withdrawal : NULL}}</td>
                        <td>{{$finance->comments}}</td>
                        <td>{{$finance->gained_interest  ? '$'.number_format($finance->gained_interest,2) : NULL}}</td>
                        <td>{{$finance->current_amount  ? '$'.number_format((float)$finance->current_amount,2) : NULL}}</td>
                         <td>
                            <a style="color: #009efb;" class="edit" data-id="{{$finance->id}}" data-toggle="modal" data-target="#add-contact"><i class="fa fa-edit" aria-hidden="true"></i></a>
                            <a style="color: #009efb;" href="{{url('deleteFentry/'.$data->id.'/'.$finance->id)}}"><i class="fa fa-trash" aria-hidden="true"></i></a>

                        </td>
                    </tr>
                @endforeach
              
                </tbody>
            </table>

            <!-- Add Contact Popup Model -->
            <div id="add-contact" class="modal fade in" tabindex="-1" role="dialog"
                 aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">Update Row</h4>
                            <button type="button" class="close" data-dismiss="modal"
                                    aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            @if(isset($finance->id))
                            <form class="form-horizontal form-material" action="{{url('update-finance' , $finance->id)}}" method="POST">
                                <div class="form-group">
                                    <div class="col-md-12 m-b-20">
                                        <label>Date:</label>
                                        <input type="text" id="date" name="date" class="form-control">
                                    </div>
                                    <div class="col-md-12 m-b-20">
                                        <label>Deposit:</label>
                                        <input type="text" id="deposit" name="deposit" class="form-control">
                                    </div>
                                    <div class="col-md-12 m-b-20">
                                        <label>Withdrawal:</label>
                                        <input id="withdrawal" type="text" name="withdrawal" class="form-control">
                                    </div>
                                    <div class="col-md-12 m-b-20">
                                        <label>Comments:</label>
                                        <input id="comment" type="text" name="comment" class="form-control">
                                    </div>
                                    <div class="col-md-12 m-b-20">
                                        <label>Gained Interest</label>
                                        <input id="gained" type="text" name="gained" class="form-control">
                                    </div>
                                    <div class="col-md-12 m-b-20">
                                        <label>Total Amount:</label>
                                        <input id="current_amount" type="text" name="total" class="form-control"> 
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button id="financeRowUpdate" data-id="{{$finance->id}}" type="button" class="btn btn-info waves-effect"
                                    data-dismiss="modal">Save</button>
                            <button type="button" class="btn btn-default waves-effect"
                                    data-dismiss="modal">Cancel</button>
                        </div>
                        
                    </div>
                    <!-- /.modal-content -->
                </div>
                @endif
                <!-- /.modal-dialog -->
            </div>   
         
            </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- footer -->
        <!-- ============================================================== -->
        <footer class="footer">
            © 2020 designstallion.com
        </footer>
        <!-- ============================================================== -->
        <!-- End footer -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Page wrapper  -->
    <!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Wrapper -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- customizer Panel -->
<!-- ============================================================== -->
<aside class="customizer">
    <a href="javascript:void(0)" class="service-panel-toggle"><i class="fa fa-spin fa-cog"></i></a>
    <div class="customizer-body">
        <ul class="nav customizer-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab"
                   aria-controls="pills-home" aria-selected="true"><i class="mdi mdi-wrench font-20"></i></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#chat" role="tab"
                   aria-controls="chat" aria-selected="false"><i class="mdi mdi-message-reply font-20"></i></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab"
                   aria-controls="pills-contact" aria-selected="false"><i
                        class="mdi mdi-star-circle font-20"></i></a>
            </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
            <!-- Tab 1 -->
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                <div class="p-3 border-bottom">
                    <!-- Sidebar -->
                    <h5 class="font-medium mb-2 mt-2">Layout Settings</h5>
                    <div class="checkbox checkbox-info mt-3">
                        <input type="checkbox" name="theme-view" class="material-inputs" id="theme-view">
                        <label for="theme-view"> <span>Dark Theme</span> </label>
                    </div>
                    <div class="checkbox checkbox-info mt-2">
                        <input type="checkbox" class="sidebartoggler material-inputs" name="collapssidebar" id="collapssidebar">
                        <label for="collapssidebar"> <span>Collapse Sidebar</span> </label>
                    </div>
                    <div class="checkbox checkbox-info mt-2">
                        <input type="checkbox" name="sidebar-position" class="material-inputs" id="sidebar-position">
                        <label for="sidebar-position"> <span>Fixed Sidebar</span> </label>
                    </div>
                    <div class="checkbox checkbox-info mt-2">
                        <input type="checkbox" name="header-position" class="material-inputs" id="header-position">
                        <label for="header-position"> <span>Fixed Header</span> </label>
                    </div>
                    <div class="checkbox checkbox-info mt-2">
                        <input type="checkbox" name="boxed-layout" class="material-inputs" id="boxed-layout">
                        <label for="boxed-layout"> <span>Boxed Layout</span> </label>
                    </div>
                </div>
                <div class="p-3 border-bottom">
                    <!-- Logo BG -->
                    <h5 class="font-medium mb-2 mt-2">Logo Backgrounds</h5>
                    <ul class="theme-color m-0 p-0">
                        <li class="theme-item list-inline-item mr-1"><a href="javascript:void(0)" class="theme-link rounded-circle d-block"
                                                                        data-logobg="skin1"></a></li>
                        <li class="theme-item list-inline-item mr-1"><a href="javascript:void(0)" class="theme-link rounded-circle d-block"
                                                                        data-logobg="skin2"></a></li>
                        <li class="theme-item list-inline-item mr-1"><a href="javascript:void(0)" class="theme-link rounded-circle d-block"
                                                                        data-logobg="skin3"></a></li>
                        <li class="theme-item list-inline-item mr-1"><a href="javascript:void(0)" class="theme-link rounded-circle d-block"
                                                                        data-logobg="skin4"></a></li>
                        <li class="theme-item list-inline-item mr-1"><a href="javascript:void(0)" class="theme-link rounded-circle d-block"
                                                                        data-logobg="skin5"></a></li>
                        <li class="theme-item list-inline-item mr-1"><a href="javascript:void(0)" class="theme-link rounded-circle d-block"
                                                                        data-logobg="skin6"></a></li>
                    </ul>
                    <!-- Logo BG -->
                </div>
                <div class="p-3 border-bottom">
                    <!-- Navbar BG -->
                    <h5 class="font-medium mb-2 mt-2">Navbar Backgrounds</h5>
                    <ul class="theme-color m-0 p-0">
                        <li class="theme-item list-inline-item mr-1"><a href="javascript:void(0)" class="theme-link rounded-circle d-block"
                                                                        data-navbarbg="skin1"></a></li>
                        <li class="theme-item list-inline-item mr-1"><a href="javascript:void(0)" class="theme-link rounded-circle d-block"
                                                                        data-navbarbg="skin2"></a></li>
                        <li class="theme-item list-inline-item mr-1"><a href="javascript:void(0)" class="theme-link rounded-circle d-block"
                                                                        data-navbarbg="skin3"></a></li>
                        <li class="theme-item list-inline-item mr-1"><a href="javascript:void(0)" class="theme-link rounded-circle d-block"
                                                                        data-navbarbg="skin4"></a></li>
                        <li class="theme-item list-inline-item mr-1"><a href="javascript:void(0)" class="theme-link rounded-circle d-block"
                                                                        data-navbarbg="skin5"></a></li>
                        <li class="theme-item list-inline-item mr-1"><a href="javascript:void(0)" class="theme-link rounded-circle d-block"
                                                                        data-navbarbg="skin6"></a></li>
                    </ul>
                    <!-- Navbar BG -->
                </div>
                <div class="p-3 border-bottom">
                    <!-- Logo BG -->
                    <h5 class="font-medium mb-2 mt-2">Sidebar Backgrounds</h5>
                    <ul class="theme-color m-0 p-0">
                        <li class="theme-item list-inline-item mr-1"><a href="javascript:void(0)" class="theme-link rounded-circle d-block"
                                                                        data-sidebarbg="skin1"></a></li>
                        <li class="theme-item list-inline-item mr-1"><a href="javascript:void(0)" class="theme-link rounded-circle d-block"
                                                                        data-sidebarbg="skin2"></a></li>
                        <li class="theme-item list-inline-item mr-1"><a href="javascript:void(0)" class="theme-link rounded-circle d-block"
                                                                        data-sidebarbg="skin3"></a></li>
                        <li class="theme-item list-inline-item mr-1"><a href="javascript:void(0)" class="theme-link rounded-circle d-block"
                                                                        data-sidebarbg="skin4"></a></li>
                        <li class="theme-item list-inline-item mr-1"><a href="javascript:void(0)" class="theme-link rounded-circle d-block"
                                                                        data-sidebarbg="skin5"></a></li>
                        <li class="theme-item list-inline-item mr-1"><a href="javascript:void(0)" class="theme-link rounded-circle d-block"
                                                                        data-sidebarbg="skin6"></a></li>
                    </ul>
                    <!-- Logo BG -->
                </div>
            </div>
            <!-- End Tab 1 -->
            <!-- Tab 2 -->
            <div class="tab-pane fade" id="chat" role="tabpanel" aria-labelledby="pills-profile-tab">
                <ul class="mailbox list-style-none mt-3">
                    <li>
                        <div class="message-center chat-scroll position-relative">
                            <a href="javascript:void(0)" class="message-item d-flex align-items-center border-bottom px-3 py-2" id='chat_user_1' data-user-id='1'>
                                <span  class="user-img position-relative d-inline-block"> <img src="assets/images/users/1.jpg" alt="user" class="rounded-circle w-100"> <span class="profile-status rounded-circle online"></span> </span>
                                <div class="w-75 d-inline-block v-middle pl-2">
                                    <h5 class="message-title mb-0 mt-1">Pavan kumar</h5> <span class="font-12 text-nowrap d-block text-muted text-truncate">Just see the my admin!</span> <span class="font-12 text-nowrap d-block text-muted">9:30 AM</span> </div>
                            </a>
                            <!-- Message -->
                            <a href="javascript:void(0)" class="message-item d-flex align-items-center border-bottom px-3 py-2" id='chat_user_2' data-user-id='2'>
                                <span  class="user-img position-relative d-inline-block"> <img src="assets/images/users/2.jpg" alt="user" class="rounded-circle w-100"> <span class="profile-status rounded-circle busy"></span> </span>
                                <div class="w-75 d-inline-block v-middle pl-2">
                                    <h5 class="message-title mb-0 mt-1">Sonu Nigam</h5> <span class="font-12 text-nowrap d-block text-muted text-truncate">I've sung a song! See you at</span> <span class="font-12 text-nowrap d-block text-muted">9:10 AM</span> </div>
                            </a>
                            <!-- Message -->
                            <a href="javascript:void(0)" class="message-item d-flex align-items-center border-bottom px-3 py-2" id='chat_user_3' data-user-id='3'>
                                <span  class="user-img position-relative d-inline-block"> <img src="assets/images/users/3.jpg" alt="user" class="rounded-circle w-100"> <span class="profile-status rounded-circle away"></span> </span>
                                <div class="w-75 d-inline-block v-middle pl-2">
                                    <h5 class="message-title mb-0 mt-1">Arijit Sinh</h5> <span class="font-12 text-nowrap d-block text-muted text-truncate">I am a singer!</span> <span class="font-12 text-nowrap d-block text-muted">9:08 AM</span> </div>
                            </a>
                            <!-- Message -->
                            <a href="javascript:void(0)" class="message-item d-flex align-items-center border-bottom px-3 py-2" id='chat_user_4' data-user-id='4'>
                                <span  class="user-img position-relative d-inline-block"> <img src="assets/images/users/4.jpg" alt="user" class="rounded-circle w-100"> <span class="profile-status rounded-circle offline"></span> </span>
                                <div class="w-75 d-inline-block v-middle pl-2">
                                    <h5 class="message-title mb-0 mt-1">Nirav Joshi</h5> <span class="font-12 text-nowrap d-block text-muted text-truncate">Just see the my admin!</span> <span class="font-12 text-nowrap d-block text-muted">9:02 AM</span> </div>
                            </a>
                            <!-- Message -->
                            <!-- Message -->
                            <a href="javascript:void(0)" class="message-item d-flex align-items-center border-bottom px-3 py-2" id='chat_user_5' data-user-id='5'>
                                <span  class="user-img position-relative d-inline-block"> <img src="assets/images/users/5.jpg" alt="user" class="rounded-circle w-100"> <span class="profile-status rounded-circle offline"></span> </span>
                                <div class="w-75 d-inline-block v-middle pl-2">
                                    <h5 class="message-title mb-0 mt-1">Sunil Joshi</h5> <span class="font-12 text-nowrap d-block text-muted text-truncate">Just see the my admin!</span> <span class="font-12 text-nowrap d-block text-muted">9:02 AM</span> </div>
                            </a>
                            <!-- Message -->
                            <!-- Message -->
                            <a href="javascript:void(0)" class="message-item d-flex align-items-center border-bottom px-3 py-2" id='chat_user_6' data-user-id='6'>
                                <span  class="user-img position-relative d-inline-block"> <img src="assets/images/users/6.jpg" alt="user" class="rounded-circle w-100"> <span class="profile-status rounded-circle offline"></span> </span>
                                <div class="w-75 d-inline-block v-middle pl-2">
                                    <h5 class="message-title mb-0 mt-1">Akshay Kumar</h5> <span class="font-12 text-nowrap d-block text-muted text-truncate">Just see the my admin!</span> <span class="font-12 text-nowrap d-block text-muted">9:02 AM</span> </div>
                            </a>
                            <!-- Message -->
                            <!-- Message -->
                            <a href="javascript:void(0)" class="message-item d-flex align-items-center border-bottom px-3 py-2" id='chat_user_7' data-user-id='7'>
                                <span  class="user-img position-relative d-inline-block"> <img src="assets/images/users/7.jpg" alt="user" class="rounded-circle w-100"> <span class="profile-status rounded-circle offline"></span> </span>
                                <div class="w-75 d-inline-block v-middle pl-2">
                                    <h5 class="message-title mb-0 mt-1">Pavan kumar</h5> <span class="font-12 text-nowrap d-block text-muted text-truncate">Just see the my admin!</span> <span class="font-12 text-nowrap d-block text-muted">9:02 AM</span> </div>
                            </a>
                            <!-- Message -->
                            <!-- Message -->
                            <a href="javascript:void(0)" class="message-item d-flex align-items-center border-bottom px-3 py-2" id='chat_user_8' data-user-id='8'>
                                <span  class="user-img position-relative d-inline-block"> <img src="assets/images/users/8.jpg" alt="user" class="rounded-circle w-100"> <span class="profile-status rounded-circle offline"></span> </span>
                                <div class="w-75 d-inline-block v-middle pl-2">
                                    <h5 class="message-title mb-0 mt-1">Varun Dhavan</h5> <span class="font-12 text-nowrap d-block text-muted text-truncate">Just see the my admin!</span> <span class="font-12 text-nowrap d-block text-muted">9:02 AM</span> </div>
                            </a>
                            <!-- Message -->
                        </div>
                    </li>
                </ul>
            </div>
            <!-- End Tab 2 -->
            <!-- Tab 3 -->
            <div class="tab-pane fade p-3" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                <h6 class="mt-3 mb-3">Activity Timeline</h6>
                <div class="steamline">
                    <div class="sl-item">
                        <div class="sl-left bg-success"> <i class="ti-user"></i></div>
                        <div class="sl-right">
                            <div class="font-medium">Meeting today <span class="sl-date"> 5pm</span></div>
                            <div class="desc">you can write anything </div>
                        </div>
                    </div>
                    <div class="sl-item">
                        <div class="sl-left bg-info"><i class="fas fa-image"></i></div>
                        <div class="sl-right">
                            <div class="font-medium">Send documents to Clark</div>
                            <div class="desc">Lorem Ipsum is simply </div>
                        </div>
                    </div>
                    <div class="sl-item">
                        <div class="sl-left"> <img class="rounded-circle" alt="user"
                                                   src="assets/images/users/2.jpg"> </div>
                        <div class="sl-right">
                            <div class="font-medium">Go to the Doctor <span class="sl-date">5 minutes ago</span>
                            </div>
                            <div class="desc">Contrary to popular belief</div>
                        </div>
                    </div>
                    <div class="sl-item">
                        <div class="sl-left"> <img class="rounded-circle" alt="user"
                                                   src="assets/images/users/1.jpg"> </div>
                        <div class="sl-right">
                            <div><a href="javascript:void(0)">Stephen</a> <span class="sl-date">5 minutes ago</span>
                            </div>
                            <div class="desc">Approve meeting with tiger</div>
                        </div>
                    </div>
                    <div class="sl-item">
                        <div class="sl-left bg-primary"> <i class="ti-user"></i></div>
                        <div class="sl-right">
                            <div class="font-medium">Meeting today <span class="sl-date"> 5pm</span></div>
                            <div class="desc">you can write anything </div>
                        </div>
                    </div>
                    <div class="sl-item">
                        <div class="sl-left bg-info"><i class="fas fa-image"></i></div>
                        <div class="sl-right">
                            <div class="font-medium">Send documents to Clark</div>
                            <div class="desc">Lorem Ipsum is simply </div>
                        </div>
                    </div>
                    <div class="sl-item">
                        <div class="sl-left"> <img class="rounded-circle" alt="user"
                                                   src="assets/images/users/4.jpg"> </div>
                        <div class="sl-right">
                            <div class="font-medium">Go to the Doctor <span class="sl-date">5 minutes ago</span>
                            </div>
                            <div class="desc">Contrary to popular belief</div>
                        </div>
                    </div>
                    <div class="sl-item">
                        <div class="sl-left"> <img class="rounded-circle" alt="user"
                                                   src="assets/images/users/6.jpg"> </div>
                        <div class="sl-right">
                            <div><a href="javascript:void(0)">Stephen</a> <span class="sl-date">5 minutes ago</span>
                            </div>
                            <div class="desc">Approve meeting with tiger</div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Tab 3 -->
        </div>
    </div>
</aside>
<div class="chat-windows"></div>
<!-- ============================================================== -->
<!-- All Jquery -->
<!-- ============================================================== -->
@include('includes.scripts')
</body>

</html>
<script>
    $(document).ready(function(){
        $("#hide").click(function(){
            $("#demo-foo-addrow").hide();
        });
        $("#show").click(function(){
            $("#demo-foo-addrow").show();
        });

        $('#currencyConversion').on('change', function (e) {
            var optionSelected = $("option:selected", this);
            var country = this.value;
            var customer = $(this).children(":selected").attr("id");
            $.ajax({
                url: '{{URL::asset('currency')}}/'+country+'/'+customer,
                type: 'GET',
                success: function(response){
                    console.log(response)
                        $("#demo-foo-addrow tbody").empty();
                        $.each(response ,function(key,value){
                            if(country == 2)
                            {
                                $("#demo-foo-addrow tbody").append('<tr><td>'+ ++key +'</td><td>'+value.date+'</td><td>'+(value.amount ? value.amount : '' )+'</td><td>'+ (value.withdrawal ? value.withdrawal : '') +'</td><td>'+value.comments+'</td><td>'+'A$ ' +(value.gained_interest*1.314119/1).toFixed(2)+'</td><td>'+'A$ ' +(value.current_amount*1.314119/1).toFixed(2)+'</td></tr>');

                            }else{
                                $("#demo-foo-addrow tbody").append('<tr><td>'+ ++key +'</td><td>'+value.date+'</td><td>'+(value.amount ? value.amount : '' )+'</td><td>'+ (value.withdrawal ? value.withdrawal : '')+'</td><td>'+value.comments+'</td><td>'+'$ ' +parseFloat(value.gained_interest).toFixed(2)+'</td><td>'+'$ ' +parseFloat(value.current_amount).toFixed(2)+'</td><td><a style="color: #009efb;" data-id="'+value.id+'" data-toggle="modal" data-target="#add-contact"><i class="fa fa-edit" aria-hidden="true"></i></a><a href="'+value.id+'"><i class="fa fa-trash" aria-hidden="true"></i></a></td></tr>');
                            }
                        });
                    },
                error: function(error){
                    console.log(error);
                },
            })
        });

        $(document).on("click" , '.edit' ,  function (){
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
            let id = $(this).attr("data-id");
        $.ajax({
            url: '{{URL::asset("edit-finance")}}/'+id+'/edit',
            type: 'GET',
            success: function (response){
              console.log(response);
                $("#date").val(response[0].date);
                $("#deposit").val(response[0].amount);
                $("#withdrawal").val(response[0].withdrawal);
                $("#comment").val(response[0].comments);
                $("#gained").val(response[0].gained_interest);
                $("#total").val(response[0].current_amount);
            },
            error: function (error){
                console.log(error)
            },
        });
    });    
    // Update Values of Finance
       $("#financeRowUpdate").on("click",function (){
           let id = $(this).attr('data-id');
           let gained = $("#gained").val();
           let date = $("#date").val();
           let total = $("#current_amount").val();
           let deposit = $("#deposit").val();
           let withdrawal = $("#withdrawal").val();
           let comment = $("#comment").val();
            $.ajax({
                url: '{{URL::asset("update-finance")}}/'+id,
                type: "POST",
                data: {
                    _token:'{{ csrf_token() }}',
                    total: total,
                    deposit: deposit,
                    withdrawal: withdrawal,
                    comment: comment,
                    date: date,
                    gained: gained
                },
                success: function (response){
                    location.reload();
                },
                error: function (error){
                    alert("Error Encounter ! Contact ASFF IT Department");
                }
            });
        }); 
});
</script>
