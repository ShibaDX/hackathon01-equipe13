import { Router } from 'express'
import eventosRouter from './eventos'

const routes = Router()

routes.use('/eventos', eventosRouter)

export default routes