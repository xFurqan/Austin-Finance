<nav class="sidebar-nav">         
    <ul id="sidebarnav">
        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                     href="{{url('customers')}}" aria-expanded="false"><i
                    class="fas fa-users"></i><span class="hide-menu">Customers</span></a></li>
                    <li class="sidebar-item">
                            <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)"
                                aria-expanded="false">
                                <i class="mdi mdi-gauge"></i>
                                <span class="hide-menu">Statistics</span>
                            </a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item">
                                    <a href="{{url('statistics')}}" class="sidebar-link">
                                        <i class="mdi mdi-adjust"></i>
                                        <span class="hide-menu"> United States Stats </span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="{{url('aus-statistics')}}" class="sidebar-link">
                                        <i class="mdi mdi-adjust"></i>
                                        <span class="hide-menu"> Australia Stats </span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                     href="{{url('instructions')}}" aria-expanded="false"><i
                    class="fas fa-hands-helping"></i><span class="hide-menu">Instructions</span></a></li>
    </ul>
</nav>
