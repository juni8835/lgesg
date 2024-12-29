<?php

use app\core\View;
use app\facades\Snapshot;

function snapshot()
{
	Snapshot::show();
}

function lordIcon($key, $primary = '#212121', $secondary = '#212121')
{
	$src = "https://cdn.lordicon.com/$key.json";
	return '<lord-icon
				src="' . $src . '"
				trigger="hover"
				colors="primary:'.$primary.',secondary:'.$secondary.'"
			>
			</lord-icon>';
}

function aos($direction = 'fade-up', $delay = 0, $duration = 1)
{
	return 'data-aos="'.$direction.'" data-aos-once="true" data-aos-delay="'.($delay * 1000).'" data-aos-duration="' . ($duration * 1000) . '"' ;
}

function render($path = '', $data = []): void
{
	$view = new View($path, $data);
	echo $view->render();
	exit; 
}

function view(View $view, $path)
{
	return $view->renderOnlyView($path);
}