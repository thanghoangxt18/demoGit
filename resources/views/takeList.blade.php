<?php
?>
    <!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<table border="1px">
    <tr>
        <td>ID</td>
        <td>Name</td>
        <td>Contest</td>
        <td>Exam shift</td>
        <td>Subject</td>
        <td>Score</td>
        <td>Status</td>
    </tr>
    @foreach($takeList as $take)
        <tr>
            <td>{{$take->score}}</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>{{$take->status}}</td>
        </tr>
    @endforeach
</table>
</body>
</html>
