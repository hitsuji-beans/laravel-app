<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blade Test</title>

    <link rel="stylesheet" href="https://d3ov4xow0ip7nw.cloudfront.net/Materials/css/neumorphism.css">
    <style>
        :root {
            --main-base: rgb(107, 107, 107);
        }

        body {
            margin: 0;
            color: var(--main-base);
        }

        header {
            height: 3rem;
            display: flex;
            padding: 1rem;
        }

        .container {
            padding: 2rem
        }

        .app-title {
            display: inline-flex;
            align-items: center;
            font-size: 1.6rem;
            font-weight: bold;
        }

        .btn {
            cursor: pointer;
            min-width: 2rem;
            min-height: 2rem;
            border: none;
            border-radius: 50px;
            padding: 0.5rem 1rem;
            margin: 0 1rem;
            font-size: 1rem;
            font-weight: bold;
            color: var(--main-color);
            transition: all 0.2s;
        }

        .btn:hover {
            filter: brightness(0.9) contrast(1);
        }

        .btn:active {
            filter: brightness(1) contrast(0.8);
            box-shadow: none;
        }

        .card {
            border-radius: 5px;
            padding: 1.4rem;
            margin-bottom: 3rem;
        }

        .card .card-header {
            padding-bottom: 1rem;
        }

        .card .card-header .card-header-title {
            font-size: 1.6rem;
            margin: 0;
        }

        .card .card-body {}

        .card .card-text {
            font-size: 1rem;
            margin: 0;
            padding-bottom: 0.8rem;
        }

        .card .card-actions {
            display: flex;
            padding: 1rem;
            margin: -1rem;
            margin-top: 0;
        }
    </style>
</head>

<body>
    <header class="neumorphism">
        <div class="app-title ">{{ config('app.name') }}</div>
    </header>
    <div class="container">
        <div class="card neumorphism elevation-1 neu-flat">
            <div class="card-header">
                <h1 class="card-header-title">
                    Laravel教材【基礎編】
                </h1>
            </div>
            <div class="card-body">
                <p class="card-text">
                    ここから本当の意味で基礎編がスタートします。頑張っていきましょう。
                </p>
                <p class="card-text">
                    ちなみにこれはニューモーフィズム（neumorphism）というデザインです。
                    新しいものでもないですが、柔らかい感じが結構いいですよね。
                </p>
                <p class="card-text">
                    スタイルシートを外部から読み込んでいるので、インターネットに接続できていないとうまく表示されません。
                </p>
            </div>
            <div class="card-actions">
                <button class="btn neumorphism neu-flat">FLAT</button>
                <button class="btn neumorphism neu-concave">CONCAVE</button>
                <button class="btn neumorphism neu-convex">CONVEX</button>
                <button class="btn neumorphism neu-pressed">PRESSED</button>
            </div>
        </div>

    </div>
</body>

</html>