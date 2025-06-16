# Hotsite de Eventos
<p>Este sistema é uma plataforma interativa voltada para a organização e divulgação de eventos acadêmicos de uma faculdade, como jornadas acadêmicas, seminários, palestras e cursos.

O objetivo principal é oferecer uma solução simples e centralizada, onde os eventos sejam o destaque. A navegação deve ser intuitiva, sem complicações ou informações espalhadas, permitindo que os usuários encontrem e acompanhem os eventos com facilidade.</p>

## Colaboradores do Projeto

* Arthur S. Gardim - https://github.com/ArthurSGO
* João Victor C. Cruz - https://github.com/JoaoCintra03
* Kaiky M. Ishibashi - https://github.com/ShibaDX
* Romario R. Rocha - https://github.com/Romarioalfa
* Wallace G. Da Silva Bogniotti - https://github.com/CriminalBR

---

# Resumo do Funcionamento do Sistema

O sistema é dividido em três camadas principais, cada uma com uma tecnologia específica e função bem definida:

## Java (Back Office – Camada Administrativa)

* Aplicação Java orientada a objetos.
* Voltada para o uso da equipe institucional da IES (Instituição de Ensino Superior).
* Permite **cadastrar, editar, excluir e gerenciar** eventos e palestrantes.
* Atua como uma **interface administrativa** para manipulação dos dados.

##  Node.js (API RESTful – Camada Intermediária)

* Serve como ponte entre o banco de dados e o front-end do PHP.
* Implementa uma **API RESTful** com rotas para as operações CRUD.
* Responsável por receber dados do Java (Back Office) e fornecer dados para o PHP (Front-end).
* Toda a **lógica de comunicação com o banco de dados** está concentrada aqui.

## PHP (Front-end Público – Camada de Visualização)

* Site acessado pelos alunos da instituição.
* Desenvolvido em PHP com orientação a objetos.
* Consome os dados da API Node.js para **listar eventos dinamicamente e realizar inscrições**.
* Responsável por **renderizar as páginas HTML**, exibindo os eventos de forma amigável ao usuário.

# Fluxo Geral:

1. A equipe da IES utiliza o sistema em Java para cadastrar ou atualizar os eventos e palestrantes.
2. O Java envia os dados para a API Node.js, que salva no banco.
3. O site em PHP consulta a API Node.js para exibir os eventos ao público.

