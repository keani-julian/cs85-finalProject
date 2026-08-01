<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', config('app.name'))</title>
    <style>
        :root {
            --bg: #f6f7f9;
            --card: #ffffff;
            --ink: #1c2024;
            --muted: #6b7280;
            --line: #e3e6ea;
            --accent: #fcba03;
            --accent-ink: #1c2024;
            --accent-text: #8a6400;
            --danger: #b42318;
            --danger-bg: #fef3f2;
        }
        * { box-sizing: border-box; }
        body {
            margin: 0;
            background: var(--bg);
            color: var(--ink);
            font: 16px/1.6 -apple-system, BlinkMacSystemFont, "Segoe UI", Helvetica, Arial, sans-serif;
        }
        .wrap { max-width: 820px; margin: 0 auto; padding: 32px 20px 64px; }
        header.site {
            border-bottom: 1px solid var(--line);
            background: var(--card);
        }
        header.site .inner {
            max-width: 820px;
            margin: 0 auto;
            padding: 16px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
        }
        header.site a.brand {
            font-weight: 700;
            font-size: 18px;
            color: var(--ink);
            text-decoration: none;
        }
        nav a {
            color: var(--accent-text);
            text-decoration: none;
            margin-left: 18px;
            font-size: 15px;
        }
        nav a:hover { text-decoration: underline; }
        h1 { font-size: 26px; margin: 0 0 8px; }
        h2 { font-size: 19px; margin: 28px 0 10px; }
        p.lede { color: var(--muted); margin: 0 0 26px; }
        .card {
            background: var(--card);
            border: 1px solid var(--line);
            border-radius: 10px;
            padding: 22px;
        }
        label { display: block; font-weight: 600; margin-bottom: 6px; font-size: 15px; }
        .hint { font-weight: 400; color: var(--muted); font-size: 13px; }
        .field { margin-bottom: 20px; }
        input[type="text"], select, textarea {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid var(--line);
            border-radius: 7px;
            font: inherit;
            background: #fff;
            color: var(--ink);
        }
        textarea { min-height: 240px; resize: vertical; font-family: ui-monospace, SFMono-Regular, Menlo, monospace; font-size: 14px; }
        input:focus, select:focus, textarea:focus { outline: 2px solid var(--accent); outline-offset: 1px; }
        .row { display: flex; gap: 16px; flex-wrap: wrap; }
        .row .field { flex: 1 1 240px; }
        button {
            background: var(--accent);
            color: var(--accent-ink);
            border: 0;
            border-radius: 7px;
            padding: 11px 20px;
            font: inherit;
            font-weight: 600;
            cursor: pointer;
        }
        button:hover { filter: brightness(1.08); }
        button.link {
            background: none;
            color: var(--danger);
            padding: 0;
            font-weight: 500;
            font-size: 14px;
            text-decoration: underline;
        }
        .alert {
            background: var(--danger-bg);
            border: 1px solid #f2c9c4;
            color: var(--danger);
            border-radius: 8px;
            padding: 12px 14px;
            margin-bottom: 22px;
        }
        .alert ul { margin: 6px 0 0; padding-left: 20px; }
        .notice {
            background: #eef6ee;
            border: 1px solid #cfe3cf;
            color: #2f6b34;
            border-radius: 8px;
            padding: 12px 14px;
            margin-bottom: 22px;
        }
        .err { color: var(--danger); font-size: 14px; margin-top: 6px; }
        .output {
            white-space: pre-wrap;
            word-wrap: break-word;
            background: #fbfbfc;
            border: 1px solid var(--line);
            border-radius: 8px;
            padding: 18px;
            font-size: 15px;
        }
        .meta { color: var(--muted); font-size: 14px; margin: 0 0 20px; }
        .badge {
            display: inline-block;
            background: #eef2f7;
            border-radius: 20px;
            padding: 3px 11px;
            font-size: 13px;
            color: #3f4a58;
            margin-right: 6px;
        }
        ul.subs { list-style: none; margin: 0; padding: 0; }
        ul.subs li { border-bottom: 1px solid var(--line); padding: 16px 0; }
        ul.subs li:last-child { border-bottom: 0; }
        ul.subs a { color: var(--accent-text); text-decoration: none; font-weight: 600; }
        ul.subs a:hover { text-decoration: underline; }
        .excerpt { color: var(--muted); font-size: 14px; margin: 6px 0 0; }
        .empty { color: var(--muted); text-align: center; padding: 30px 0; }
        .pager { margin-top: 22px; }
        .actions { display: flex; align-items: center; gap: 18px; margin-top: 26px; }
    </style>
</head>
<body>
<header class="site">
    <div class="inner">
        <a class="brand" href="{{ route('coach.create') }}">{{ config('app.name') }}</a>
        <nav>
            <a href="{{ route('coach.create') }}">New review</a>
            <a href="{{ route('coach.index') }}">History</a>
        </nav>
    </div>
</header>
<div class="wrap">
    @yield('content')
</div>
</body>
</html>
