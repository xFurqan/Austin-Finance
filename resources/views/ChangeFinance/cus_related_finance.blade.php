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
@include('includes.header')    <!-- ============================================================== -->
    <!-- End Topbar header -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Left Sidebar - style you can find in sidebar.scss  -->
    <!-- ============================================================== -->
    <aside class="left-sidebar">
        <!-- Sidebar scroll-->
        <div class="scroll-sidebar">
            <!-- User profile -->
            <div class="user-profile position-relative" style="background: url(../assets/images/background/user-info.jpg) no-repeat;">
                <!-- User profile image -->
                <div class="profile-img"> <img src="{{URL::asset('assets/images/users/profile.png')}}" alt="user" class="w-100" /> </div>
                <!-- User profile text-->
                <div class="profile-text pt-1">
                    <a href="#" class="dropdown-toggle u-dropdown w-100 text-white d-block position-relative" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">Markarn Doe</a>
                    <div class="dropdown-menu animated flipInY">
                        <a href="#" class="dropdown-item"><i class="ti-user"></i>
                            My Profile</a>
                        <a href="#" class="dropdown-item"><i class="ti-wallet"></i> My
                            Balance</a>
                        <a href="#" class="dropdown-item"><i class="ti-email"></i> Inbox</a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item"><i class="ti-settings"></i> Account Setting</a>
                        <div class="dropdown-divider"></div>
                        <a href="authentication-login1.html" class="dropdown-item"><i class="fa fa-power-off"></i> Logout</a>
                    </div>
                </div>
            </div>
            <!-- End User profile text-->
            <!-- Sidebar navigation-->
        @include('includes.nav')
        <!-- End Sidebar navigation -->
        </div>
        <!-- End Sidebar scroll-->
        <!-- Bottom points-->
        <div class="sidebar-footer">
            <!-- item-->
            <a href="" class="link" data-toggle="tooltip" title="Settings"><i class="ti-settings"></i></a>
            <!-- item-->
            <a href="" class="link" data-toggle="tooltip" title="Email"><i class="mdi mdi-gmail"></i></a>
            <!-- item-->
            <a href="" class="link" data-toggle="tooltip" title="Logout"><i class="mdi mdi-power"></i></a>
        </div>
        <!-- End Bottom points-->
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
                <h3 class="text-themecolor mb-0">Change Finance</h3>
                <ol class="breadcrumb mb-0 p-0 bg-transparent">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Admin Change Finance</li>
                </ol>
            </div>
            <div class="col-md-7 col-12 align-self-center d-none d-md-block">
                <div class="d-flex mt-2 justify-content-end">
                    <div class="d-flex mr-3 ml-2">
                        <div class="chart-text mr-2">
                            <h6 class="mb-0"><small>THIS MONTH</small></h6>
                            <h4 class="mt-0 text-info">$58,356</h4>
                        </div>
                        <div class="spark-chart">
                            <div id="monthchart"></div>
                        </div>
                    </div>
                    <div class="d-flex ml-2">
                        <div class="chart-text mr-2">
                            <h6 class="mb-0"><small>LAST MONTH</small></h6>
                            <h4 class="mt-0 text-primary">$48,356</h4>
                        </div>
                        <div class="spark-chart">
                            <div id="lastmonthchart"></div>
                        </div>
                    </div>
                </div>
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
            <!-- Row -->
{{--            @foreach($customerRelatedFinance as $data)--}}
{{--            @endforeach--}}
            @foreach($dataFinance as $data)
            @endforeach
            <div class="row">
                <div class="col-lg-12">
                    <form method="POST" action="{{url('changed-finance'.'/'.$data->id.'/'.$data->customer_id)}}" class="form-horizontal striped-rows b-form">
                        @csrf
                        <div class="card-body">

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
                                        <label for="inputEmail3"  class="control-label col-form-label">Current Amount</label>
                                    </div>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" value="{{$data->current_amount}}" name="current_amount" class="form-control"  readonly >

                                </div>
                            </div>
                            <div class="form-group row border-bottom mb-0 py-3 bg-light">
                                <div class="col-sm-3">
                                    <div class="d-flex align-items-center justify-content-end">
                                        <label for="inputEmail3" class="control-label col-form-label">Select Date</label>
                                    </div>
                                </div>
                                <div class="col-sm-9">
                                    <input type="datetime-local" name="finance_date" class="form-control"  >
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
                <table id="demo-foo-addrow"
                       class="table table-bordered m-t-30 table-hover contact-list" data-paging="true"
                       data-paging-size="7">
                    <thead>
                    <tr>
                        <th>No</th>
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
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                <button class="btn btn-info edit" data-id="" data-toggle="modal" data-target="#add-contact">
                                    <i class="fa fa-edit " aria-hidden="true"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>

            </div>

            <!-- Row -->
            <!-- ============================================================== -->
            <!-- End PAge Content -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Right sidebar -->
            <!-- ============================================================== -->
            <!-- .right-sidebar -->
            <!-- ============================================================== -->
            <!-- End Right sidebar -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- footer -->
        <!-- ============================================================== -->
        <footer class="footer">
            © 2020 Material Pro Admin by wrappixel.com
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
<div class="chat-windows"></div>
<!-- ============================================================== -->
<!-- All Jquery -->
<!-- ============================================================== -->
@include('includes.scripts')
</body>

</html>
