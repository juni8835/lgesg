<?php 

function dd(...$args): void
{
    echo "<div style='
        background-color: #2d2f34; 
        color: #ffffff; 
        padding: 15px; 
        border-radius: 8px; 
        font-family: Consolas, monospace; 
        font-size: 14px; 
        max-height: 600px; 
        overflow-y: auto; 
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); 
        margin: 20px auto; 
        line-height: 1.6; 
        width: 90%; 
        max-width: 1200px;'>
        <div style='font-weight: bold; color: #80cbc4; margin-bottom: 10px;'>Debug Output:</div>";

    foreach ($args as $arg) {
        renderElement($arg);
    }

    echo "</div>";

    echo "
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const toggles = document.querySelectorAll('.dd-toggle');
            toggles.forEach(toggle => {
                toggle.addEventListener('click', () => {
                    const content = toggle.nextElementSibling;
                    if (content.style.display === 'none') {
                        content.style.display = 'block';
                        toggle.textContent = '▼ ' + toggle.dataset.label;
                    } else {
                        content.style.display = 'none';
                        toggle.textContent = '▶ ' + toggle.dataset.label;
                    }
                });
            });
        });
    </script>
    ";
    die(1);
}

/**
 * Render each element recursively with toggle functionality for arrays and objects.
 */
function renderElement($element, $level = 0): void
{
    $padding = $level * 20;

    if (is_array($element)) {
        echo "<div style='margin-left: {$padding}px;'>
                <span class='dd-toggle' data-label='Array (" . count($element) . ")' style='
                    display: inline-block;
                    cursor: pointer;
                    color: #ffb86c;
                    margin-bottom: 5px;
                '>▶ Array (" . count($element) . ")</span>
                <div style='display: none; margin-left: 20px;'>";
        foreach ($element as $key => $value) {
            echo "<div>
                    <span style='color: #ff79c6;'>[{$key}]</span> => ";
            renderElement($value, $level + 1);
            echo "</div>";
        }
        echo "</div></div>";
    } elseif (is_object($element)) {
        $className = get_class($element);
        $properties = (new \ReflectionObject($element))->getProperties();

        echo "<div style='margin-left: {$padding}px;'>
                <span class='dd-toggle' data-label='Object ({$className})' style='
                    display: inline-block;
                    cursor: pointer;
                    color: #bd93f9;
                    margin-bottom: 5px;
                '>▶ Object ({$className})</span>
                <div style='display: none; margin-left: 20px;'>";
        foreach ($properties as $property) {
            $property->setAccessible(true);
            $key = $property->getName();
            $value = $property->getValue($element);
            echo "<div>
                    <span style='color: #ff79c6;'>{$key}</span> => ";
            renderElement($value, $level + 1);
            echo "</div>";
        }
        echo "</div></div>";
    } else {
        $color = match (gettype($element)) {
            'string' => '#50fa7b',
            'integer' => '#ff79c6',
            'double' => '#8be9fd',
            'boolean' => '#bd93f9',
            'NULL' => '#6272a4',
            default => '#f8f8f2',
        };

        $formattedValue = match (gettype($element)) {
            'boolean' => $element ? 'true' : 'false',
            'NULL' => 'null',
            default => htmlspecialchars((string)$element),
        };

        echo "<span style='color: {$color};'>{$formattedValue}</span>";
    }
}
