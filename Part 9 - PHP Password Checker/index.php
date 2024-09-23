<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <div class="centered_div">
        <h1>Password Checker</h1>
        <!-- form inputs for basic calculator -->
        <form method="post" action="">
            <input type="text" name="num1" placeholder="enter first number" min="0"><br><br>
            <select name="operator"><br><br><br>
                <option value="-">-</option><br>
                <option value="+">+</option><br>
                <option value="/">/</option><br>
                <option value="*">*</option><br>
            </select><br><br>
            <input type="text" name="num2" placeholder="enter second number" min="0"><br><br>
            <button type="submit">Calculate</button>
            <br>
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $num1 = $_POST["num1"];
            $num2 = $_POST["num2"];
            $operator = $_POST["operator"];
            if (is_numeric($num1) and is_numeric($num2)) {
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
            } else {
                echo "<b>Error: Please enter valid numbers.</b>";
            }
        }
        ?>
    </div>
</body>
</html>