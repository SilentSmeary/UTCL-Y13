<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Basic Calculator</h1>
    <!-- form inputs for basic calculator -->
    <form method="post" action="">
        <input type="text" name="num1" placeholder="enter first number"><br><br>
        <select name="operator"><br><br><br>
            <option value="-">-</option><br>
            <option value="+">+</option><br>
            <option value="/">/</option><br>
            <option value="*">*</option><br>
        </select><br><br>
        <input type="text" name="num2" placeholder="enter second number"><br><br>
        <button type="submit">Calculate</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $num1 = $_POST["num1"];
        $num2 = $_POST["num2"];
        $operator = $_POST["operator"];

        switch ($operator) {
            case '-':
                $result = $num1 - $num2;
                break;
            case '+':
                $result = $num1 + $num2;
                break;
            case '/':
                $result = $num1 / $num2;
                break;
            case '*':
                $result = $num1 * $num2;
                break;
            default:
                $result = "Invalid operator";
        }
        echo "<br>";
        echo "<b>Result: " . $result . "</b>";
    }
    ?>

</body>
</html>