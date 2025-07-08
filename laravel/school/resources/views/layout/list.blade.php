<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
        data-accordion="false">

        @if(Auth::user()->role=='admin')

        <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}" class="nav-link @if (Request::segment(2)=='admin') active @endif">
                
            
                <i class="nav-icon fas fa-th"></i>
                <p>
                    Dashboard
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.list') }}"  class="nav-link @if (Request::segment(2)=='admin') active @endif">
                <i class="nav-icon far fa-user"></i>
                <p>admin</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('stu.read') }}" class="nav-link">
                <i class="nav-icon fas fa-chart-pie"></i>
                <p>
                    Student
                </p>
            </a>
            
        </li>
        <li class="nav-item">
            <a href="{{ route('te.read') }}" class="nav-link">
                <i class="nav-icon fas fa-chart-pie"></i>
                <p>
                    Teacher
                </p>
            </a>
            
        </li>
        <li class="nav-item">
            <a href="{{ route('pa.read') }}" class="nav-link">
                <i class="nav-icon fas fa-chart-pie"></i>
                <p>
                    Parent
                </p>
            </a>
            
        </li>
        <li class="nav-item">
            <a href="{{ route('class.read') }}" class="nav-link">
                <i class="nav-icon fas fa-chart-pie"></i>
                <p>
                    class
                </p>
            </a>
           
        </li>
        <li class="nav-item">
            <a href="{{ route('sub.list') }}" class="nav-link">
                <i class="nav-icon fas fa-chart-pie"></i>
                <p>
                    Subject
                </p>
            </a>
           
        </li>
        <li class="nav-item">
            <a href="{{ route('cs.list') }}" class="nav-link">
                <i class="nav-icon fas fa-chart-pie"></i>
                <p>
                    Class & Subject
                </p>
            </a>
           
        </li>
        <li class="nav-item">
            <a href="{{ route('ct.list') }}" class="nav-link">
                <i class="nav-icon fas fa-chart-pie"></i>
                <p>
                   Assign Class to Teacher
                </p>
            </a>
           
        </li>
        <li class="nav-item">
            <a href="{{ url('admin/changPass') }}" class="nav-link">
                <i class="nav-icon fas fa-chart-pie"></i>
                <p>
                    ChangePassword
                </p>
            </a>
           
        </li>
        <li class="nav-item">
            <a href="{{ route('academic-year.create') }}" class="nav-link">
                <i class="nav-icon fas fa-chart-pie"></i>
                <p>
                    Academic year
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('academic-year.create') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Add Record</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('academic-year.read') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Review Record</p>
                    </a>
                </li>
            </ul>
        </li>
        

        <li class="nav-item">
            <a href="{{ route('fee-head.create') }}" class="nav-link">
                <i class="nav-icon fas fa-chart-pie"></i>
                <p>
                    Fee Head
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('fee-head.create') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Add Record</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('fee-head.read') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Review Recor</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a href="{{ route('fee-str.create') }}" class="nav-link">
                <i class="nav-icon fas fa-chart-pie"></i>
                <p>
                    Fee Structure
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('fee-str.create') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Add Record</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('fee-str.read') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Review Recor</p>
                    </a>
                </li>
            </ul>
        </li>
      
        @elseif (Auth::user()->role=="student")
        <li class="nav-item">
            <a href="{{ route('teacher.dashboard') }}"  class="nav-link @if (Request::segment(2)=='admin') active @endif">
                <i class="nav-icon fas fa-th"></i>
                <p>
                    Dashboard
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('stu.my-subject') }}"  class="nav-link @if (Request::segment(2)=='admin') active @endif">
                <i class="nav-icon fas fa-th"></i>
                <p>
                    My Subject
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ url('student/profile') }}" class="nav-link">
                <i class="nav-icon fas fa-chart-pie"></i>
                <p>
                    My Profile
                </p>
            </a>
           
        </li>
        <li class="nav-item">
            <a href="{{ url('student/changPass') }}" class="nav-link">
                <i class="nav-icon fas fa-chart-pie"></i>
                <p>
                    ChangePassword
                </p>
            </a>
           
        </li>
        @elseif (Auth::user()->role=="teacher")
        <li class="nav-item">
            <a href="{{ route('teacher.dashboard') }}"  class="nav-link @if (Request::segment(2)=='admin') active @endif">
                <i class="nav-icon fas fa-th"></i>
                <p>
                    Dashboard
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('teacher.subject.class') }}"  class="nav-link @if (Request::segment(2)=='admin') active @endif">
                <i class="nav-icon fas fa-th"></i>
                <p>
                    My Class Subject
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ url('teacher/profile') }}" class="nav-link">
                <i class="nav-icon fas fa-chart-pie"></i>
                <p>
                    My Profile
                </p>
            </a>
           
        </li>
        <li class="nav-item">
            <a href="{{ url('teacher/changPass') }}" class="nav-link">
                <i class="nav-icon fas fa-chart-pie"></i>
                <p>
                    ChangePassword
                </p>
            </a>
           
        </li>
        @elseif(Auth::user()->role=="parent")
        <li class="nav-item">
            <a href="{{ route('parent.dashboard') }}"  class="nav-link @if (Request::segment(2)=='admin') active @endif">
                <i class="nav-icon fas fa-th"></i>
                <p>
                    Dashboard
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('pa.myStu',Auth::user()->id) }}"  class="nav-link @if (Request::segment(2)=='admin') active @endif">
                <i class="nav-icon fas fa-th"></i>
                <p>
                    My Son
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ url('parent/profile') }}" class="nav-link">
                <i class="nav-icon fas fa-chart-pie"></i>
                <p>
                    My Profile
                </p>
            </a>
           
        </li>
        <li class="nav-item">
            <a href="{{ url('parent/changPass') }}" class="nav-link">
                <i class="nav-icon fas fa-chart-pie"></i>
                <p>
                    ChangePassword
                </p>
            </a>
           
        </li>
        @endif


        <li class="nav-item">
            <a href="{{ route('admin.logout') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Logout</p>
            </a>
        </li>

    </ul>
</nav>