const api = "../api/donos.php";

const formulario = document.getElementById("formDono");

const idDono = document.getElementById("idDono");
const nome = document.getElementById("nomeDono");
const cpf = document.getElementById("cpf");
const telefone = document.getElementById("fone");

const tabela = document.getElementById("tabelaDonos");

const titulo = document.getElementById("tituloFormulario");
const botaoSalvar = document.getElementById("btnSalvar");
const botaoCancelar = document.getElementById("btnCancelar");
const botaoLimpar = document.getElementById("btnLimpar");

const mensagem = document.getElementById("mensagem");


async function carregarDonos() {

    try {

        const resposta = await fetch(api);
        const dados = await resposta.json();

        if (!dados.sucesso) {

            mostrarMensagem(dados.mensagem, "erro");
            return;
        }

        tabela.innerHTML = "";

        dados.donos.forEach(function(dono) {

            const linha = document.createElement("tr");

            linha.innerHTML = `
                <td>${dono.id_dono}</td>
                <td>${dono.nome}</td>
                <td>${dono.cpf}</td>
                <td>${dono.telefone}</td>

                <td>
                    <button onclick="editarDono(${dono.id_dono})">
                        Editar
                    </button>
                </td>

                <td>
                    <button onclick="excluirDono(${dono.id_dono})">
                        Excluir
                    </button>
                </td>
            `;

            tabela.appendChild(linha);
        });

    } catch (erro) {

        console.log(erro);

        mostrarMensagem(
            "Não foi possível carregar os donos.",
            "erro"
        );
    }
}


formulario.addEventListener("submit", async function(evento) {

    evento.preventDefault();

    const dados = {
        nome: nome.value,
        cpf: cpf.value,
        telefone: telefone.value
    };


    try {

        let resposta;

        if (idDono.value) {

            dados.id = idDono.value;

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

        carregarDonos();

    } catch (erro) {

        console.log(erro);

        mostrarMensagem(
            "Erro ao realizar a operação.",
            "erro"
        );
    }
});

//finalmente foi a edição do dono -iza 

//edit: vc reclamou tanto no grupo pra isso iza ?
async function editarDono(id) {

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


        const dono = dados.dono;

        idDono.value = dono.id_dono;
        nome.value = dono.nome;
        cpf.value = dono.cpf;
        telefone.value = dono.telefone;

        titulo.textContent = "Editar dono";

        botaoSalvar.textContent = "Atualizar";

        botaoCancelar.style.display = "inline-block";

        botaoLimpar.style.display = "none";

        window.scrollTo(0, 0);

    } catch (erro) {

        console.log(erro);

        mostrarMensagem(
            "Erro ao buscar dono.",
            "erro"
        );
    }
}

//funfou a função para excluir
async function excluirDono(id) {

    if (!confirm("Deseja excluir este dono?")) {
        return;
    }


    try {

        const resposta = await fetch(api, {

            method: "DELETE",

            headers: {
                "Content-Type": "application/json"
            },

            body: JSON.stringify({
                id: id
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

        carregarDonos();

    } catch (erro) {

        console.log(erro);

        mostrarMensagem(
            "Erro ao excluir dono.",
            "erro"
        );
    }
}


botaoCancelar.addEventListener("click", function() {

    limparFormulario();

});

// para limpar o formulario
function limparFormulario() {

    formulario.reset();

    idDono.value = "";

    titulo.textContent = "Novo dono";

    botaoSalvar.textContent = "Cadastrar";

    botaoCancelar.style.display = "none";

    botaoLimpar.style.display = "inline-block";
}

// mostra a mensagem 
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


carregarDonos();
