import { Router } from 'express'
import eventosRouter from './eventos'
import alunosRouter from './alunos'
import palestrantesRouter from './palestrantes'

const routes = Router()

routes.use('/eventos', eventosRouter)
routes.use('/alunos', alunosRouter)
routes.use('/palestrantes', palestrantesRouter)

export default routes