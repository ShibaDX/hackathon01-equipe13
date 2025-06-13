import { Router } from 'express'
import { z } from 'zod'
import db from '../../database/knex'

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
    
    const registerParamsSchema = z.object({
        id: z.string().min(1)
    })
    // + transforma um string em num
    const id = +registerParamsSchema.parse(req.params).id

    try {
        const palestrantes = await db('palestrantes').select('*').where({ id })
        res.json(palestrantes)
    } catch (error) {
        next(error)
    }

})

export default palestrantesRouter