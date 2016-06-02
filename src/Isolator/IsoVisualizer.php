<?php

namespace Isolator;


class IsoVisualizer {

    
    public static function visualize($iso){
        echo "<style>";
        echo file_get_contents(realpath(dirname(__FILE__)) . '/vizualize.css');
        echo "</style>";
        
        echo "<div class=\"isolator_iso_container\" >";
        echo "<h1>>" . basename($iso->getFileName()) . "</h1>";
        
        $boxMap = $iso->getBoxMap();
        
        foreach ($boxMap as $box) {
            
            
            static::displayBox($box);
            
        }
        echo "</div>";
    
        
    }
    
    public static function displayBox($box){
        
        echo "<div class=\"isolator_box_depth_" . $box->getDepth() .  "\">";
        echo $box->getBoxType();
        
        $subBoxes = $box->getBoxMap();
        $boxDetails = $box->getBoxDetails();
        
        if ($boxDetails) {
            
            echo "<ul>";
            foreach ($boxDetails as $key => $detail) {

                echo "<li>" . $key . " : " . $detail . "</li>";
            }
            echo "</ul>";
            
        }


        foreach ($subBoxes as $subBox){
            static::displayBox($subBox);
            
        }
        
        echo "</div>";
        
    }
    
    
}
