# Explicações de Desenvolvimento
1. Decisão da arquitetura utilizada
    - Apesar de ser uma aplicação bastante simples, tentei arquiteturar ela de um modo que ela pudesse crescer de forma organizada.
    - Trabalhei com o MVC que é o padrão do Laravel, onde deixei tudo bem separado, de modo que o controler exerça somente sua função de controlar quem deve fazer o que.
    - Utilizei Requests para fazer as validações
    - Resources para definir o que deve ser retornado e seu formato
    - Services onde vai ficar toda a regra de negócio
    - E Repositories, onde vai ficar toda a regra referente a dados, bem como a forma de consultar esses dados.
    - Também utilizei Contracts (interface) para esse repository tenha seu padrão já definido.
2. Lista de bibliotecas de terceiros utilizadas
    Foi utilizado Axios e Router no front.
    Backend apenas os recursos fornecido pelo Laravel
3. O que você melhoraria se tivesse mais tempo
    Frontend:
        - Gostaria de arquitetar melhor a aplicação.
        - Melhorar as validações.
        -Incluir Máscaras.
        -Incluir Testes
        -Utilizar JWT
    Backend:
        -Implementar autenticação
        -Aumentar a cobertura de testes
        -Implementar integração continua
        -adicionar informações complementares para os estudantes
4. Quais requisitos obrigatórios que não foram entregues
    Todos foram entregues, inclusive os desejaveis, porém foram criados apenas 2 testes


### Links para testes:

Teste Aplicação
https://grupoa-vissini.netlify.app/

Teste API
https://vissini-grupo-a.herokuapp.com/




