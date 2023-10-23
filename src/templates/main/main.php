<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Мой блог</title>
    <style>
        .layout {
            width: 100%;
            max-width: 1024px;
            margin: auto;
            background-color: white;
            border-collapse: collapse;
        }

        .layout tr td {
            padding: 20px;
            vertical-align: top;
            border: solid 1px gray;
        }

        .header {
            font-size: 30px;
        }

        .footer {
            text-align: center;
        }

        .sidebarHeader {
            font-size: 20px;
        }

        .sidebar ul {
            padding-left: 20px;
        }

        a, a:visited {
            color: darkgreen;
        }
    </style>
</head>
<body>

<table class="layout">
    <tr>
        <td colspan="2" class="header">
            Мой блог
        </td>
    </tr>
    <tr>
        <td>
            <h2>Статья 1</h2>
            <p>Всем привет, это текст первой статьи</p>
            <hr>

            <h2>Статья 2</h2>
            <p>Всем привет, это текст второй статьи</p>
        </td>

        <td width="300px" class="sidebar">
            <div class="sidebarHeader">Меню</div>
            <ul>
                <li><a href="/">Главная страница</a></li>
                <li><a href="/about-me">Обо мне</a></li>
            </ul>
        </td>
    </tr>
    <tr>
        <td class="footer" colspan="2">Все права защищены (c) Мой блог</td>
    </tr>
</table>

</body>
</html>