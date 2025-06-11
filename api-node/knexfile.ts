import type { Knex } from "knex";

const config: { [key: string]: Knex.Config } = {
  development: {
    client: "mysql2",
    connection: {
      host: 'localhost',
      user: 'root',
      password: '',
      database: 'db_eventos'
    },
    migrations: {
      extension: 'ts',
      directory: './database/migrations'
    }
  }
};

module.exports = config;
