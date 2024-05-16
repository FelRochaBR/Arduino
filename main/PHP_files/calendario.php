<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendário Interativo</title>
    <style>
        /* Estilos para o calendário */
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }
        
        .calendar {
            width: 100%;
            max-width: 455px;
            margin: 20px auto;
            background-color:  #333;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            font-size: 30px;
            color:white;
            border: 1px solid #ccc; /* Adicionar uma borda */
            display: flex;
            flex-direction: column; /* Para centralizar verticalmente */
            align-items: center; /* Para centralizar horizontalmente */
        }
        
        .month {
            text-align: center;
            margin-bottom: 20px;
            padding: 20px 0;
            font-size: 30px;
            border-bottom: 1px solid #ccc;
        }
        
        #month {
            font-weight: bold;
            color: white;
        }
        
        #year {
            font-size: 18px;
            color: gray;
        }
        
        .days {
            display: grid;
            grid-template-columns: repeat(7, 50px); /* Definindo cada coluna com 50px de largura */
            grid-template-rows: repeat(5, 50px); /* Definindo 5 linhas com 50px de altura */
            gap: 10px; /* Espaço entre os quadrados */
        }
        
        .day {
            width: 50px; /* Largura fixa para os números dos dias */
            height: 50px; /* Altura fixa para os números dos dias */
            padding: 10px;
            text-align: center;
            cursor: pointer;
            transition: background-color 0.3s;
            font-size: 16px;
            font-weight: bold;
            color: #333;
            border: 1px solid #ccc; /* Adicionar uma borda */
        }
        
        .today {
            color: rgb(130, 130, 255);
        }
        
        .day:hover {
            background-color: #f2f2f2;
        }
        
        .add-note {
            cursor: pointer;
            color: blue;
            text-decoration: underline;
        }
        
        /* Estilos para o modal */
        #noteModal {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            z-index: 1000;
        }
        
        #noteModal h2 {
            margin-top: 0;
        }
        
        #noteModal input[type="date"],
        #noteModal textarea {
            display: block;
            width: 100%;
            margin-bottom: 10px;
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }
        
        #noteModal textarea {
            height: 100px;
        }
        
        #noteModal .saveButton {
            background-color: blue;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        
        #noteModal .saveButton:hover {
            background-color: #0066cc;
        }

        /* Cor vermelha para o botão de fechar */
        #noteModal .closeButton {
            background-color: red;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        
        #noteModal .closeButton:hover {
            background-color: #cc0000;
        }
    </style>
</head>
<body>
    <div class="calendar">
        <div class="month">
            <span id="month"></span>
            <span id="year"></span>
        </div>
        <div class="days" id="days"></div>
    </div>

    <!-- Modal para adicionar notas -->
    
    <div id="noteModal">
        <h2>Adicionar Nota</h2>
        <input type="date" id="noteDate" disabled>
        <textarea id="noteContent" placeholder="Digite sua nota aqui"></textarea>
        <button class="saveButton" onclick="saveNote()">Salvar</button>
        <button class="closeButton" onclick="closeModal()">Fechar</button>
    </div>

    <script>
        // Função para obter o nome do mês
        function getMonthName(month) {
            const monthNames = ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"];
            return monthNames[month];
        }

        // Função para preencher o calendário com os dias do mês atual
        function fillCalendar() {
            const now = new Date();
            const month = now.getMonth();
            const year = now.getFullYear();
            const daysContainer = document.getElementById('days');
            const daysInMonth = new Date(year, month + 1, 0).getDate();
            const firstDay = new Date(year, month, 1).getDay();
            const today = now.getDate();

            document.getElementById('month').innerText = getMonthName(month);
            document.getElementById('year').innerText = year;

            daysContainer.innerHTML = '';

            for (let i = 1; i <= daysInMonth + firstDay; i++) {
                const day = document.createElement('div');
                if (i > firstDay) {
                    day.innerText = i - firstDay;
                    if (i - firstDay === today) {
                        day.classList.add('today');
                    }
                    day.addEventListener('click', () => openNoteModal(new Date(year, month, i - firstDay)));
                }
                daysContainer.appendChild(day);
            }
        }

        // Função para abrir o modal de adicionar nota
        function openNoteModal(date) {
            document.getElementById('noteDate').value = date.toISOString().split('T')[0];
            document.getElementById('noteContent').value = ''; // Limpar o conteúdo anterior
            document.getElementById('noteModal').style.display = 'block';
        }

        // Função para fechar o modal
        function closeModal() {
            document.getElementById('noteModal').style.display = 'none';
        }

        // Função para salvar a nota
        function saveNote() {
            const date = document.getElementById('noteDate').value;
            const content = document.getElementById('noteContent').value;
            // Aqui você pode adicionar lógica para salvar a nota, como enviar para um servidor
            alert(`Nota salva para ${date} com o seguinte conteúdo:\n${content}`);
            // Fechar o modal após salvar a nota
            closeModal();
        }

        // Preencher o calendário quando a página carregar
        fillCalendar();
    </script>
</body>
</html>

