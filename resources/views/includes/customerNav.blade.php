<nav class="sidebar-nav">
    <ul id="sidebarnav">

         <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                     href="{{url('customers/profile' , $data['id'])}}" aria-expanded="false"><i
                    class="fas fa-user"></i><span class="hide-menu">My Profile</span></a></li>
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                     href="{{url('client/profile' , $data->id)}}" aria-expanded="false"><i
                    class="far fa-edit"></i><span class="hide-menu">Edit Profile</span></a></li>
    
    </ul>
    <!-- <li class="breadcrumb-item active"><a href="{{url('client/profile' , $data->id)}}">Edit Profile</a></li> -->

</nav