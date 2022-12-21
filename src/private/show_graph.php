<?php
require_once '../../vendor/autoload.php';

use Amenadiel\JpGraph\Graph\Graph;
use Amenadiel\JpGraph\Plot\LinePlot;
use Amenadiel\JpGraph\Plot\BarPlot;
use Amenadiel\JpGraph\Plot\ScatterPlot;

function get_line_plot($data) {
    $plot =  new LinePlot($data);
    $plot->SetFillGradient('#FFFFFF','#F0F8FF');
    $plot->SetColor('#aadddd');
    return $plot;
}

function get_bar_plot($data) {
    return new BarPlot($data);
}

function get_scatter_plot($data) {
    $plot = new ScatterPlot($data);
    $plot->mark->SetType(MARK_FILLEDCIRCLE);
    $plot->mark->SetFillColor("#F0F8FF");
    $plot->mark->SetWidth(4);
    return $plot;
}


function set_watermark(GdImage $img): void {
    $watermark = imagecreate(140, 140);

    imagecolorallocatealpha($watermark, 250, 250, 255, 125);
    imagestring($watermark, 5, 0, 0, '@koukyn', imagecolorallocatealpha($watermark, 0, 0, 0, 100));

    $watermark_width = imagesx($watermark);
    $watermark_height = imagesy($watermark);

    imagecopy(
        $img, $watermark,
        $watermark_width/2, 0,
        0, 0,
        $watermark_width, $watermark_height
    );

    header('Content-type: image/png');
    imagepng($img);
    imagedestroy($img);
}

function get_graph(): GdImage {
    $plot_type = 3;
    if (array_key_exists('plot_type', $_GET)) {
        $plot_type = intval($_GET['plot_type']);
    }
    if (array_key_exists('graph_data', $_GET)) {
        $graph_data_str = $_GET['graph_data'];
        $graph_data = array_map("intval", explode(",", substr($graph_data_str, 1, -1)));
    }

    $plot = match($plot_type) {
        0 => get_line_plot($graph_data),
        1 => get_bar_plot($graph_data),
        2 => get_scatter_plot($graph_data),
        default => get_line_plot($graph_data)
    };

    $graph = new Graph(1000, 600);
    $graph->SetScale('textint', 1, 100);
    $graph->img->SetImgFormat('png');
    $graph->title->Set('Plot example');
    $graph->xaxis->title->Set('Values');
    $graph->yaxis->title->Set('Random number');
    $graph->yaxis->HideLine(false);
    $graph->ygrid->SetFill(true,'#FFFFFF@0.5','#FFFFFF@0.5');
    $graph->SetBox(false);
    $graph->Add($plot);
    return $graph->Stroke(_IMG_HANDLER); // Display the graph and watermark
}

set_watermark(get_graph());

?>