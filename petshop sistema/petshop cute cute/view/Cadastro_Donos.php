<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>PetShop - Cadastro de Donos</title>
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

        <b id="tituloFormulario">Novo dono</b>

        <br><br>

        <form id="formDono">

            <input type="hidden" id="idDono">

            Nome:<br>
            <input type="text" id="nomeDono" required>

            <br><br>

            CPF:<br>
            <input type="text" id="cpf" maxlength="11" required>

            <br><br>

            Telefone:<br>
            <input type="text" id="fone">

            <br><br>

            <button type="submit" id="btnSalvar">
                Cadastrar
            </button>

            <button type="button" id="btnCancelar" style="display:none;">
                Cancelar
            </button>

            <button type="reset" id="btnLimpar">
                Limpar
            </button>

        </form>

    </div>

    <br>

    <b>Donos já cadastrados:</b>

    <br><br>

    <div id="mensagem"></div>

    <table border="1" cellpadding="5">

        <thead>

            <tr bgcolor="#e0e0e0">
                <td>ID</td>
                <td>Nome</td>
                <td>CPF</td>
                <td>Telefone</td>
                <td colspan="2">Ações</td>
            </tr>

        </thead>

        <tbody id="tabelaDonos">

        </tbody>

    </table>

</div>

<script src="js/donos.js"></script>

</body>
</html>
