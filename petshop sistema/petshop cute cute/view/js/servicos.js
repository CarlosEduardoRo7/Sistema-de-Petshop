const api = "../api/servicos.php";

const formulario = document.getElementById("formServico");

const idServico = document.getElementById("idServico");
const nomeServico = document.getElementById("nomeServico");
const preco = document.getElementById("preco");

const tabela = document.getElementById("tabelaServicos");

const titulo = document.getElementById("tituloFormulario");
const botaoSalvar = document.getElementById("botaoSalvar");
const botaoCancelar = document.getElementById("botaoCancelar");
const botaoLimpar = document.getElementById("botaoLimpar");

const mensagem = document.getElementById("mensagem");


async function carregarServicos() {

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

        dados.servicos.forEach(function(servico) {

            const linha = document.createElement("tr");

            const precoServico = parseFloat(servico.preco)
                .toFixed(2)
                .replace(".", ",");

            linha.innerHTML = `
                <td>${servico.id_servico}</td>
                <td>${servico.nome}</td>
                <td>R$ ${precoServico}</td>

                <td>
                    <button onclick="editarServico(${servico.id_servico})">
                        Editar
                    </button>
                </td>

                <td>
                    <button onclick="excluirServico(${servico.id_servico})">
                        Excluir
                    </button>
                </td>
            `;

            tabela.appendChild(linha);
        });

    } catch (erro) {

        console.log(erro);

        mostrarMensagem(
            "Não foi possível carregar os serviços.",
            "erro"
        );
    }
}


formulario.addEventListener("submit", async function(evento) {

    evento.preventDefault();

    const dados = {
        nome: nomeServico.value,
        preco: preco.value
    };


    try {

        let resposta;

        if (idServico.value) {

            dados.id_servico = idServico.value;

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

        limparFormulario();

        carregarServicos();

    } catch (erro) {

        console.log(erro);

        mostrarMensagem(
            "Erro ao realizar a operação.",
            "erro"
        );
    }
});

// edita  o serviço
async function editarServico(id) {

    try {

        const resposta = await fetch(api + "?id=" + id);
        const dados = await resposta.json();

        if (!dados.sucesso) {

            mostrarMensagem(
                dados.mensagem,
                "erro"
            );

            return;
        }


        const servico = dados.servico;

        idServico.value = servico.id_servico;
        nomeServico.value = servico.nome;
        preco.value = servico.preco;

        titulo.textContent = "Editar serviço";

        botaoSalvar.textContent = "Atualizar";

        botaoCancelar.style.display = "inline-block";

        botaoLimpar.style.display = "none";

        window.scrollTo(0, 0);

    } catch (erro) {

        console.log(erro);

        mostrarMensagem(
            "Erro ao buscar serviço.",
            "erro"
        );
    }
}

// exclui o  serviço
async function excluirServico(id) {

    if (!confirm("Deseja excluir este serviço?")) {
        return;
    }


    try {

        const resposta = await fetch(api, {

            method: "DELETE",

            headers: {
                "Content-Type": "application/json"
            },

            body: JSON.stringify({
                id_servico: id
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

        carregarServicos();

    } catch (erro) {

        console.log(erro);

        mostrarMensagem(
            "Erro ao excluir serviço.",
            "erro"
        );
    }
}


botaoCancelar.addEventListener("click", function() {

    limparFormulario();

});

//limpa o formulario
function limparFormulario() {

    formulario.reset();

    idServico.value = "";

    titulo.textContent = "Novo serviço";

    botaoSalvar.textContent = "Cadastrar";

    botaoCancelar.style.display = "none";

    botaoLimpar.style.display = "inline-block";
}


function mostrarMensagem(texto, tipo) {

    mensagem.textContent = texto;

    if (tipo == "sucesso") {

        mensagem.style.color = "green";

    } else {

        mensagem.style.color = "red";
    }


    setTimeout(function() {

        mensagem.textContent = "";

    }, 3000);
}


carregarServicos();
