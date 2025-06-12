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

eventosRouter.post('/', async (req, res) => {

    const criarEventoSchema = z.object({
        titulo: z.string(),
        descricao: z.string(),
        lugar: z.string(),
        data: z.string(),
        hora: z.string(),
        curso: z.string(),
        cont_participantes: z.number(),
        palestrante_id: z.number()
    })

    const objSalvar = criarEventoSchema.parse(req.body)

    const id_evento = await db('eventos').insert(objSalvar)

    const eventos = await db('eventos').where({
        id: id_evento[0]
    })

    res.json({
        message: 'Evento cadastrado com sucesso!',
        evento: eventos
    })
    return
})

export default eventosRouter