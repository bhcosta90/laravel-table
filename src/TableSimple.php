<?php

namespace Costa\LaravelTable;

use Costa\LaravelTable\Facades\Table as FacadesTable;

class TableSimple
{

    protected $data;

    protected $columns;

    protected $addColumns;

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

    /**
     * Get the value of addColumns
     */
    public function getAddColumns()
    {
        return $this->addColumns;
    }

    /**
     * Set the value of addColumns
     *
     * @return  self
     */
    public function setAddColumns($addColumns)
    {
        $this->addColumns = $addColumns;

        return $this;
    }

    public function run()
    {
        $table = FacadesTable::create($this->getData(), $this->getColumns());

        if (count($this->getAddColumns()) > 0) {
            foreach ($this->getAddColumns() as $k => $columns) {
                $nColumn = $columns;
                $func = $columns;
                if (is_array($nColumn)) {
                    $func = $nColumn['action'];
                }

                $label = $k;
                if(in_array($k, ['edit', 'delete', 'show'])){
                    $label = '';
                }
                
                $class = null;
                if(is_array($nColumn) && !empty($nColumn['class'])){
                    $class = $nColumn['class'];
                }

                $table->addColumn($k, $label, $func)->addClass($class ?? null);
            }
        }

        return $table;
    }
}
