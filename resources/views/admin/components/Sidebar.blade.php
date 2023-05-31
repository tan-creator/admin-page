<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item collapsed">
            <a class="nav-link " href="/dashboard">
                <i class="bi bi-grid"></i>
                <span>{{ __('layout_master.dashboard') }}</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="/users">
                <i class="bi bi-people"></i>
                <span>{{ __('layout_master.users') }}</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="/departments">
                <i class="bi bi-diagram-3"></i>
                <span>{{ __('layout_master.departments') }}</span>
            </a>
        </li><!-- End Dashboard Nav -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{route('certifications.index')}}">
                <i class="bi bi-tablet-landscape"></i>
                <span>{{ __('layout_master.certifications') }}</span>
            </a>
        </li><!-- End Dashboard Nav -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{route('projects.index')}}">
                <i class="bi bi-layout-text-window-reverse"> </i>
                <span>{{ __('layout_master.projects') }}</span>
            </a>
        </li><!-- End Dashboard Nav -->
        <li class="nav-heading">{{ __('layout_master.pages') }}</li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="/logout">
                <i class="bi bi-box-arrow-right"></i>
                <span>{{ __('layout_master.sign_out') }}</span>
            </a>
        </li><!-- End Login Page Nav -->

    </ul>

</aside>