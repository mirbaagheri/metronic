<?php

namespace Mirbaagheri\MirMetronic\Render;

use Config;
use File;
use InvalidArgumentException;


class IlluminateRenderRepository implements RenderRepositoryInterface
{

    protected $blockName;
    protected $blockStart;
    protected $blockEnd;

    private $app;
    private $type;
    private $tagName;

    public function add2Queue($input,$type,$app,$tagName,$blockName)
    {
        $this->type         = $type;
        $this->app          = $app;
        $this->tagName      = $tagName;
        $this->blockName    = $blockName;
        $this->detector($input);
    }

    protected function checkLocation($src)
    {
        if (File::exists($src))
            return true;
        return false;
    }

    protected function linkGenerator($value)
    {
        $type = $this->type;
        if(array_key_exists('href',$value))
        {
            $value['href'] = $this->app->$type->locationStart.'/'.implode('/',$value['href']);
            if($this->checkLocation($value['href']))
            {
                $tag = "<link ".$this->makeTag($value).">";
                return $tag;
            }
            throw new InvalidArgumentException("link src is not valid.");
        }

        throw new InvalidArgumentException("Link must have href value!");
    }

    protected function scriptGenerator($value)
    {
        $type = $this->type;
        if(array_key_exists('src',$value))
        {
            $value['src'] = $this->app->$type->locationStart.'/'.implode('/',$value['src']);
            if($this->checkLocation($value['src']))
            {
                $tag = "<script ".$this->makeTag($value)."> </script>";
                return $tag;
            }
            throw new InvalidArgumentException("script src is not valid.");
        }
        throw new InvalidArgumentException("Script must have href value!");
    }

    protected function makeTag($value)
    {
        return implode(' ', array_map(
            function ($v, $k) { return sprintf("%s=\"%s\"", $k, $v); },
            $value,
            array_keys($value)
        ));
    }

    public function detector($input)
    {
        foreach($input as $tag => $value)
        {
            if(!is_null($value) && is_array($value))
            {
                foreach($value as $item)
                {
                    switch ($tag) {
                        default:
                            throw new InvalidArgumentException("Tag $tag is not defined.");

                        case false :
                            throw new InvalidArgumentException('tag can not be zero! error 103!');

                        case 'link':
                            $ref = &$this->app->load->metronicQueueFinal[$this->tagName][$this->blockName][$this->linkGenerator($item)];
                            break;

                        case 'script':
                            $ref = &$this->app->load->metronicQueueFinal[$this->tagName][$this->blockName][$this->scriptGenerator($item)];
                            break;
                    }
                }
                //throw new InvalidArgumentException("Invalid call in detector function! value must be an array.");
            }
        }
    }

    protected function blockMaker()
    {
        $this->blockStart = "<!-- BEGIN ".$this->blockName." -->";
        $this->blockEnd   = "<!-- End ".$this->blockName." -->";
    }

    public function printQueue($area)
    {
        foreach($this->app->load->metronicQueueFinal[$area] as $this->blockName => $blockValues)
        {
            $this->blockMaker();
            echo "\t\t".$this->blockStart."\n";
            foreach($blockValues as $value => $null)
            {
                echo  "\t\t".$value."\n";
            }
            echo "\t\t".$this->blockEnd."\n\n";
        }
    }

    public function render($area,$app)
    {
        $this->app = $app;
        if(array_key_exists($area,$this->app->load->metronicQueueFinal))
            $this->printQueue($area);
    }

}