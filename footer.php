<?php
    class Footer {
        public $scripts = [];

        function addScript($pScript) {
            array_push($this->scripts, $pScript);
        }

        function drawFooter() {
            echo
            '   
                </div>
                

                <script src="https://code.jquery.com/jquery-3.6.0.min.js" 
                        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" 
                        crossorigin="anonymous">
                </script>

                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js" 
                        integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ" 
                        crossorigin="anonymous">
                </script>';

            foreach ($this->scripts as $item) {
                echo '<script src="'.$item.'"></script>';
            }

            echo
            '   </body>
                </html>';
        }
    }
?>