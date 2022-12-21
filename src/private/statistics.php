<br><h2>Статистика</h2>
<?php
require_once '../vendor/autoload.php';

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
            'numbers{1..10}' => [
                'stat_1' => '<numberBetween(2, 100)>',
                'stat_2' => '<numberBetween(2, 100)>',
                'stat_3' => '<numberBetween(2, 100)>',
                'stat_4' => '<numberBetween(2, 100)>',
                'stat_5' => '<numberBetween(2, 100)>'
            ]
        ]
    ]);
    return $graph_loader->getObjects();
}

$graph_data = get_graph_data();
$plot_type_int = 0;

$i = 0;
$str_data = implode(",", $graph_data);
$data = array_map("intval", explode(",", substr($str_data, 1, -1)));
$str_data = implode(",", $data);
while ($i < 3) {
    echo "<div style='margin-bottom: 10px;'><img src=\"show_graph.php?plot_type=$plot_type_int&graph_data=$str_data\"></div>";
    $plot_type_int += 1;
    $plot_type_int %= 3;
    $i += 1;
}

?>
</body>
</html>