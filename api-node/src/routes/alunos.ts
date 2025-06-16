import { Router } from 'express'
import db from '../database/knex'
import { z } from 'zod'
import { hash } from 'bcrypt'

const alunosRouter = Router()

alunosRouter.get('/', async (req, res, next) => {
    try {
        const alunos = await db('alunos').select('*')
        res.json(alunos)
    } catch (error) {
        next(error)
    }
})

alunosRouter.get('/:id', async (req, res, next) => {
    try {
        const { id } = req.params;
        const aluno = await db('alunos').where({ id }).first();

        if (!aluno) {
            return res.status(404).json({ message: 'Aluno não encontrado' });
        }

        res.json(aluno);
    } catch (error) {
        next(error);
    }
});

alunosRouter.post('/', async (req, res, next) => {
    try {
        const schema = z.object({
            nome: z.string().max(200),
            email: z.string().email().max(200),
            senha: z.string().min(8).max(250),
            telefone: z.string().max(15),
            cpf: z.string().length(11)
        })

        const dados = schema.parse(req.body)

        const cpfExistente = await db('alunos').where({ cpf: dados.cpf}).first()
        if (cpfExistente) {
            return res.status(400).json({message: 'CPF já existe'})
        }

        const emailExistente = await db('alunos').where({ email: dados.email}).first()
        if (emailExistente) {
            return res.status(400).json({ message: 'Email já cadastrado' })
        }

        const senhaHash = await hash(dados.senha, 8)

        const [id] = await db('alunos').insert({
            ...dados,
            senha: senhaHash
        })
        const aluno = await db('alunos')
            .where({ id })
            .first()

        res.status(201).json({
            message: 'Aluno cadastrado com sucesso!',
            aluno
        })
    } catch (error) {
        next(error)
    }
})

alunosRouter.put('/:id', async (req, res, next) => {
    try {
        const { id } = req.params

        const schema = z.object({
            nome: z.string().max(200),
            email: z.string().email().max(200),
            senha: z.string().min(8).max(250),
            telefone: z.string().max(15),
            cpf: z.string().length(11)
        })

        const dados = schema.parse(req.body)

        const senhaHash = await hash(dados.senha, 8)

        const atualizado = await db('alunos')
            .where({ id })
            .update({
                ...dados,
                senha: senhaHash
            })

        if (!atualizado) {
            return res.status(404).json({ message: 'Aluno não encontrado' })
        }

        const aluno = await db('alunos').where({ id }).first()
        res.json({
            message: 'Aluno atualizado com sucesso!',
            aluno
        })
    } catch (error) {
        next(error)
    }
})

alunosRouter.delete('/:id', async (req, res, next) => {
    try {
        const { id } = req.params

        const deletado = await db('alunos').where({ id }).del()

        if (!deletado) {
            return res.status(404).json({ message: 'Aluno não encontrado' })
        }

        res.json({ message: 'Aluno removido com sucesso' })
    } catch (error) {
        next(error)
    }
})

export default alunosRouter