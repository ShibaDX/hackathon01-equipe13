import { Request, Response, NextFunction } from 'express'
import { verify } from 'jsonwebtoken'

function autenticacao(
    req: Request,
    res: Response,
    next: NextFunction
) {
    const authHeader = req.headers.authorization

    if (!authHeader) {
        res.status(401).json({ message: 'Token invalido!' })
        return;
    }

    const [, token] = authHeader.split(" ");

    try {
        const dadosToken = verify(token, 'aslkdja98yhoihafpihf11asf124')

        console.log('dadosToken', dadosToken)

        next()
        return
    } catch (error) {
        res.status(401).json({message: "Token invalido"})
        return;
    }
}
export default autenticacao;