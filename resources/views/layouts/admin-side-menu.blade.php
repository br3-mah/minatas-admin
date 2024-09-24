<aside class="page-sidebar"> 
    <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
    <div class="main-sidebar" id="main-sidebar">
    <ul class="sidebar-menu" id="simple-bar">
        <li class="pin-title sidebar-main-title">  
        <div> 
            <h5 class="sidebar-title f-w-700">Pinned</h5>
        </div>
        </li>
        <li class="sidebar-main-title">
        <div>
            <h5 class="lan-1 f-w-700 sidebar-title">Home</h5>
        </div>
        </li>
        <li class="sidebar-list"><i class="fa-solid fa-thumbtack"></i><a class="sidebar-link" href="{{ route('dashboard') }}"> 
            {{-- <svg class="stroke-icon">
            <use href="#Home-dashboard"></use>
            </svg> --}}
            <h6>Dashboards</h6>
            {{-- <i class="iconly-Arrow-Right-2 icli"></i> --}}
            </a>
        
        </li>
        
        
        <li class="sidebar-main-title">
        <div>
            <h5 class="pt-3 f-w-700 sidebar-title">Manage Loan Requests</h5>
        </div>
        </li>
        
        <li class="sidebar-list"> <i class="fa-solid fa-thumbtack"></i><a class="sidebar-link" href="{{ route('view-loan-requests') }}">
            {{-- <svg class="stroke-icon">
            <use href="#Wallet"></use>
            </svg> --}}
            <h6 class="f-w-600">All Loan Requests</h6></a></li>
        <li class="sidebar-list"> <i class="fa-solid fa-thumbtack"></i><a class="sidebar-link" href="javascript:void(0)">
            {{-- <svg class="stroke-icon">
            <use href="#Bag"></use>
            </svg> --}}
            <h6 class="f-w-600">Loan Management</h6>
                <i class="fas fa-plus"></i>
            </a>
        <ul class="sidebar-submenu">
            <li> <a href="{{ route('approved-loans') }}">Open Loans</a></li>
            <li> <a href="{{ route('closed-loans') }}">Closed Loans</a></li>
            <li> <a href="{{ route('due-loans') }}">Due Loans</a></li>
            <li> <a href="{{ route('loan-arrears') }}">Loans in Arears</a></li>
            <li> <a href="{{ route('missed-repayments') }}">Missed Repayments</a></li>
            <li> <a href="{{ route('no-repayments') }}">No Repayments</a></li>
            <li> <a href="{{ route('past-maturity-date') }}">Past Maturity </a></li>
            {{-- <li><a class="submenu-title" href="javascript:void(0)">Late Loans<i class="iconly-Arrow-Right-2 icli"> </i></a>
            <ul class="according-submenu">
                <li> <a href="{{ route('one-month-late') }}"> 1 Month(s) Late Loans</a></li>
                <li> <a href="{{ route('three-month-late') }}"> 3 Month(s) Late Loans</a></li>
            </ul>
            </li> --}}
            <li> <a href="{{ route('principal-outstanding') }}">Principal Outstanding </a></li>
        </ul>
        </li>
        <li class="sidebar-list"> <i class="fa-solid fa-thumbtack"></i><a class="sidebar-link" href="{{ route('loan-calculator') }}">
            {{-- <svg class="stroke-icon">
            <use href="#Message"></use>
            </svg> --}}
            <h6 class="f-w-600">Repayment Calculator</h6></a></li>
      
        
        <li class="sidebar-main-title">
            <div>
                <h5 class="pt-3 f-w-700 sidebar-title">Customers</h5>
            </div>
        </li>
        <li class="sidebar-list"> 
            <i class="fa-solid fa-thumbtack"></i>
            <a class="sidebar-link" href="{{ route('borrowers') }}">
            {{-- <svg class="stroke-icon">
            <use href="#More-box"></use>
            </svg> --}}
            <h6 class="f-w-600">Borrowers</h6></a>
        </li>
        <li class="sidebar-list"> 
            <i class="fa-solid fa-thumbtack"></i>
            <a class="sidebar-link" href="{{ route('refs') }}">
            {{-- <svg class="stroke-icon">
            <use href="#More-box"></use>
            </svg> --}}
            <h6 class="f-w-600">References </h6></a>
        </li>

        
        <li class="sidebar-main-title">
            <div>
                <h5 class="pt-3 f-w-700 sidebar-title">Staff Members</h5>
            </div>
        </li>
        <li class="sidebar-list"> 
            <i class="fa-solid fa-thumbtack"></i>
            <a class="sidebar-link" href="{{ route('employees') }}">
            {{-- <svg class="stroke-icon">
            <use href="#More-box"></use>
            </svg> --}}
            <h6 class="f-w-600">Employees</h6></a>
        </li>
        
        <li class="sidebar-main-title">
        <div>
            <h5 class="pt-3 f-w-700 sidebar-title">Repayments</h5>
        </div>
        </li>
        <li class="sidebar-list"> <i class="fa-solid fa-thumbtack"></i><a class="sidebar-link" href="{{ route('make-payment') }}">
            {{-- <svg class="stroke-icon">
            <use href="#More-box"></use>
            </svg> --}}
            <h6 class="f-w-600">Loan Repayments</h6></a></li>
        
        <li class="sidebar-main-title">
        <div>
            <h5 class="pt-3 sidebar-title f-w-700">System Settings</h5>
        </div>
        </li>
        <li class="sidebar-list"> <i class="fa-solid fa-thumbtack"></i><a class="sidebar-link" href="{{ route('users') }}">
            {{-- <svg class="stroke-icon">
            <use href="#Filter"></use>
            </svg> --}}
            <h6 class="f-w-600">Users</h6></a>
        </li>
        <li class="sidebar-list"> <i class="fa-solid fa-thumbtack"></i><a class="sidebar-link" href="{{ route('roles') }}">
            {{-- <svg class="stroke-icon">
            <use href="#Filter"></use>
            </svg> --}}
            <h6 class="f-w-600">Roles & Permissions</h6></a>
        </li>
        <li class="sidebar-list"> <i class="fa-solid fa-thumbtack"></i><a class="sidebar-link" href="{{ route('sys-settings') }}">
            {{-- <svg class="stroke-icon">
            <use href="#Filter"></use>
            </svg> --}}
            <h6 class="f-w-600">Settings & Configurations</h6></a>
        </li>
        
    </ul>
    </div>
    <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
</aside>