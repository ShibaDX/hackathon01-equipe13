package equipe.hackathon.service;

import equipe.hackathon.dao.EventoDao;
import equipe.hackathon.model.Evento;

import java.time.LocalDate;
import java.time.LocalTime;
import java.util.ArrayList;
import java.util.List;

public class EventoService {

    public boolean cadastrarEvento(Evento evento) {
        EventoDao dao = new EventoDao();
        return dao.insert(evento);
    }

    public boolean atualizarEvento(Evento evento) {
        EventoDao dao = new EventoDao();
        return dao.update(evento);
    }

    public boolean removerEvento(Long id) {
        EventoDao dao = new EventoDao();
        return dao.delete(id);
    }

    public Evento buscarEventoPorId(Long id) {
        EventoDao dao = new EventoDao();
        List<Object> eventos = dao.select(id);
        return eventos.isEmpty() ? null : (Evento) eventos.get(0);
    }

    public List<Evento> listarEventos() {
        EventoDao dao = new EventoDao();
        List<Object> objetos = dao.selectALL();
        List<Evento> eventos = new ArrayList<>();

        for (Object obj : objetos) {
            eventos.add((Evento) obj);
        }
        return eventos;
    }

    public Evento buscarEventoPorId(long id) {
        EventoDao dao = new EventoDao();
        List<Object> resultados = dao.select(id);
        return resultados.isEmpty() ? null : (Evento) resultados.get(0);
    }

    public boolean existeEventoNaMesmaDataHora(LocalDate data, LocalTime hora, Long idAtual) {
        return listarEventos().stream()
                .anyMatch(e ->
                        e.getData().equals(data) &&
                                e.getHora().equals(hora) &&
                                (idAtual == null || e.getId() != idAtual)
                );
    }
}