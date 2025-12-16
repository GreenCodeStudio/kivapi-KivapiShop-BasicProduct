<form>
    <div class="topBarButtons">
        <button class="button" type="button"><span class="icon-cancel"></span><?= t("Core.Panel.Common.Cancel") ?></button>
        <button class="button"><span class="icon-save"></span><?= t("Core.Panel.Common.Save") ?></button>
    </div>
    <div class="grid page-Article page-Article-edit">
        <input name="id" type="hidden">
        <section class="card" data-width="6">
            <header>
                <h1>product</h1>
            </header>
            <label>
                <span><?= t("KivapiShop.BasicProduct.Panel.Fields.name") ?></span>
                <input name="name">
            </label>
            <label>
                <span><?= t("KivapiShop.BasicProduct.Panel.Fields.price") ?></span>
                <input name="price">
            </label>
            <label>
                <span><?= t("KivapiShop.BasicProduct.Panel.Fields.priceCurrency") ?></span>
                <input name="priceCurrency">
            </label>
            <label>
                <span><?= t("KivapiShop.BasicProduct.Panel.Fields.photo") ?></span>
                <file-uploader name="photos"></file-uploader>
            </label>
            <label>
                <span><?= t("KivapiShop.BasicProduct.Panel.Fields.description") ?></span>
                <input name="description">
            </label>
        </section>
    </div>
</form>
