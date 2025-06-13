import { Router } from 'express'
import { z } from 'zod'
import db from '../database/knex'

const palestrantesRouter = Router()

// Listar todos os palestrantes
palestrantesRouter.get('/', async (req, res, next) => {
    try {
        const palestrantes = await db('palestrantes').select('*')
        res.json(palestrantes)
    } catch (error) {
        next(error)
    }
})

// Buscar 1 palestrante
palestrantesRouter.get('/:id', async (req, res, next) => {

    const { id } = z.object({ id: z.string().min(1) }).parse(req.params);

    try {
        const palestrante = await db('palestrantes')
            .where({ id: +id })
            .first();

        if (!palestrante) {
            return res.status(404).json({ error: 'Palestrante não encontrado' })
        }

        return res.json(palestrante)
    } catch (error) {
        next(error)
    }


})

export default palestrantesRouter