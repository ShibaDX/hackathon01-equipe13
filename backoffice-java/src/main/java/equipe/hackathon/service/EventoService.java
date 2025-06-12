package equipe.hackathon.service;

import equipe.hackathon.dao.EventoDao;
import equipe.hackathon.model.Evento;

import java.util.ArrayList;
import java.util.List;

public class EventoService {
    public boolean cadastrarEvento(Evento evento) {
        var dao = new EventoDao();
        return dao.insert(evento);
    }

    public List<Evento> listarTodos() {
        var dao = new EventoDao();
        List<Evento> alunos = new ArrayList<>();
        dao.selectALL().forEach(object -> alunos.add((Evento) object));

        return alunos;
    }

    public Iterable<Object> listarEventos() {
        return null;
    }

    public Evento buscarPorId(int id) {
        return null;
    }
}