<?php

namespace App\Components;

use App\Components\Interfaces\SaveDataToFileInterface;
use Illuminate\Support\Facades\Storage;
use Spatie\ArrayToXml\ArrayToXml;

class XmlDocument
{
    /**
     * @var
     */
    private $template;
    /**
     * @var
     */
    private $rows;
    /**
     * @var
     */
    private $data;

    /**
     * XmlDocument constructor.
     */
    public function __construct()
    {
        $this->template = '<?xml version="1.0"?><root>CONTENT</root>';
    }

    /**
     *
     */
    public function render()
    {
        $content = implode("\n" , $this->rows);

        $this->data = str_replace("CONTENT", $content, $this->template);
    }

    /**
     * @return mixed
     */
    public function __toString()
    {
        $this->render();
        return $this->data;
    }

    /**
     * @param $name
     * @param $value
     */
    public function addItem($name, $value)
    {
        $this->rows[] = $this->getItemValue($name, $value);
    }

    /**
     * @param $name
     * @param $data
     */
    public function addNestedItem($name, $data)
    {
        $innerData = [];
        foreach ($data as $key => $value) {
            $innerData[] = $this->getItemValue($key, $value);
        }

        $this->rows[] = "<$name>\n" . implode("\n", $innerData) . "\n</$name>";
    }

    /**
     * @param $name
     * @param $value
     * @return string
     */
    private function getItemValue($name, $value)
    {
        return "<$name>" . $value . "</$name>";
    }
}
