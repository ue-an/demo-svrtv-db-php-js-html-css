</body>
<!-- added script related to admin ui -->
<!-- tables scripts -->
<script src="js/script.js"></script>
<script src="js/script_events_ticket.js"></script>


<script src="js/bootstrap.bundle.min.js"></script>
    <script>

        var el = document.getElementById("wrapper");
        var toggleButton = document.getElementById("menu-toggle");

        toggleButton.onclick = function() {
            el.classList.toggle("toggled");
        };

        var user_table = document.getElementById("row-userstable");
        var event_ticket_table = document.getElementById("row-eventstickettable");

        let tables = [
            user_table,
            event_ticket_table,
        ];

        $(document).ready(function() {
            user_table.style.display = "block";
            tables.forEach(table => {
                if (table.id !== "row-userstable") {
                    table.style.visibility = "hidden";
                    console.log(table);
                }
            })
        });

        function closeAll($selectedTable){
            tables.forEach(table => {
                if (table.id !== $selectedTable) {
                    table.style.display = "none";
                    table.style.visibility = "hidden";
                }
            });
        }

        //Users menu
        function openSideUsers() {
            user_table.style.visibility = "visible";
            user_table.style.display = "block";
            closeAll(user_table.id);
        }

        function openSideEventTickets() {
            event_ticket_table.style.visibility = "visible";
            event_ticket_table.style.display = "block";
            closeAll(event_ticket_table.id);
        }
        
    </script>
</html>