import { Router } from 'express'
import db from '../../database/knex'
import { z } from 'zod'

const inscricaoRouter = Router()

inscricaoRouter.post('/', async (req, res , next ) => {
    try { 
        const schema = z.object({
            aluno_id: z.number().int().positive(),
            evento_id: z.number().int().positive() 
        })

        const dados = schema.parse(req.body)  // validando recebidos 

        const {aluno_id, evento_id} = dados

        const aluno = await db('alunos') . where({id: aluno_id}). first()
        if (!aluno) {             // verificando se tem o aluno no banco 
           return res.status(404).json({message: "aluno nao encontrado"})
        }

        const evento = await db('eventos') . where({id: evento_id}). first()             // verificando se tem evento no banco 
        if(!evento) {                                      
            return res.status(404).json({message: "evento nao encontrado"})
        }



         const inscricao = await db('incricoes') . where({aluno_id,evento_id }).first()
         if(!inscricao) {                                                                     // verificando se o aluno esta no evento 
            return res.status(400).json({message: "aluno ja esta cadastrado no evento"})
         }   

         const [id] = await db('inscricoes').insert({aluno_id,evento_id})    // Criando a inscrição do aluno no evento

         res.status(201).json({message: "inscriçao realizada ",
            inscricao: {
                id,
                aluno_id,
                evento_id,
                data_inscricao: new Date().toISOString()
            }
         })


      } catch (error) {
        next (error)
    }

})
  export  default inscricaoRouter


 



