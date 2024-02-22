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
    private function showContent(): string
    {
        return 'C:\Users\omarn\Documents\GitHub\MagaBot\images\pepe.webp';
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
