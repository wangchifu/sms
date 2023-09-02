<ul class="nav nav-tabs">
    <li class="nav-item">
        <a class="nav-link {{ $active['index'] }}" href="{{ route('sports.index') }}">歷次成績</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ $active['setup'] }}" href="{{ route('sports.setup') }}">設定</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ $active['sign_up'] }}" href="{{ route('sports.sign_up') }}">導師報名</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ $active['list'] }}" href="{{ route('sports.list') }}">各式表單</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ $active['score'] }}" href="{{ route('sports.score') }}">成績處理</a>
    </li>    
</ul>
