<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Regular Expression Demo</title>
</head>
<body>
    <style type="text/css">
    em {
        background-color: #FF0;
        border-top: 1px solid #000;
        border-bottom: 1px solid #000;
    }
    </style>
    <?php
        $string = <<<TEST_DATA
            <h2>Regular Expression Testing</h2>
            <p>In this document, there is a lot of text that can be matched using regex. The benefit of using a regular expression is much more flexible, albeit complex, syntax for text pattern matching</p>
            <p>After you get the hang of regular expressions, also called regexes, they will become a powerful tool  for pattern matching.</p>
TEST_DATA;

        // compare str_replace => select all word like regular without upper case
        echo str_replace('regular', '<em>regular</em>', $string);

        echo '<p><b>use: str_replace("regular", "<em>regular</em>", $string)</b></p>
        <hr/>';

        // compare preg_replace => select all word like regular without upper case
        echo preg_replace('/regular/', '<em>regular</em>', $string);

        echo '<p><b>use: preg_replace("/regular/", "<em>regular</em>", $string)</b></p>
        <hr/>';

        // compare str_replace => select all word like regular
        echo str_ireplace('regular', '<em>regular</em>', $string);

        echo '<p><b>use: str_ireplace("regular", "<em>regular</em>", $string)</b></p>
        <hr/>';

        // compare preg_replace => select all word like regular
        echo preg_replace('/regular/i', '<em>regular</em>', $string);

        echo '<p><b>use: preg_replace("/regular/i", "<em>regular</em>", $string)</b></p>
        <hr/>';

        $section = str_replace('regular', '<em>regular</em>', $string);

        echo '<p><b>use: str_replace("regular", "<em>regular</em>", $section)</b></p>
        <hr/>';

        echo str_replace('Regular', '<em>Regular</em>', $section);

        echo '<p><b>use: str_replace("Regular", "<em>Regular</em>", $section)</b></p>
        <hr/>';

        echo preg_replace('/(regular)/i', '<em>$1</em>', $string);

        echo '<p><b>use: preg_replace("/(regular)/i", "<em>$1</em>", $string)</b></p>
        <hr/>';

        echo preg_replace('/([a-c])/i', '<em>$1</em>', $string);

        echo '<p><b>use: preg_replace("/([a-c])/i", "<em>$1</em>", $string)</b></p>
        <hr/>';
        
        echo preg_replace('/([^a-c])/i', '<em>$1</em>', $string);

        echo '<p><b>use: khong nhan nhung gia tri tu a den c preg_replace("/([^a-c])/i", "<em>$1</em>", $string)</b></p>
        <hr/>';

        echo preg_replace('/(\b\w{4}\b)/i', '<em>$1</em>', $string);

        echo '<p><b>use: preg_replace("/(\b\w{4}\b)/i", "<em>$1</em>", $string)</b></p>
        <hr/>';

        echo preg_replace('/\b(\w{3}|\w{6,7})\b/i', '<em>$1</em>', $string);

        echo '<p><b>use: preg_replace("/\b(\w{3}|\w{6,7})\b/i", "<em>$1</em>", $string)</b></p>
        <hr/>';
       
        echo preg_replace('/(expressions?)/i', '<em>$1</em>', $string);

        echo '<p><b>use: preg_replace("/(expressions?)/i", "<em>$1</em>", $string)</b></p>
        <hr/>';
        
        echo preg_replace('/(regex(es)?)/i', '<em>$1</em>', $string);

        echo '<p><b>use: preg_replace("/(regex(es)?)/i", "<em>$1</em>", $string)</b></p>
        <hr/>';

        echo preg_replace('/(reg(ular\s)?ex(es)?)/i', '<em>$1</em>', $string);

        echo '<p><b>use: preg_replace("/(reg(ular\s)?ex(es)?)/i", "<em>$1</em>", $string)</b></p>
        <hr/>';
        
        echo preg_replace('/(reg(ular\s)?ex(pression|es)?)/i', '<em>$1</em>', $string);

        echo '<p><b>use: preg_replace("/(reg(ular\s)?ex(pression|es)?)/i", "<em>$1</em>", $string)</b></p>
        <hr/>';
        
        echo preg_replace('/(reg(ular\s)?ex(pressions?|es)?)/i', '<em>$1</em>', $string);

        echo '<p><b>use: preg_replace("/(reg(ular\s)?ex(pressions?|es)?)/i", "<em>$1</em>", $string)</b></p>
        <hr/>';

        $dates[] = '2019-01-01 19:00:00';
        $dates[] = 'Tuesday, January 01st at 7pm';
        $dates[] = '01/01/19 07:00pm';
        $dates[] = '2019-01-01 190:00:00';

        foreach($dates as $date) {
            echo '<p>,' . preg_replace('/(\d*)/', '<em>$1</em>', $date) . '</p>';
        }
        echo '<p><b>use: preg_replace("/(\d*)/", "<em>$1</em>", $dates)</b></p>
        <hr/>';
        
        foreach($dates as $date) {
            echo '<p>,' . preg_replace('/^(\d{4}(-\d{2}))/', '<em>$1</em>', $date) . '</p>';
        }
        echo '<p><b>use: preg_replace("/^(\d{4}(-d{2})/", "<em>$1</em>", $dates)</b></p>
        <hr/>';
        
        foreach($dates as $date) {
            echo '<p>,' . preg_replace('/^(\d{4}(-\d{2}){2})/', '<em>$1</em>', $date) . '</p>';
        }
        echo '<p><b>use: preg_replace("/^(\d{4}(-d{2}){2})/", "<em>$1</em>", $dates)</b></p>
        <hr/>';
        
        foreach($dates as $date) {
            echo '<p>,' . preg_replace('/^(\d{4}(-\d{2}){2} (\d{2})(:\d{2}){2})$/', '<em>$1</em>', $date) . '</p>';
        }
        echo '<p><b>use: preg_replace("/^(\d{4}(-\d{2}){2} (\d{2})(:\d{2}){2})$/", "<em>$1</em>", $dates)</b></p>
        <hr/>';
    ?>
</body>
</html>