<?php

namespace Costa\LaravelTable;

use Costa\LaravelTable\Facades\Table as FacadesTable;

class TableSimple
{

    protected $data;

    protected $columns;

    /**
     * Get the value of data
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Set the value of data
     *
     * @return  self
     */
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Get the value of columns
     */
    public function getColumns()
    {
        return $this->columns;
    }

    /**
     * Set the value of columns
     *
     * @return  self
     */
    public function setColumns($columns)
    {
        $this->columns = $columns;
        return $this;
    }

    public function run()
    {
        $table = FacadesTable::create($this->getData(), false);

        if (count($this->getColumns()) > 0) {
            foreach ($this->getColumns() as $k => $columns) {
                $nColumn = $columns;
                $func = $columns;
                if (is_array($nColumn)) {
                    $func = $nColumn['action'];
                }

                $label = $k;
                if (substr($k, 0, 1) == '_' || in_array($k, ['edit', 'delete', 'show'])) {
                    $label = '';
                }

                $class = null;
                if (is_array($nColumn) && !empty($nColumn['class'])) {
                    $class = $nColumn['class'];
                }

                $table->addColumn($k, $label, $func)->addClass($class ?? null);
            }
        }

        return $table;
    }
}
