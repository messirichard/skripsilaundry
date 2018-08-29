<?php

class TestCommandHelp extends Help {

    public function init()
    {
        $this->setSummary('A single-line summary.');
        $this->setUsage('<arg1> <arg2>');
        $this->setOptions([
            'f,foo' => "The -f/--foo option description",
            'bar::' => "The --bar option description",
        ]);
        $this->setDescr("A multi-line description of the command.");
    }

}
