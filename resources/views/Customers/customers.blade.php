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
    <aside class="left-sidebar">
        <!-- Sidebar scroll-->
        <div class="scroll-sidebar">
            <!-- User profile -->
            <div class="user-profile position-relative" style="background: url(../public/assets/images/background/user-info.jpg) no-repeat;">
                <!-- User profile image -->
                <div class="profile-img"> <img src="public/assets/images/users/profile.png" alt="user" class="w-100" /> </div>
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
                <h3 class="text-themecolor mb-0">Customer Table</h3>
                <ol class="breadcrumb mb-0 p-0 bg-transparent">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Customer Table</li>
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
                            <h4 class="card-title">Customers list</h4>
                            <h6 class="card-subtitle"></h6>
                            <a href="{{route('customers.create')}}" type="button" class="btn btn-info btn-rounded m-t-10 mb-2 float-right">Add New Customer</a>
                            <!-- Add Contact Popup Model -->
                            <div class="table-responsive">
                                @if ($message = Session::get('success'))
                                    <div class="alert alert-success alert-block">
                                        <button type="button" class="close" data-dismiss="alert">??</button>
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @endif
                                <table id="demo-foo-addrow"
                                       class="table table-bordered m-t-30 table-hover contact-list" data-paging="true"
                                       data-paging-size="7">
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Given Name</th>
                                        <th>Surname</th>
                                        <th>Email</th>
                                        <th>Interest Rate</th>
                                        <th>Login</th>
                                        <th>Notes</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                        <th>Change Finance</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                     @foreach($customers as $customer)
                                    @if($customer->status  == 1)
                                    <tr>
                                        <td>{{$customer->id}}</td>
                                        <td>{{$customer->name}}</td>
                                        <td>{{$customer->surname}}</td>
                                        <td>{{$customer->email}}</td>
                                        <td>{{$customer->interest_rate}}</td>
                                        <td>{{$customer->login}}</td>
                                        <td>{{$customer->notes}}</td>
                                        <td>{{$customer->status}}</td>

                                        <td>
                                            <a href="{{route('customers.edit' , $customer->id)}}" class=""><i class="fa fa-eye" aria-hidden="true"></i></a>
                                            <a style="color: #009efb;" data-id="{{$customer->id}}" class="customer_delete"><i class="fa fa-trash" aria-hidden="true"></i></a>
 
                                        </td>
                                        <td><a href="{{url('finance' , $customer->id)}}" class="btn badge-danger btn-sm w-75">Change Finance</a></td>
                                    </tr>
                                    @else
                                     <tr style="background-color: #ff000045;">
                                        <td>{{$customer->id}}</td>
                                        <td>{{$customer->name}}</td>
                                        <td>{{$customer->surname}}</td>
                                        <td>{{$customer->email}}</td>
                                        <td>{{$customer->interest_rate}}</td>
                                        <td>{{$customer->login}}</td>
                                        <td>{{$customer->notes}}</td>
                                        <td>{{$customer->status}}</td>
                                        <td>
                                            <a href="{{route('customers.edit' , $customer->id)}}" class=""><i class="fa fa-eye" aria-hidden="true"></i></a>

                                        </td>                                    
                                    </tr>
                                    @endif
                                    @endforeach


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>                    <!-- Table -->
                    <!-- Table -->
                    <!-- Table -->
                </div>
            </div>

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
            ?? 2020 designstallion.com
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
        $('.customer_delete').on("click",function (){
           var confirmation = confirm("are you sure you want to remove this customer account?");
           let el = this;
           customerId = $(this).attr("data-id");
           if(confirmation){
               $.ajax({
                   url: '{{URL::asset('customers')}}/'+customerId,
                   type: 'DELETE',
                   data:{
                       _token: '{{csrf_token()}}'
                   },
                   success: function (response){
                       //JUGAAR
                       $.ajax({
                            url: '{{URL::asset('customers')}}',
                            type: 'GET',
                            success: function (response){
                                location.reload();
                            },
                            error: function (error){
                                alert("Error Encounter ! Contact ASFF IT Department");
                            }
                        });
                   },
                   error: function (error){
                       alert("Error Encounter ! Contact ASFF IT Department");
                   }
               });

           }
       });
    });
      

</script>
