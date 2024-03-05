<?php
main_header(['Dashboard']);
?>
<!-- ############ PAGE START-->


<head>

    <style>
        body {
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        th,
        td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            border: 1px solid #ddd;
        }

        th {
            background-color: #db7378;
            color: #fff;
            font-weight: bold;
            text-align: center;
        }

        header {
            background-color: #9f3a3b;
            color: #fff;
            padding: 15px;
        }

        .user-info {
            display: inline-block;
            text-align: left;
        }

        .user-info h1 {
            margin: 0;
            font-size: 1.5em;
        }

        .user-info p {
            margin: 5px 0 0;
            font-size: 1em;
        }

        .buttons {
            display: inline-block;
            text-align: right;
            float: right;

        }

        .buttons button {
            background-color: #f7dfe1;
            color: black;
            border: none;
            padding: 10px 15px;
            margin-left: 10px;
            cursor: pointer;
        }
    </style>
</head>

<header>



    <div class="user-info">
        <h1>Hello</h1>
        <p>
            <?= date('M d, Y - h:i A'); ?>
        </p>
    </div>
    <div class="buttons">
        <button>Acknowledge</button>
        <button onclick="load_calendar(this)">Calendar</button>
        <button onclick="load_account(this)">Accounts</button>
    </div>
</header>
<div class="container" id="load_page">
</div>















<!-- ############ PAGE END-->
<?php
main_footer();
?>
<script src="<?php echo base_url() ?>/assets/js/dashboard/dashboard.js"></script>