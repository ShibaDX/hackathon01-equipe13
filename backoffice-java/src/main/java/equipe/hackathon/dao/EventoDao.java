package equipe.hackathon.dao;

import equipe.hackathon.model.Evento;

import java.sql.*;
import java.util.ArrayList;
import java.util.List;

public class EventoDao {

    @SuppressWarnings("CallToPrintStackTrace")
    public List<Evento> listarTodos() {
        List<Evento> lista = new ArrayList<>();
        String sql = "SELECT * FROM evento";
        try (Connection conn = Dao.getConnection();
             Statement stmt = conn.createStatement();
             ResultSet rs = stmt.executeQuery(sql)) {

            while (rs.next()) {
                Evento e = new Evento();
                e.setId(rs.getInt("id"));
                e.setTitulo(rs.getString("titulo"));
                e.setDescricao(rs.getString("descricao"));
                e.setDataHora(rs.getTimestamp("data_hora").toLocalDateTime());
                e.setDuracaoMinutos(rs.getInt("duracao_minutos"));
                e.setCurso(rs.getString("curso"));
                lista.add(e);
            }

        } catch (SQLException e) {
            e.printStackTrace();
        }
        return lista;
    }

    public void salvar(Evento evento) {
    }

    public boolean insert(Evento evento) {
        return false;
    }

    public Iterable<Object> selectALL() {
        return null;
    }
}