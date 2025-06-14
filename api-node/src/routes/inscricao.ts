import { Router } from 'express'
import db from '../database/knex'
import { z } from 'zod'

const inscricaoRouter = Router()

inscricaoRouter.post('/', async (req, res, next) => {
    try {
        const schema = z.object({
            aluno_id: z.number().int().positive(),
            evento_id: z.number().int().positive()
        })

        const dados = schema.parse(req.body)  // validando recebidos 

        const { aluno_id, evento_id } = dados

        const aluno = await db('alunos').where({ id: aluno_id }).first()
        if (!aluno) {             // verificando se tem o aluno no banco 
            return res.status(404).json({ message: "Aluno não encontrado" })
        }

        const evento = await db('eventos').where({ id: evento_id }).first()             // verificando se tem evento no banco 
        if (!evento) {
            return res.status(404).json({ message: "Evento não encontrado" })
        }

        const inscricao = await db('inscricoes').where({ aluno_id, evento_id }).first()
        if (inscricao) {                                                                     // verificando se o aluno esta no evento 
            return res.status(400).json({ message: "Aluno já está cadastrado no evento" })
        }

        await db.transaction(async trx => {
            const [id] = await trx('inscricoes').insert({ aluno_id, evento_id })

            await trx('eventos')
                .where({ id: evento_id })
                .increment('cont_participantes', 1)

            res.status(201).json({
                message: "inscriçao realizada ",
                inscricao: {
                    id,
                    aluno_id,
                    evento_id,
                    data_inscricao: new Date().toISOString()
                }
            })
        })

    } catch (error) {
        next(error)
    }

})

// obter inscrição por id do aluno
inscricaoRouter.get('/aluno/:id', async (req, res, next) => {
    try {
        const { id } = req.params;

        const inscricoes = await db('inscricoes')
            .where({ aluno_id: id });

        res.json(inscricoes);
    } catch (error) {
        next(error);
    }
});

inscricaoRouter.delete('/:id', async (req, res, next) => {
    try {
        const { id } = req.params;

        const inscricao = await db('inscricoes').where({ id }).first();

        if (!inscricao) {
            return res.status(404).json({ message: "Inscrição não encontrada" });
        }

        // Excluir a inscrição
        await db('inscricoes').where({ id }).delete();

        // Decrementar cont_participantes do evento
        await db('eventos')
            .where({ id: inscricao.evento_id })
            .decrement('cont_participantes', 1);

        res.json({ message: "Inscrição removida com sucesso" });
    } catch (error) {
        next(error);
    }
});


export default inscricaoRouter






