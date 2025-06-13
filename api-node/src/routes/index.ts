import { Router } from 'express'
import eventosRouter from './eventos'
import alunosRouter from './alunos'
import palestrantesRouter from './palestrantes'
import inscricaoRouter from './inscricao'
import session from './session'
import autenticacao from '../middlewares/autenticacao'

const routes = Router()

routes.use('/eventos', eventosRouter)
routes.use('/alunos', alunosRouter)
routes.use('/palestrantes', palestrantesRouter)
routes.use('/inscricoes', inscricaoRouter)
routes.use('/session', session)
routes.use(autenticacao)

export default routes