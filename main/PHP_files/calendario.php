<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendário Interativo</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            overflow: hidden;
            background:#14354E;
        }

        .calendar {
            width: 100%;
            max-width: 455px;
            margin: 20px auto;
            background-color: rgba(0, 0, 0, 0.5);
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            font-size: 20px; /* Diminuído o tamanho da fonte */
            border: 1px solid #ccc;
            position: relative; /* Alterado para relativo */
        }

        .month {
            text-align: center;
            margin-bottom: 10px; /* Diminuído o margin-bottom */
            padding: 10px 0; /* Diminuído o padding */
            font-size: 24px; /* Diminuído o tamanho da fonte */
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
            grid-template-columns: repeat(7, 1fr);
            grid-gap: 5px;
        }

        .day {
            width: 100%;
            padding-top: 75%; /* Diminuído o padding-top para achatar */
            position: relative;
            text-align: center;
            cursor: pointer;
            transition: background-color 0.3s;
            font-size: 14px; /* Diminuído o tamanho da fonte */
            font-weight: bold;
            color: white;
            border: 1px solid #ccc;
        }

        .day span {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .today {
            color: rgb(130, 130, 255);
        }

        .day:hover {
            background-color: #666;
        }

        .add-note {
            cursor: pointer;
            color: blue;
            text-decoration: underline;
        }

        #noteModal {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #333;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            z-index: 1000;
            color: white;
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

        .empty {
            border: none;
            background-color: transparent;
            cursor: default;
        }

        /* Media query for fullscreen mode */
        @media screen and (min-width: 1024px) {
            .calendar {
                width: 70%;
                max-width: none; /* Remove the max-width constraint */
                height: auto;
            }
        }
    </style>
</head>
<body>
    <div class="calendar">
        <div class="month">
            <span id="month"></span> <span id="year"></span>
        </div>
        <div class="days" id="days"></div>
    </div>

    <div id="noteModal">
        <h2>Adicionar Nota</h2>
        <input type="date" id="noteDate" disabled>
        <textarea id="noteContent" placeholder="Digite sua nota aqui"></textarea>
        <button class="saveButton" onclick="saveNote()">Salvar</button>
        <button class="closeButton" onclick="closeModal()">Fechar</button>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            function getMonthName(month) {
                const monthNames = ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"];
                return monthNames[month];
            }

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

                for (let i = 0; i < firstDay; i++) {
                    const emptyDay = document.createElement('div');
                    emptyDay.classList.add('day', 'empty');
                    daysContainer.appendChild(emptyDay);
                }

                for (let i = 1; i <= daysInMonth; i++) {
                    const day = document.createElement('div');
                    day.classList.add('day');
                    day.innerHTML = `<span>${i}</span>`;
                    if (i === today) {
                        day.classList.add('today');
                    }
                    day.addEventListener('click', () => openNoteModal(new Date(year, month, i)));
                    daysContainer.appendChild(day);
                }
            }

            function openNoteModal(date) {
                document.getElementById('noteDate').value = date.toISOString().split('T')[0];
                document.getElementById('noteContent').value = '';
                document.getElementById('noteModal').style.display = 'block';
            }

            function closeModal() {
                document.getElementById('noteModal').style.display = 'none';
            }

            function saveNote() {
                const date = document.getElementById('noteDate').value;
                const content = document.getElementById('noteContent').value;
                alert(`Nota salva para ${date} com o seguinte conteúdo:\n${content}`);
                closeModal();
            }

            fillCalendar();
            window.openNoteModal = openNoteModal;
            window.closeModal = closeModal;
            window.saveNote = saveNote;
        });
    </script>
</body>
</html>
