<?php

namespace App\Controller\Component;

use Cake\Controller\Component;

class MyComponentComponent extends Component
{

    public function initialize(array $config): void
    {
        parent::initialize($config);
    }
    
    public function setFormErrors($errors = [])
    {

        $ulErrors = '<ul>';
        foreach ($errors as $key => $value) {
            if (is_array($value)) {
                foreach ($value as $keyy => $valuee) {
                    $ulErrors .= "<li><b>[$key]</b> $valuee</li>";
                }
            }
        }
        $ulErrors .= '</ul>';

        $html = "
        <div class=\"alert alert-warning alert-dismissible fade show\" role=\"alert\">
            <strong>There are errors</strong>.
            $ulErrors
                <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                    <span aria-hidden=\"true\">&times;</span>
                </button>
        </div>
        ";
        return $html;
    }
}
