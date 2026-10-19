const api = "../api/animais.php";

const formulario = document.getElementById("formAnimal");
const idAnimal = document.getElementById("idAnimal");
const nomeAnimal = document.getElementById("nomeAnimal");
const idade = document.getElementById("idade");
const peso = document.getElementById("peso");
const especie = document.getElementById("especie");
const raca = document.getElementById("raca");
const idDono = document.getElementById("idDono");
const tabela = document.getElementById("tabelaAnimais");
const titulo = document.getElementById("tituloFormulario");
const botaoSalvar = document.getElementById("botaoSalvar");
const botaoCancelar = document.getElementById("botaoCancelar");
const botaoLimpar = document.getElementById("botaoLimpar");
const mensagem = document.getElementById("mensagem");

// cadu, pq vc fez TANTAAA const

//busca no banco os animais salvos e mostra
async function carregarAnimais() {

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

        dados.donos.forEach(function(dono) {

            const opcao = document.createElement("option");

            opcao.value = dono.id_dono;
            opcao.textContent = dono.nome;

            idDono.appendChild(opcao);
        });


        dados.animais.forEach(function(animal) {

            const linha = document.createElement("tr");

            const pesoAnimal = parseFloat(animal.peso)
                .toFixed(2)
                .replace(".", ",");

            linha.innerHTML = `
                <td>${animal.id_animal}</td>
                <td>${animal.nome}</td>
                <td>${animal.idade}</td>
                <td>${pesoAnimal} kg</td>
                <td>${animal.especie}</td>
                <td>${animal.raca}</td>
                <td>${animal.nome_dono}</td>

                <td>
                    <button onclick="editarAnimal(${animal.id_animal})">
                        Editar
                    </button>
                </td>

                <td>
                    <button onclick="excluirAnimal(${animal.id_animal})">
                        Excluir
                    </button>
                </td>
            `;

            tabela.appendChild(linha);
        });

    } catch (erro) {

        console.log(erro);

        mostrarMensagem(
            "Não foi possível carregar os animais.",
            "erro"
        );
    }
}

//  aqui temos o formulario para os animais 
formulario.addEventListener("submit", async function(evento) {

    evento.preventDefault();

    const dados = {
        nome: nomeAnimal.value,
        idade: idade.value,
        peso: peso.value,
        especie: especie.value,
        raca: raca.value,
        id_dono: idDono.value
    };


    try {

        let resposta;

        if (idAnimal.value) {

            dados.id_animal = idAnimal.value;

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

        carregarAnimais();

    } catch (erro) {

        console.log(erro);

        mostrarMensagem(
            "Erro ao realizar a operação.",
            "erro"
        );
    }
});

// essa parte edita os animais (sem comentarios sarcasticos aqui carlos, obrigado)

// "edita os animais" kkkkkk, bem explicativo
async function editarAnimal(id) {

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


        const animal = dados.animal;

        idAnimal.value = animal.id_animal;
        nomeAnimal.value = animal.nome;
        idade.value = animal.idade;
        peso.value = animal.peso;
        especie.value = animal.especie;
        raca.value = animal.raca;
        idDono.value = animal.id_dono;

        titulo.textContent = "Editar animal";

        botaoSalvar.textContent = "Atualizar";

        botaoCancelar.style.display = "inline-block";

        botaoLimpar.style.display = "none";

        window.scrollTo(0, 0);

    } catch (erro) {

        console.log(erro);

        mostrarMensagem(
            "Erro ao buscar animal.",
            "erro"
        );
    }
}

//exclui o animal
async function excluirAnimal(id) {

    if (!confirm("Deseja excluir este animal?")) {
        return;
    }


    try {

        const resposta = await fetch(api, {

            method: "DELETE",

            headers: {
                "Content-Type": "application/json"
            },

            body: JSON.stringify({
                id_animal: id
            })
        });


        const resultado = await resposta.json();


        if (!resultado.sucesso) {

            mostrarMensagem(
                resultado.mensagem,
                "erro"  //mostra mensagem de erro
            );

            return;
        }


        mostrarMensagem(
            resultado.mensagem,
            "sucesso"  //mostra mensagem de sucesso
        );

        carregarAnimais();

    } catch (erro) {

        console.log(erro);

        mostrarMensagem(
            "Erro ao excluir animal.",
            "erro"  //mostra mensagem de erro caso não de de excluir o animal
        );
    }
}

//limpa o formulario quando clicar no botão click
botaoCancelar.addEventListener("click", function() {

    limparFormulario();

});


function limparFormulario() {

    formulario.reset();

    idAnimal.value = "";

    titulo.textContent = "Novo animal";

    botaoSalvar.textContent = "Cadastrar";

    botaoCancelar.style.display = "none";

    botaoLimpar.style.display = "inline-block";
}

// mostra a menssagem
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


carregarAnimais();
