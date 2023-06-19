<?php 
namespace app\widgets;

use kartik\grid\GridView;

class FreezableGridView extends GridView
{
    public $freezeColumns = [];

    public function run()
    {
        if (!empty($this->freezeColumns)) {
            foreach ($this->freezeColumns as $columnIndex) {
                $columnIndex = $columnIndex + 1;
                $this->view->registerCss("
                .grid-view th:nth-child({$columnIndex}),
                .grid-view td:nth-child({$columnIndex}) {
                    position: sticky;
                    left: " . (60 * $columnIndex - 60) . "px;
                    border-left: 1px solid #ddd;
                    border-right: 1px solid #ddd;
                    z-index: 1;
                    background-color: #f9f9f9;
                }
            ");
            }
        }
        parent::run();
    }
    public function init()
    {
        parent::init();
        $this->tableOptions['class'] = 'table table-striped';
    }
}
