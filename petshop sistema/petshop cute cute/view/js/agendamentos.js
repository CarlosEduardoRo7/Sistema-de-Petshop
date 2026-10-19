const api = "../api/agendamentos.php";

const formulario = document.getElementById("formAgendamento");

const idAgendamento = document.getElementById("idAgendamento");
const dataAgendamento = document.getElementById("dataAgendamento");
const horario = document.getElementById("horario");
const idAnimal = document.getElementById("idAnimal");
const idServico = document.getElementById("idServico");

const tabela = document.getElementById("tabelaAgendamentos");

const titulo = document.getElementById("tituloFormulario");
const botaoSalvar = document.getElementById("botaoSalvar");
const botaoCancelar = document.getElementById("botaoCancelar");
const botaoLimpar = document.getElementById("botaoLimpar");

const mensagem = document.getElementById("mensagem");


//carrega os agendamentos
async function carregarAgendamentos() {

    try {

        const resposta = await fetch(api);
        const dados = await resposta.json();

        if (!dados.sucesso) {

            mostrarMensagem(
                dados.mensagem,
                "erro"
            );

            return;
        }


        tabela.innerHTML = "";


        idAnimal.innerHTML =
            '<option value="">Selecione o animal</option>';

        dados.animais.forEach(function (animal) {

            const opcao = document.createElement("option");

            opcao.value = animal.id_animal;
            opcao.textContent = animal.nome;

            idAnimal.appendChild(opcao);
        });


        idServico.innerHTML =
            '<option value="">Selecione o serviço</option>';

        dados.servicos.forEach(function (servico) {

            const opcao = document.createElement("option");

            opcao.value = servico.id_servico;
            opcao.textContent = servico.nome;

            idServico.appendChild(opcao);
        });


        dados.agendamentos.forEach(function (agendamento) {

            const linha = document.createElement("tr");

            const data = agendamento.data_agendamento
                .split("-")
                .reverse()
                .join("/");

            const hora = agendamento.horario.substring(0, 5);


            linha.innerHTML = `
                <td>${agendamento.id_agendamento}</td>
                <td>${data}</td>
                <td>${hora}</td>
                <td>${agendamento.nome_animal}</td>
                <td>${agendamento.nome_servico}</td>

                <td>
                    <button onclick="editarAgendamento(${agendamento.id_agendamento})">
                        Editar
                    </button>
                </td>

                <td>
                    <button onclick="excluirAgendamento(${agendamento.id_agendamento})">
                        Excluir
                    </button>
                </td>
            `;

            tabela.appendChild(linha);
        });

    } catch (erro) {

        console.log(erro);

        mostrarMensagem(
            "Não foi possível carregar os agendamentos.",
            "erro"
        );
    }
}


formulario.addEventListener("submit", async function (evento) {

    evento.preventDefault();


    const dados = {

        data: dataAgendamento.value,

        horario: horario.value,

        id_animal: idAnimal.value,

        id_servico: idServico.value
    };


    try {

        let resposta;


        if (idAgendamento.value) {

            dados.id_agendamento = idAgendamento.value;


            resposta = await fetch(api, {

                method: "PUT",

                headers: {
                    "Content-Type": "application/json"
                },

                body: JSON.stringify(dados)
            });

        } else {

            resposta = await fetch(api, {

                method: "POST",

                headers: {
                    "Content-Type": "application/json"
                },

                body: JSON.stringify(dados)
            });
        }


        const resultado = await resposta.json();


        if (!resultado.sucesso) {

            mostrarMensagem(
                resultado.mensagem,
                "erro"
            );

            return;
        }


        mostrarMensagem(
            resultado.mensagem,
            "sucesso"
        );

        //chama a função de limpar Formulario
        limparFormulario();
        //chama a função de carregar Agendamentos
        carregarAgendamentos();

    } catch (erro) {

        console.log(erro);

        mostrarMensagem(
            "Erro ao realizar a operação.",
            "erro"
        );
    }
});

// eu não lembrava oq era uma async function :(
async function editarAgendamento(id) {

    try {

        const resposta = await fetch(
            api + "?id=" + id
        );

        const dados = await resposta.json();


        if (!dados.sucesso) {

            mostrarMensagem(
                dados.mensagem,
                "erro"
            );

            return;
        }


        const agendamento = dados.agendamento;


        idAgendamento.value =
            agendamento.id_agendamento;

        dataAgendamento.value =
            agendamento.data_agendamento;

        horario.value =
            agendamento.horario.substring(0, 5);

        idAnimal.value =
            agendamento.id_animal;

        idServico.value =
            agendamento.id_servico;


        titulo.textContent =
            "Editar agendamento";

        botaoSalvar.textContent =
            "Atualizar";

        botaoCancelar.style.display =
            "inline-block";

        botaoLimpar.style.display =
            "none";


        window.scrollTo(0, 0);

        // ainda guardo raiva do carlos por ter me obrigado a fazer isso

    } catch (erro) {

        console.log(erro);

        mostrarMensagem(
            "Erro ao buscar agendamento.",
            "erro"
        );
    }
}

// exclui os agendamentos
async function excluirAgendamento(id) {

    if (!confirm("Deseja excluir este agendamento?")) {
        return;
    }


    try {

        const resposta = await fetch(api, {

            method: "DELETE",

            headers: {
                "Content-Type": "application/json"
            },

            body: JSON.stringify({
                id_agendamento: id
            })
        });


        const resultado = await resposta.json();


        if (!resultado.sucesso) {

            mostrarMensagem(
                resultado.mensagem,
                "erro"
            );

            return;
        }


        mostrarMensagem(
            resultado.mensagem,
            "sucesso"
        );


        carregarAgendamentos();

    } catch (erro) {

        console.log(erro);

        mostrarMensagem(
            "Erro ao excluir agendamento.",
            "erro"
        );
    }
}


botaoCancelar.addEventListener("click", function () {

    limparFormulario();

});


function limparFormulario() {

    formulario.reset();

    idAgendamento.value = "";

    titulo.textContent =
        "Novo agendamento";

    botaoSalvar.textContent =
        "Cadastrar";

    botaoCancelar.style.display =
        "none";

    botaoLimpar.style.display =
        "inline-block";
}

//mostra a menssagem
function mostrarMensagem(texto, tipo) {

    mensagem.textContent = texto;


    if (tipo == "sucesso") {

        mensagem.style.color =
            "green";

    } else {

        mensagem.style.color =
            "red";
    }


    setTimeout(function () {

        mensagem.textContent = "";

    }, 3000);
}


carregarAgendamentos();
