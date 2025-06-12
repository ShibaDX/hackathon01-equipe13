package equipe.hackathon.gui;

import equipe.hackathon.model.Evento;
import equipe.hackathon.service.EventoService;

import javax.swing.*;
import javax.swing.event.ListSelectionEvent;
import javax.swing.table.DefaultTableModel;
import java.awt.*;
import java.awt.event.ActionEvent;
import java.time.LocalDateTime;
import java.time.format.DateTimeFormatter;

public class EventoGui extends JFrame {

    private JTextField tfID;
    private JTextField tfTitulo;
    private JTextField tfDescricao;
    private JTextField tfLugar;
    private JTextField tfData;
    private JTextField tfHora;
    private JTextField tfCurso;

    private JTable tbEventos;

    private final EventoService service = new EventoService();

    public EventoGui() {
        setTitle("Cadastro de Evento");
        setSize(600, 500);
        setLocationRelativeTo(null);
        setDefaultCloseOperation(EXIT_ON_CLOSE);

        getContentPane().add(montarPainelEntrada(), BorderLayout.NORTH);
        getContentPane().add(montarPainelSaida(), BorderLayout.CENTER);
    }

    private JPanel montarPainelEntrada() {
        JPanel painel = new JPanel(new GridBagLayout());
        GuiUtils guiUtils = new GuiUtils();

        tfID = new JTextField(20);
        tfID.setEditable(false);
        tfTitulo = new JTextField(20);
        tfDescricao = new JTextField(20);
        tfLugar = new JTextField(20);
        tfData = new JTextField(20);
        tfHora = new JTextField(20);
        tfCurso = new JTextField(20);
        JButton btConfirmar = new JButton("Confirmar");

        btConfirmar.addActionListener(this::confirmar);

        painel.add(new JLabel("ID:"), guiUtils.montarConstraints(0, 7, 0, 0));
        painel.add(tfID, guiUtils.montarConstraints(0, 7, 1, 0));
        painel.add(new JLabel("Título:"), guiUtils.montarConstraints(0, 7, 0, 1));
        painel.add(tfTitulo, guiUtils.montarConstraints(0, 7, 1, 1));
        painel.add(new JLabel("Descrição:"), guiUtils.montarConstraints(0, 7, 0, 2));
        painel.add(tfDescricao, guiUtils.montarConstraints(0, 7, 1, 2));
        painel.add(new JLabel("Lugar:"), guiUtils.montarConstraints(0, 7, 0, 3));
        painel.add(tfLugar, guiUtils.montarConstraints(0, 7, 1, 3));
        painel.add(new JLabel("Data (dd/MM/yyyy):"), guiUtils.montarConstraints(0, 7, 0, 4));
        painel.add(tfData, guiUtils.montarConstraints(0, 7, 1, 4));
        painel.add(new JLabel("Hora (HH:mm):"), guiUtils.montarConstraints(0, 7, 0, 5));
        painel.add(tfHora, guiUtils.montarConstraints(0, 7, 1, 5));
        painel.add(new JLabel("Curso:"), guiUtils.montarConstraints(0, 7, 0, 6));
        painel.add(tfCurso, guiUtils.montarConstraints(0, 7, 1, 6));
        painel.add(btConfirmar, guiUtils.montarConstraints(0, 7, 2, 1)); // spanning 2 columns

        return painel;
    }

    private JScrollPane montarPainelSaida() {
        var tableModel = new DefaultTableModel();
        tableModel.addColumn("ID");
        tableModel.addColumn("Título");
        tableModel.addColumn("Curso");
        tableModel.addColumn("Data/Hora");

        service.listarEventos().forEach(e ->
                tableModel.addRow(new Object[]{
                        e.getId(),
                        e.getTitulo(),
                        e.getCurso(),
                        e.getDataHora().format(DateTimeFormatter.ofPattern("dd/MM/yyyy HH:mm"))
                })
        );

        tbEventos = new JTable(tableModel);
        tbEventos.setDefaultEditor(Object.class, null);
        tbEventos.getSelectionModel().addListSelectionListener(this::selecionar);

        return new JScrollPane(tbEventos);
    }

    private void confirmar(ActionEvent event) {
        try {
            Evento evento = new Evento();
            evento.setId(tfID.getText().isEmpty() ? 0 : Integer.parseInt(tfID.getText()));
            evento.setTitulo(tfTitulo.getText());
            evento.setDescricao(tfDescricao.getText());
            evento.setLugar(tfLugar.getText());
            evento.setCurso(tfCurso.getText());
            evento.setDuracaoMinutos(60);

            String data = tfData.getText();
            String hora = tfHora.getText();
            DateTimeFormatter formatter = DateTimeFormatter.ofPattern("dd/MM/yyyy HH:mm");
            evento.setDataHora(LocalDateTime.parse(data + " " + hora, formatter));

            service.cadastrarEvento(evento);
            JOptionPane.showMessageDialog(this, "Evento salvo com sucesso!");
        } catch (Exception ex) {
            JOptionPane.showMessageDialog(this, "Erro: " + ex.getMessage());
        }
    }

    private void selecionar(ListSelectionEvent event) {
        if (!event.getValueIsAdjusting()) {
            int linha = tbEventos.getSelectedRow();
            if (linha >= 0) {
                int id = Integer.parseInt(tbEventos.getValueAt(linha, 0).toString());
                Evento e = service.buscarPorId(id);
                if (e != null) {
                    tfID.setText(String.valueOf(e.getId()));
                    tfTitulo.setText(e.getTitulo());
                    tfDescricao.setText(e.getDescricao());
                    tfLugar.setText(e.getLugar());
                    tfCurso.setText(e.getCurso());
                    tfData.setText(e.getDataHora().format(DateTimeFormatter.ofPattern("dd/MM/yyyy")));
                    tfHora.setText(e.getDataHora().format(DateTimeFormatter.ofPattern("HH:mm")));
                }
            }
        }
    }
}

