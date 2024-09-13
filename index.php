<?php

    // Setando variáveis iniciais, cookies, valores, operações e erro.
    $cookie_name1 = "numero";
    $cookie_value1 = "";
    $cookie_name2 = "operacao";
    $cookie_value2 = "";

    $num = "";
    $error = false;

    $num_tela = "";

    // Definindo fuso-horário de São Paulo como padrão.
    date_default_timezone_set('America/Sao_Paulo');
    // Definindo horário para mostrar na tela.
    $agora = date('H:i');

    // Se o número foi enviado e não houve erro, concatena o número.
    if (isset($_POST['numero'])) {
        if (isset($_POST['input']) && !is_numeric($_POST['input'])) {
            // Se a entrada atual é um erro, reseta o valor de $num.
            $num = $_POST['numero'];
            $num_tela = $_POST['numero'];
            
        } else {
            // Concatenando o número atual ao valor anterior.
            $ver_valor = isset($_POST['input']) ? $_POST['input'] . $_POST['numero'] : $_POST['numero'];

            if (strlen($ver_valor) <= 8) {
                $num = isset($_POST['input']) ? $_POST['input'] . $_POST['numero'] : $_POST['numero'];
                $num_tela = isset($_POST['input']) ? $_POST['input'] . $_POST['numero'] : $_POST['numero'];
            }else{
                $num_tela = "N max: 8";
            }
        }
            
    }

    if (isset($_POST['operacao'])) {
        // Guardar o número atual no cookie.
        $cookie_value1 = $_POST['input'];
        setcookie($cookie_name1, $cookie_value1, time() + (86400 * 30), "/");

        // Guardar a operação no cookie.
        $cookie_value2 = $_POST['operacao'];
        setcookie($cookie_name2, $cookie_value2, time() + (86400 * 30), "/");

        $num = "";
        $num_tela = "";
    }

    // Caso aperte o botão +/- para inverter de positivo ou negativo.
    if (isset($_POST['+/-'])) {
        $num = $_POST['input'];
        if ($num != "" && is_numeric($num)) {
            $result = $num * -1;
            $num = $result;
            $num_tela = $result;
        }
    }

    // Gerando resultrado da conta.
    if (isset($_POST['igual'])) {
        $num = $_POST['input'];
        // Verificação se foi clicado os valores e as operações.
        if (isset($_COOKIE['operacao']) && isset($_COOKIE['numero'])) {
            // Escolhendo qual opção o usuário selecionou.
            switch ($_COOKIE['operacao']) {
                case "+":
                    $result = $_COOKIE['numero'] + $num;
                    break;
                case "-":
                    $result = $_COOKIE['numero'] - $num;
                    break;
                case "x":
                    $result = $_COOKIE['numero'] * $num;
                    break;
                case "÷":
                    if ($num != 0) {
                        $result = $_COOKIE['numero'] / $num;
                    } else {
                        $result = "Erro: d/0";
                        $error = true;
                        
                    }
                    break;
                case "%":
                    $result = $_COOKIE['numero'] % $num;
                    break;
                default:
                    $result = "Operação inválida";
                    break;
            }
            // Atualizando na tela.
            $num = $result;

            // Se houver um erro, exibir a mensagem.
            if ($error) {
                $num_tela = $result;
            }else{
                if(strlen($result) <= 8){
                    $num_tela = $result;
                }else{
                    $num_tela = "N alto p tela";
                }
            }

        }
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./forms/style3.css">

    <title>Calculadora</title>
</head>
<body>

    <header>
        <div class="horario">
            <?php echo $agora ?>
        </div>
        <div class="som_camera">
            <div class="som">-</div>
            <div class="camera">
                <div class="lente">-</div>
            </div>
        </div>
        <div class="situacao">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-reception-4" viewBox="0 0 16 16">
                <path d="M0 11.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5zm4-3a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5v5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5zm4-3a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5v8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5zm4-3a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5v11a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5z"/>
              </svg>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-wifi" viewBox="0 0 16 16">
                <path d="M15.384 6.115a.485.485 0 0 0-.047-.736A12.44 12.44 0 0 0 8 3C5.259 3 2.723 3.882.663 5.379a.485.485 0 0 0-.048.736.52.52 0 0 0 .668.05A11.45 11.45 0 0 1 8 4c2.507 0 4.827.802 6.716 2.164.205.148.49.13.668-.049"/>
                <path d="M13.229 8.271a.482.482 0 0 0-.063-.745A9.46 9.46 0 0 0 8 6c-1.905 0-3.68.56-5.166 1.526a.48.48 0 0 0-.063.745.525.525 0 0 0 .652.065A8.46 8.46 0 0 1 8 7a8.46 8.46 0 0 1 4.576 1.336c.206.132.48.108.653-.065m-2.183 2.183c.226-.226.185-.605-.1-.75A6.5 6.5 0 0 0 8 9c-1.06 0-2.062.254-2.946.704-.285.145-.326.524-.1.75l.015.015c.16.16.407.19.611.09A5.5 5.5 0 0 1 8 10c.868 0 1.69.201 2.42.56.203.1.45.07.61-.091zM9.06 12.44c.196-.196.198-.52-.04-.66A2 2 0 0 0 8 11.5a2 2 0 0 0-1.02.28c-.238.14-.236.464-.04.66l.706.706a.5.5 0 0 0 .707 0l.707-.707z"/>
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-battery-charging" viewBox="0 0 16 16">
                <path d="M9.585 2.568a.5.5 0 0 1 .226.58L8.677 6.832h1.99a.5.5 0 0 1 .364.843l-5.334 5.667a.5.5 0 0 1-.842-.49L5.99 9.167H4a.5.5 0 0 1-.364-.843l5.333-5.667a.5.5 0 0 1 .616-.09z"/>
                <path d="M2 4h4.332l-.94 1H2a1 1 0 0 0-1 1v4a1 1 0 0 0 1 1h2.38l-.308 1H2a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2"/>
                <path d="M2 6h2.45L2.908 7.639A1.5 1.5 0 0 0 3.313 10H2zm8.595-2-.308 1H12a1 1 0 0 1 1 1v4a1 1 0 0 1-1 1H9.276l-.942 1H12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2z"/>
                <path d="M12 10h-1.783l1.542-1.639q.146-.156.241-.34zm0-3.354V6h-.646a1.5 1.5 0 0 1 .646.646M16 8a1.5 1.5 0 0 1-1.5 1.5v-3A1.5 1.5 0 0 1 16 8"/>
            </svg>
        </div>
    </header>

    <section>

        <div class="resultado">
            <p>
                <?php echo @$num_tela ?>
            </p>
        </div>

        <form action="" method="POST">
            <input type="hidden" name="input" value="<?php echo $num_tela; ?>">

            <div>
                <input class="ots_funcao" type="submit" name="apagar" value="AC">
                <input class="ots_funcao" type="submit" name="+/-" value="+/-">
                <input class="ots_funcao" type="submit" name="operacao" value="%">
                <input class="funcao" type="submit" name="operacao" value="÷">
            </div>

            <div>
                <input type="submit" name="numero" value="7">
                <input type="submit" name="numero" value="8">
                <input type="submit" name="numero" value="9">
                <input class="funcao" type="submit" name="operacao" value="x">
            </div>

            <div>
                <input type="submit" name="numero" value="4">
                <input type="submit" name="numero" value="5">
                <input type="submit" name="numero" value="6">
                <input class="funcao" type="submit" name="operacao" value="-">
            </div>

            <div>
                <input type="submit" name="numero" value="1">
                <input type="submit" name="numero" value="2">
                <input type="submit" name="numero" value="3">
                <input class="funcao" type="submit" name="operacao" value="+">
            </div>

            <div>
                <input class="zero" type="submit" name="numero" value="0">
                <input type="submit" name="numero" value=".">
                <input class="funcao" name="igual" type="submit" value="=">
            </div>
        </form>

    </section>

    <footer>
        <div class="linha">-</div>
    </footer>

    <script src="./forms/script.js"></script>
</body>
</html>
