<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>PetShop - Cadastro de Animais</title>
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

        <b id="tituloFormulario">Novo animal</b>

        <br><br>

        <form id="formAnimal">

            <input type="hidden" id="idAnimal">

            Nome do animal:<br>
            <input type="text" id="nomeAnimal" required>

            <br><br>

            Idade:<br>
            <input type="number" id="idade" required>

            <br><br>

            Peso (kg):<br>
            <input type="text" id="peso" required>

            <br><br>

            Espécie:<br>
            <input type="text" id="especie" required>

            <br><br>

            Raça:<br>
            <input type="text" id="raca">

            <br><br>

            Dono:<br>

            <select id="idDono" required>

                <option value="">Selecione o dono</option>

            </select>

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

    <b>Animais cadastrados:</b>

    <br><br>

    <div id="mensagem"></div>

    <table border="1" cellpadding="5">

        <thead>

            <tr bgcolor="#e0e0e0">
                <td>ID</td>
                <td>Nome</td>
                <td>Idade</td>
                <td>Peso</td>
                <td>Espécie</td>
                <td>Raça</td>
                <td>Dono</td>
                <td colspan="2">Ações</td>
            </tr>

        </thead>

        <tbody id="tabelaAnimais">

        </tbody>

    </table>

</div>

<script src="js/animais.js"></script>

</body>
</html>
