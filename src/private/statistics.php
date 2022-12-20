<?php
session_start();
?>

<html lang="en">
<head>
    <title>Статистика</title>
<!--    <link rel="stylesheet" href="css/style.css" type="text/css"/>-->
</head>
<body class="body">

<?php
require_once '../../vendor/autoload.php';

use Nelmio\Alice\Loader\NativeLoader;

class Statistic {
    var $stat_1, $stat_2, $stat_3, $stat_4, $stat_5;

    public function __toString() {
        return sprintf(
            '[%d,%d,%d,%d,%d]',
            $this->stat_1, $this->stat_2, $this->stat_3, $this->stat_4, $this->stat_5
        );
    }

}

function get_graph_data() {
    $loader = new NativeLoader();
    $graph_loader = $loader->loadData([
        Statistic::class => [
            'graph{1..50}' => [
                'stat_1' => '<numberBetween(100, 900)>',
                'stat_2' => '<numberBetween(100, 900)>',
                'stat_3' => '<numberBetween(100, 900)>',
                'stat_4' => '<numberBetween(100, 900)>',
                'stat_5' => '<numberBetween(100, 900)>'
            ]
        ]
    ]);

    return $graph_loader->getObjects();
}

$graph_data = get_graph_data();
$plot_type_int = 0;

foreach ($graph_data as $i=>$data) {
    echo "<div style='margin-bottom: 10px;'><img src=\"/private/show_graph.php?plot_type=$plot_type_int&graph_data=$data\"></div>";
    $plot_type_int += 1;
    $plot_type_int %= 3;
}

?>

</body>
</html>