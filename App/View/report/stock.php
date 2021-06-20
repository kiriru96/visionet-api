<!Doctype html>
<html>
    <head>
    </head>
    <body>
        <table>
            <thead>
                <tr>
                    <td>No</td>
                    <td>Barang</td>
                    <td>Merek</td>
                    <td>Model</td>
                    <td>Tanggal</td>
                    <td>Jumlah Item</td>
                    <td>Cc</td>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($item as $key => $items) :?>
                <tr>
                    <td>
                        <?= ($key + 1) ?>
                    </td>
                    <td>
                        <?= $item['devicename'] ?>
                    </td>
                    <td>
                        <?= $item['brandname'] ?>
                    </td>
                    <td>
                        <?= $item['model'] ?>
                    </td>
                    <td>
                        <?= $item['datecreated'] ?>
                    </td>
                    <td>
                        <?= $item['adminname'] ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php if(!is_null($table['print']) && $table['print']) : ?>
            <script type="text/javascript">
                window.print();
            </script>
        <?php endif; ?>
    </body>
</html>