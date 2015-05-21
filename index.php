<?php
require_once dirname(__FILE__) . '/src/config.php';
require_once dirname(__FILE__) . '/vendor/autoload.php';

if (empty($_POST['Submit']) === false
    && empty($_POST['items']) === false) {
    $potentiate = new MarinusJvv\Potentiate\Potentiate();
    $packages = $potentiate->process($_POST['items']);
    echo 'This order has the following packages:';
    $count = 1;
    foreach ($packages as $package) {
        echo "<br />Package {$count}<br />";
        echo 'Items - ';
        $itemStr = '';
        foreach ($package->getItems() as $item) {
            $itemStr .= $item->name . ', ';
        }
        echo rtrim($itemStr, ', ') . "<br />";
        echo 'Total weight - ' . $package->getTotalWeight() . "g<br />";
        echo 'Total price - $' . $package->getTotalCost() . "<br />";
        echo 'Courier price - $' . $package->getCourierCharge() . "<br />";
        $count++;
    }
}
?>

<html>
<body>
<form action="index.php" method="POST">
<?php
foreach (json_decode(ITEM_LIST, true) as $id => $item) {
?>
<input type="checkbox" name="items[]" value="<?php echo $id; ?>">
<?php echo $item['name']; ?>&nbsp;
$<?php echo $item['price']; ?>&nbsp;
<?php echo $item['weight']; ?>g &nbsp;
<br />
<?php
}
?>
<input type="Submit" name="Submit" value="Submit">
</form>
</body>
</html>