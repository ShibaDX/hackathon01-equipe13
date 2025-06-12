package equipe.hackathon.model;

import java.time.LocalDateTime;

public class Evento {
    private int id;
    private String titulo;
    private String descricao;
    private LocalDateTime dataHora;
    private int duracaoMinutos;
    private String curso;

    public Evento() {}

    public Evento(String titulo, String descricao, LocalDateTime dataHora, int duracaoMinutos, String curso) {
        this.titulo = titulo;
        this.descricao = descricao;
        this.dataHora = dataHora;
        this.duracaoMinutos = duracaoMinutos;
        this.curso = curso;
    }

    public int getId() { return id; }
    public void setId(int id) { this.id = id; }

    public String getTitulo() { return titulo; }
    public void setTitulo(String titulo) { this.titulo = titulo; }

    public String getDescricao() { return descricao; }
    public void setDescricao(String descricao) { this.descricao = descricao; }

    public LocalDateTime getDataHora() { return dataHora; }
    public void setDataHora(LocalDateTime dataHora) { this.dataHora = dataHora; }

    public int getDuracaoMinutos() { return duracaoMinutos; }
    public void setDuracaoMinutos(int duracaoMinutos) { this.duracaoMinutos = duracaoMinutos; }

    public String getCurso() { return curso; }
    public void setCurso(String curso) { this.curso = curso; }
}