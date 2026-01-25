<?php 
// If constant is not defined error 403 + exit().
if (!defined('ACCESS_GRANTED')) {
    http_response_code(403);
    exit();
}
?>

<!-- Slider left to right -->
 <div class="slider-container slider-1">
    <div class="slider">
        <!-- First and last must be the same -->
        <p>Text Template 1</p> 
        <p>Text Template 2</p>
        <p>Text Template 3</p>
        <p>Text Template 4</p>
        <p>Text Template 1</p>
    </div>
 </div>