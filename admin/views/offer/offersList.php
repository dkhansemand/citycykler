<div class="mdl-grid">
    <div class="mdl-cell mdl-cell--12-col">
        <a href="<?=Router::Link('/OfferAdd');?>" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored">
            <i class="material-icons">add</i>
        </a>
    </div>
    <div class="mdl-cell mdl-cell--12-col">
        <table class="mdl-data-table mdl-js-data-table">
            <thead>
                <tr>
                    <th class="mdl-data-table__cell--non-numeric">Produktbillede</th>
                    <th class="mdl-data-table__cell--non-numeric">Mærke</th>
                    <th class="mdl-data-table__cell--non-numeric">Model</th>
                    <th>Tilbudspris</th>
                    <th class="mdl-data-table__cell--non-numeric">Handlinger</th>
                </tr>
            </thead>
            <tbody>
            <?php
                //foreach(Brands::GetBrands() as $brand){
            ?>
                <tr>
                    <td class="mdl-data-table__cell--non-numeric"></td>
                    <td class="mdl-data-table__cell--non-numeric"></td>
                    <td class="mdl-data-table__cell--non-numeric"></td>
                    <td></td>
                    <td class="mdl-data-table__cell--non-numeric">
                        <a href="<?=Router::Link('/OfferEdit/')?>" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored">
                            <i class="material-icons">edit</i>
                        </a>
                        <a href="<?=Router::Link('/OfferDelete/')?>" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect btn-red">
                            <i class="material-icons">delete</i>
                        </a>
                    </td>
                </tr>
            <?php //} ?>
            </tbody>
        </table>

    </div>
</div>