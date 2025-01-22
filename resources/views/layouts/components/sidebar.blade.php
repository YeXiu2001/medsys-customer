<div class="vertical-menu" >

    <div data-simplebar class="h-100">


        <div id="sidebar-menu">
            
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" key="t-menu">Menu</li>

                <li>
                    <a href="/home" class="waves-effect">
                        <i class="bx bx-chat"></i>
                        <span key="t-chat">Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="#" class="waves-effect">
                        <i class="bx bx-chat"></i>
                        <span key="t-chat">Pharmacy Info</span> 
                        <!-- View/Edit/Delete Pharmacy Information and Ads -->
                    </a>
                </li>
                
                @can('Super Admin')
                <li class="menu-title" key="t-menu">Developer</li>

                <li>
                    <a href="#" class="waves-effect">
                        <i class="bx bx-user"></i>
                        <span key="t-chat">Pharmacy</span>
                    </a>
                </li>
                <li>
                    <a href="/users" class="waves-effect">
                        <i class="bx bx-user"></i>
                        <span key="t-chat">User</span>
                    </a>
                </li>
                <li>
                    <a href="/roles" class="waves-effect">
                        <i class="bx bx-chat"></i>
                        <span key="t-chat">Role</span>
                    </a>
                </li>
                @endcan

            </ul>

        </div>

    </div>
    
</div>