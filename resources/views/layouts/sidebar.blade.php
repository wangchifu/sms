<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="d-flex justify-content-between">
                <div class="logo">
                    <a href="{{ route('index') }}"><img src="{{ asset('images/logo/logo.svg') }}" alt="Logo" srcset=""></a>
                    彰化縣<br>學校管理系統
                </div>
                <div class="toggler">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">
                    @guest
                        <a href="{{ route('sms_login') }}">
                            <i class="fas fa-sign-in-alt text-success"></i>
                            <span>登入</span>
                        </a>
                    @endguest
                    @auth
                        <span>{{ auth()->user()->name }}</span>
                        <a href="#" data-bs-toggle="modal"
                           data-bs-target="#logoutForm">
                            <i class="fas fa-sign-out-alt text-danger"></i>
                        </a>
                        <br>
                        {{ auth()->user()->job_title->title }}
                        @impersonating
                            <a href="{{ route('sims.impersonate_leave') }}" class="btn btn-warning btn-sm">結束模擬</a>
                        @endImpersonating
                    @endauth
                </li>
                <li class="sidebar-item active">
                    <a href="{{ route('index') }}" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <?php $school_code = school_code();$schools = config('app.schools')  ?>
                        <span> {{ $schools[$school_code] }}</span>
                    </a>
                </li>
                @auth
                    @if(auth()->user()->system_admin=="1")
                        <li class="sidebar-item  has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="fas fa-cogs"></i>
                                <span>系統管理</span>
                            </a>
                            <ul class="submenu ">
                                <li class="submenu-item ">
                                    <a href="component-alert.html">全部帳號管理</a>
                                </li>
                            </ul>
                        </li>
                    @endif
                    <?php $user_power=session('user_power'); ?>
                    @if(isset($user_power['school_admin']))
                        @if($user_power['school_admin'] == "1")
                            <li class="sidebar-item  has-sub">
                                <a href="#" class='sidebar-link'>
                                    <i class="fas fa-cog"></i>
                                    <span>本校管理</span>
                                </a>
                                <ul class="submenu ">
                                    <li class="submenu-item ">
                                        <a href="{{ route('module.index') }}">模組管理</a>
                                    </li>
                                    <li class="submenu-item ">
                                        <a href="{{ route('users.index') }}">教師帳號管理</a>
                                    </li>
                                    <li class="submenu-item ">
                                        <a href="{{ route('users.stu_index') }}">學生帳號管理</a>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    @endif
                    <li class="sidebar-item  has-sub">
                        <a href="#" class='sidebar-link'>
                            <i class="bi bi-grid-1x2-fill"></i>
                            <span>模組功能</span>
                        </a>
                        <ul class="submenu ">
                            <li class="submenu-item ">
                                <a href="{{ route('lunches.index') }}">午餐系統</a>
                            </li>
                            <li class="submenu-item ">
                                <a href="">社團報名系統</a>
                            </li>
                        </ul>
                    </li>
                    <!--
                    <li class="sidebar-item">
                        <a href="" class='sidebar-link'>
                            <i class="fas fa-praying-hands"></i>
                            <span>許願池</span>
                        </a>
                    </li>
                -->
                @endauth
            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>
@auth
    <!--logout form Modal -->
    <div class="modal fade text-left" id="logoutForm" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel33" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
             role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">登出 </h4>
                    <button type="button" class="close" data-bs-dismiss="modal"
                            aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <form id="logout_form" action="{{ route('logout') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        確定要登出？
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary"
                                data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">按錯了</span>
                        </button>
                        <button type="button" class="btn btn-primary ml-1"
                                data-bs-dismiss="modal" onclick="$('#logout_form').submit()">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">登出</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endauth
