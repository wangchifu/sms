<ul class="nav nav-tabs">
    <li class="nav-item">
        <a class="nav-link {{ $active['semester'] }}" href="{{ route('clubs.index') }}">學期設定</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ $active['setup'] }}" href="{{ route('clubs.setup') }}">社團設定</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ $active['list'] }}" href="{{ route('clubs.report') }}">報表輸出</a>
    </li>
</ul>
