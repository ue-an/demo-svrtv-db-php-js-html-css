</body>
<!-- added script related to admin ui -->
<!-- tables scripts -->
<script src="js/script.js"></script>
<script src="js/script_event.js"></script>
<script src="js/script_anawim.js"></script>
<script src="js/script_feastph.js"></script>
<script src="js/script_holyweek.js"></script>
<script src="js/script_feastmedia.js"></script>
<script src="js/script_feastapp.js"></script>

<script src="js/bootstrap.bundle.min.js"></script>
    <script>

        //dropdowns
        // var deliverable = document.getElementById("isBonafied");
        // var deliverableVal = deliverable.style.getPropertyValue;
        // var deliver_option1 = document.getElementById("deliverable-dd1");
        // var deliver_option2 = document.getElementById("deliverable-dd2");

        // function changeDeliverOptionValue() {
        //     deliver_option1.nodeValue = deliverableVal == "0" ? "true" : "false";
        //     deliver_option2.nodeValue = deliver_option1.style.getPropertyValue == "true" ? "false" : "true";
        // }
        //end-dropdowns

        var el = document.getElementById("wrapper");
        var toggleButton = document.getElementById("menu-toggle");

        toggleButton.onclick = function() {
            el.classList.toggle("toggled");
        };

        var user_table = document.getElementById("row-userstable");
        var event_table = document.getElementById("row-eventtable");
        var anawim_table = document.getElementById("row-anawimtable");
        var feastph_table = document.getElementById("row-feastphtable");
        var holyweek_table = document.getElementById("row-holyweektable");
        var feastmedia_table = document.getElementById("row-feastmediatable");
        var feastapp_table = document.getElementById("row-feastapptable");

        let tables = [
            user_table,
            event_table,
            anawim_table,
            holyweek_table,
            feastph_table,
            feastmedia_table,
            feastapp_table,
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

        //Event side menu
        function openSideEvent() {
            event_table.style.visibility = "visible";
            event_table.style.display = "block";
            closeAll(event_table.id);
        }

        function openSideAnawim() {
            anawim_table.style.visibility = "visible";
            anawim_table.style.display = "block";
            closeAll(anawim_table.id);
        }

        function openSideFeastph() {
            feastph_table.style.visibility = "visible";
            feastph_table.style.display = "block";
            closeAll(feastph_table.id);
        }

        function openSideHolyweek() {
            holyweek_table.style.visibility = "visible";
            holyweek_table.style.display = "block";
            closeAll(holyweek_table.id);
        }

        function openSideFeastmedia() {        
            feastmedia_table.style.visibility = "visible";
            feastmedia_table.style.display = "block";
            closeAll(feastmedia_table.id);
        }

        function openSideFeastapp() {
            feastapp_table.style.visibility = "visible";
            feastapp_table.style.display = "block";
            closeAll(feastapp_table.id);
        }

        
    </script>
</html>