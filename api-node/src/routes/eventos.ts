import { Router } from 'express'
import { z } from 'zod'
import db from '../../database/knex'

const eventosRouter = Router()

// Listar todos os eventos
eventosRouter.get('/', async (req, res, next) => {
    try {
        const eventos = await db('eventos').select('*')
        res.json(eventos)
    } catch (error) {
        next(error)
    }
})

// Buscar 1 evento
eventosRouter.get('/:id', async (req, res, next) => {

    const registerParamsSchema = z.object({
        id: z.string().min(1)
    })
    // + transforma o string em num
    const id = +registerParamsSchema.parse(req.params).id


    try {
        const eventos = await db('eventos').select('*').where({ id })
        res.json(eventos)
    } catch (error) {
        next(error)
    }
})

export default eventosRouter