<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>PetShop - Serviços</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

<div class="fundo">

    <div class-logo-fundo>
    <img class="logo" src="img/logo.png">
    </div>
    
    <h2>Cadastro de donos</h2>

    <div class="menuTopo">
        <a href="Cadastro_Donos.php">Donos</a> |
        <a href="Animais_Cadastro.php">Animais</a> |
        <a href="Servicos.php">Servicos</a> |
        <a href="Agendamentos.php">Agendamentos</a>
    </div>

    <br>

    <div class="caixa">

        <b id="tituloFormulario">Novo serviço</b>

        <br><br>

        <form id="formServico">

            <input type="hidden" id="idServico">

            Nome do serviço:<br>
            <input type="text" id="nomeServico" required>

            <br><br>

            Preço (R$):<br>
            <input type="text" id="preco" required>

            <br><br>

            <button type="submit" id="botaoSalvar">
                Cadastrar
            </button>

            <button type="button" id="botaoCancelar" style="display:none;">
                Cancelar
            </button>

            <button type="reset" id="botaoLimpar">
                Limpar
            </button>

        </form>

    </div>

    <br>

    <b>Serviços cadastrados:</b>

    <br><br>

    <div id="mensagem"></div>

    <table border="1" cellpadding="5">

        <thead>

            <tr bgcolor="#e0e0e0">
                <td>ID</td>
                <td>Serviço</td>
                <td>Preço</td>
                <td colspan="2">Ações</td>
            </tr>

        </thead>

        <tbody id="tabelaServicos">

        </tbody>

    </table>

</div>

<script src="js/servicos.js"></script>

</body>
</html>
