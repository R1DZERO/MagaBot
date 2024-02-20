<?php
declare(strict_types=1);

namespace MagaBot;


class Commands
{

    public function execute(string $command): string{
        if (method_exists($this, $command)) {
            return $this->{$command}();
        }
        return 'Unknown command. Write !help to see list of available commands.';
    }
    private function showDate():string{
        return date('d.m.Y');
    }
    private function showTime():string{
        return date('H:i');
    }
    private function showContentLink():string{
        return 'https://i0.wp.com/www.technollama.co.uk/wp-content/uploads/2021/08/pepe.png?fit=1200%2C626&ssl=1';
    }
    private function help():string{
        return 'All command list: showTime, showDate, showContentLink';
    }

}
//сделать так, чтоб команды были одним текстом, а функции в классе другим
