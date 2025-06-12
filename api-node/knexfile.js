const config = {
    development: {
        client: 'mysql2',
        connection: {
            host: 'localhost',
            user: 'root',
            password: '',
            database: 'db_eventos'
        },
        migrations: {
            extension: 'ts',
            directory: './database/knex/migrations'
        
        }
    }
};

module.exports = config;