import { Router } from 'express'
import eventosRouter from './eventos'
import alunosRouter from './alunos'

const routes = Router()

routes.use('/eventos', eventosRouter)
routes.use('/alunos', alunosRouter)

export default routes