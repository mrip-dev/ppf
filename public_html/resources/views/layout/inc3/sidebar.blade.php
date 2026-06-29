
<!--  BEGIN MAIN CONTAINER  -->
<div class="main-container" id="container">

<div class="overlay"></div>
<div class="search-overlay"></div>

<!--  BEGIN SIDEBAR  -->
<div class="sidebar-wrapper sidebar-theme">

    <nav id="sidebar">

        <div class="navbar-nav theme-brand flex-row  text-center">
            <div class="nav-logo">
                <div class="nav-item theme-logo">
                    <a href="/">
                        <img src="/assets/src/assets/img/logo.png" style="margin-right:20px !important;" class="" alt="logo">
                    </a>
                </div>
                <div class="nav-item theme-text">
                    <a href="/" class="nav-link">{{auth()->user()->name}}</a>
                </div>
                <input type="hidden" name="" id="my_event_name" value="">
            </div>
            <div class="nav-item sidebar-toggle">
                <div class="btn-toggle sidebarCollapse">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevrons-left"><polyline points="11 17 6 12 11 7"></polyline><polyline points="18 17 13 12 18 7"></polyline></svg>
                </div>
            </div>
        </div>
        <div class="shadow-bottom"></div>
        <!--- Menu ---> 
        @include('layout.inc3.menu')
        <!--- Ending Menu --->
        
    </nav>

</div>
<!--  END SIDEBAR  -->

<!--  BEGIN CONTENT AREA  -->
<div id="content" class="main-content">

<div class="layout-px-spacing">

<div class="middle-content container-xxl p-0">

    <div class="row layout-top-spacing">