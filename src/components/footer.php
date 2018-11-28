<?php

require_once realpath(__DIR__ . '/component.php');

class PageFooter extends Component
{

    private const DATA = ['content'];

    protected function render($parameters)
    {
        extract(self::safe($parameters, self::DATA));
        ?>
                    <footer>
                    <?php self::print($content); ?>
                    </footer>
                </div>
            </body>
        </html>
        <?php
    }
}