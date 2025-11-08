<div>
    <?php
    foreach ($this->list as $product) {
        ?>
        <a href="<?= $this->productUrl->path ?>?id=<?= $product->id ?>">
            <article>
                <h3>
                    <?= pt($product->title) ?>
                </h3>
                <?= number_format($product->price / 100, 2, ',', ' ') ?>
                <?= $product->price_currency ?>
            </article>
        </a>
        <?php
    }
    ?>
</div>
