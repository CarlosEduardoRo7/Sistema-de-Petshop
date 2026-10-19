<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>PetShop - Agendamentos</title>
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

        <b id="tituloFormulario">Novo agendamento</b>

        <br><br>

        <form id="formAgendamento">

            <input type="hidden" id="idAgendamento">

            Data:<br>
            <input type="date" id="dataAgendamento" required>

            <br><br>

            Horário:<br>
            <input type="time" id="horario" required>

            <br><br>

            Animal:<br>

            <select id="idAnimal" required>

                <option value="">Selecione o animal</option>

            </select>

            <br><br>

            Serviço:<br>

            <select id="idServico" required>

                <option value="">Selecione o serviço</option>

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

    <b>Agendamentos cadastrados:</b>

    <br><br>

    <div id="mensagem"></div>

    <table border="1" cellpadding="5">

        <thead>

            <tr bgcolor="#e0e0e0">
                <td>ID</td>
                <td>Data</td>
                <td>Horário</td>
                <td>Animal</td>
                <td>Serviço</td>
                <td colspan="2">Ações</td>
            </tr>

        </thead>

        <tbody id="tabelaAgendamentos">

        </tbody>

    </table>

</div>

<script src="js/agendamentos.js"></script>

</body>
</html>
