<?php

namespace Pyad\Core;

abstract class Box extends ExecCommand
{
    protected int $height = 15;
    protected int $width = 50;
    protected string $text = '';
    protected string $signature = '';
    protected string $additionalCommands = '';

    public function show(): YadResponse
    {
        if (!$this->signature) {
            $className = explode("\\", strtolower(get_called_class()));
            $this->signature = end($className);
        }

        $args = $this->additionalCommands . ' --' . $this->signature . ' "' . $this->text . '" ' . $this->height . ' ' . $this->width;
        //die($args.PHP_EOL);
        return $this->dialog($args);
    }

    public function text($text): Box
    {
        $this->text = $text;
        return $this;
    }

    public function clearAsShell(): Box
    {
        passthru('clear || cls');
        return $this;
    }

    public function title(string $boxTitle): Box
    {
        $this->additionalCommands .= ' --title "' . $boxTitle . '"';
        return $this;
    }
}