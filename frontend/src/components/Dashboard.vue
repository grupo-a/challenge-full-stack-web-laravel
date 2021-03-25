<template>
    <div>
        <h1>Aplicação para Vaga Desenvolvedor FullStack com Laravel</h1>
        <ul>
            <li>Decisão da arquitetura utilizada</li>
            <li style="color:#a2a2a2; list-style-type: none;">
                Apesar de ser uma aplicação bastante simples, tentei arquiteturar ela de um modo que ela pudesse crescer de forma organizada.<br>
                Trabalhei com o MVC que é o padrão do Laravel, onde deixei tudo bem separado, de modo que o controler exerça somente sua função de controlar quem deve fazer o que.<br>
                Utilizei Requests para fazer as validações<br>
                Resources para definir o que deve ser retornado e seu formato<br>
                Services onde vai ficar toda a regra de negócio<br>
                E Repositories, onde vai ficar toda a regra referente a dados, bem como a forma de consultar esses dados.
                Também utilizei Contracts (interface) para esse repository tenha seu padrão já definido.

            </li>
            <li>Lista de bibliotecas de terceiros utilizadas</li>
            <li style="color:#a2a2a2; list-style-type: none;">
                Foi utilizado Axios e Router no front.<br>
                Backend apenas os recursos fornecido pelo Laravel
            </li>
            <li>O que você melhoraria se tivesse mais tempo</li>
            <li style="color:#a2a2a2; list-style-type: none;">
                Frontend: <br>
                <p>Gostaria de arquitetar melhor a aplicação.</p>
                <p>Melhorar as validações.</p>
                <p>Incluir Máscaras.</p>
                <p>Incluir Testes</p>
                <p>Utilizar JWT</p><br><br>
                Backend:<br>
                <p>Implementar autenticação</p>
                <p>Aumentar a cobertura de testes</p>
                <p>Implementar integração continua</p>
                <p>adicionar informações complementares para os estudantes</p>
            </li>
            <li>Quais requisitos obrigatórios que não foram entregues</li>
            <li style="color:#a2a2a2; list-style-type: none;">
                Todos foram entregues, inclusive os desejaveis, porém foram criados apenas 2 testes
            </li>
        </ul>
    </div>
</template>

<script>
export default {
  name: "Dashboard",
  data() {}
}
</script>