import type { Knex } from "knex";

// Função para aplicar a migration
export async function up(knex: Knex): Promise<void> {
    // Tabela Alunos
    await knex.schema.createTable('alunos', (table) => {
        table.increments('id').primary();
        table.string('nome', 200).notNullable();
        table.string('email', 200).notNullable();
        table.string('senha', 250).notNullable();
        table.string('telefone', 15).notNullable();
        table.string('cpf', 11).notNullable();
    });

    // Tabela Palestrantes
    await knex.schema.createTable('palestrantes', (table) => {
        table.increments('id').primary();
        table.string('nome', 100).notNullable();
        table.text('descricao');
        table.string('foto', 250);
        table.string('tema', 100).notNullable();
    });

    // Tabela Eventos
    await knex.schema.createTable('eventos', (table) => {
        table.increments('id').primary();
        table.string('titulo', 100).notNullable();
        table.text('descricao');
        table.string('lugar', 100).notNullable();
        table.date('data').notNullable();
        table.time('hora').notNullable();
        table.string('curso', 100).notNullable();
        table.integer('cont_participantes').notNullable().defaultTo(0);
        
        // Chave estrangeira
        table.integer('palestrante_id').unsigned().notNullable();
        table.foreign('palestrante_id').references('id').inTable('palestrantes');
    });

    // Tabela Inscrições
    await knex.schema.createTable('inscricoes', (table) => {
        table.increments('id').primary();
        table.timestamp('data_inscricao').defaultTo(knex.fn.now());

        // Chaves estrangeiras
        table.integer('aluno_id').unsigned().notNullable();
        table.foreign('aluno_id').references('id').inTable('alunos');

        table.integer('evento_id').unsigned().notNullable();
        table.foreign('evento_id').references('id').inTable('eventos');

        // Impede que um aluno se inscreva duas vezes no mesmo evento
        table.unique(['aluno_id', 'evento_id']);
    });
}


// Função para reverter a migration
export async function down(knex: Knex): Promise<void> {
    // A ordem de exclusão é a inversa da criação para evitar erros de chave estrangeira
    await knex.schema.dropTable('inscricoes');
    await knex.schema.dropTable('eventos');
    await knex.schema.dropTable('palestrantes');
    await knex.schema.dropTable('alunos');
}