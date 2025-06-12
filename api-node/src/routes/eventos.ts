import { Router } from 'express'
import db from '../../database/knex'

const eventosRouter = Router()

eventosRouter.get('/', async (req, res, next) => {
    try {
        const eventos = await db('eventos').select('*')
        res.json(eventos)
    } catch (error) {
        next(error)
    }
})

export default eventosRouter