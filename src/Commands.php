<?php
declare(strict_types=1);

namespace MagaBot;

class Commands
{
    private array $trueCommand;

    public function __construct()
    {
        $this->trueCommand['!show date'] = 'showDate';
        $this->trueCommand['!show time'] = 'showTime';
        $this->trueCommand['!show content'] = 'showContent';
        $this->trueCommand['!help'] = 'help';
    }
    public function execute(string $command): string
    {
        if (isset($this->trueCommand[$command]))
        {
            return $this->{$this->trueCommand[$command]}();
        }
        return 'Unknown command. Write !help to see list of available commands.';
    }
    private function showDate():string
    {
        return date('d.m.Y');
    }
    private function showTime():string
    {
        return date('H:i');
    }
    private function showContent()
    {
        return readfile(__DIR__ .'/pepe.webp');
    }
    private function help():string
    {
        $commandList = [];
        foreach($this->trueCommand as $command => $method){
            $commandList[] = $command ;
        }
        return 'All command list: ' . implode(', ' , $commandList);
    }
}
//сделать так, чтоб команды были одним текстом, а функции в классе другим
