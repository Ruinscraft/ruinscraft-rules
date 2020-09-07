<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="main.css">
    <script defer src="/main.js"></script>
    <title>Ruinscraft Rules</title>
</head>
    <body>
          <?php
            foreach (scandir("./rules") as $ruleDir) {
                if ($ruleDir[0] == '.') {
                    continue;
                }

                if (!is_dir("./rules/" . $ruleDir)) {
                    continue;
                }

                $_categoryFile = "./rules/" . $ruleDir . "/_category.json";

                if (!file_exists($_categoryFile)) {
                    continue;
                }

                $_category = json_decode(file_get_contents($_categoryFile), true);

                echo "<h2>" . $_category['title'] . "</h2>";

                foreach (scandir("./rules/" . $ruleDir) as $ruleFile) {
                    if ($ruleFile[0] == '.') {
                        continue;
                    }

                    if (!is_file("./rules/" . $ruleDir . "/" . $ruleFile)) {
                        continue;
                    }

                    if ($ruleFile == "_category.json") {
                        continue;
                    }

                    $rule = json_decode(file_get_contents("./rules/" . $ruleDir . "/" . $ruleFile), true);

                    echo "
                        <button type=\"button\" class=\"collapsible\">" . $rule['rule'] . "</button>
                        <div class=\"content\">
                            <p>" . $rule['reason'] . "</p>
                        </div>
                    ";
                }
            }
          ?>
    </body>
</html>
